<?php
App::uses('CakeTime', 'Utility');
class SalesreportsController extends AdminAppController
{
    public $components = array('HighCharts.HighCharts');
    public function index()
    {
        $cond=array();$cond1=array();$date="";$dateBetween=false;
        $condition=$this->CustomFunction->agencyWisePermission(NULL,$this->userType,$this->agencyId,'Property.project_id');
        $this->set('isClient',false);
        $this->set('clientName',null);
        $this->set('clientId',null);
        if ($this->request->is('post'))
        {
            if($this->request->data['Salesreport']['project_id'])
            {
                $cond[]=array('Property.project_id'=>$this->request->data['Salesreport']['project_id']);
                $cond1[]=array('Property.project_id'=>$this->request->data['Salesreport']['project_id']);
            }
            if($this->request->data['Salesreport']['client_id'])
            {
                $clientId=$this->request->data['Salesreport']['client_id'];
                $cond[]=array('Salesreport.client_id'=>$clientId);
                $cond1[]=array('Salesreport.client_id'=>$clientId);
                $this->set('isClient',true);
                $this->loadModel('Client');
                $clientNameArr=$this->Client->findById($clientId,array('Client.name'));
                $this->set('clientName',$clientNameArr['Client']['name']);
                $this->set('clientId',$clientId);
            }
            if($this->request->data['Salesreport']['type'])
            {
                $cond[]=array('Property.type'=>$this->request->data['Salesreport']['type']);
                $cond1[]=array('Property.type'=>$this->request->data['Salesreport']['type']);
            }
            if($this->request->data['Salesreport']['availiable'])
            {
                $cond[]=array('Property.availiable'=>$this->request->data['Salesreport']['availiable']);
                $cond1[]=array('Property.availiable'=>$this->request->data['Salesreport']['availiable']);
            }
            if($this->request->data['Salesreport']['date'])
            {
                $date=$this->request->data['Salesreport']['date']['year'];
            }
            if($this->request->data['Salesreport']['start_date'] && $this->request->data['Salesreport']['end_date'])
            {
                $startDate=$this->CustomFunction->dateFormatBeforeSave($this->request->data['Salesreport']['start_date']);
                $endDate=$this->CustomFunction->dateFormatBeforeSave($this->request->data['Salesreport']['end_date']);
                $cond[]=array('Salesreport.date BETWEEN ? AND ?'=>array($startDate,$endDate));
                $cond1[]=array('DealsPayment.payment_date BETWEEN ? AND ?'=>array($startDate,$endDate));
                $dateBetween=true;
            }
        }
        for ($i = 0; $i < 12; ++$i)
        {
            if(strlen($date)>0)
            {
                $year=$date;
                $searchDate=$year.'-'.(12-$i).'-01';
                $month=CakeTime::format('m',$searchDate);                
                $monthName=CakeTime::format('M Y',$searchDate);
            }
            else
            {
                $year=CakeTime::format("-$i months",'%Y',$this->siteTimezone);
                $month=CakeTime::format("-$i months",'%m',$this->siteTimezone);
                $monthName=CakeTime::format("-$i months",'%B %Y',$this->siteTimezone);
            }
            $salesCount=$this->Salesreport->find('count',array('joins'=>array(array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Salesreport.property_id=Property.id'))),
                                                               'conditions'=>array('MONTH(Salesreport.date)'=>$month,'YEAR(Salesreport.date)'=>$year,$cond,$condition)));
            $this->loadModel('DealsPayment');
            $earningArr=$this->DealsPayment->find('all',array('fields'=>array('SUM(DealsPayment.total_amount) AS earning'),'joins'=>array(array('table'=>'deals','alias'=>'Salesreport','type'=>'LEFT','conditions'=>array('Salesreport.id=DealsPayment.deal_id')),
                                                                                                                                    array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Salesreport.property_id=Property.id'))),
                                                             'conditions'=>array('MONTH(DealsPayment.payment_date)'=>$month,'YEAR(DealsPayment.payment_date)'=>$year,$cond1,$condition)));
            if($earningArr[0][0]['earning']==null)
            $earning=0;
            else
            $earning=$earningArr[0][0]['earning'];
            $graphMonth[]=$monthName;
            $months[]['MonthArr'] = array('monthName'=>$monthName,'salesCount'=>$salesCount,'earning'=>$earning);
            $performanceChartData[]=(float) $earning;
        }
        $graphMonth=array_reverse($graphMonth);
        $months=array_reverse($months);
        $currMonth=CakeTime::format('m',$this->siteTimezone);
        $currYear=CakeTime::format('Y',$this->siteTimezone);
        $totalSalesCount=$this->Salesreport->find('count',array('joins'=>array(array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Property.id=Salesreport.property_id'))),
                                                                'conditions'=>array($cond,$condition)));
        $earningArr=$this->DealsPayment->find('all',array('fields'=>array('SUM(DealsPayment.total_amount) AS earning'),
                                                          'joins'=>array(array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Property.id=DealsPayment.property_id')),
                                                                        array('table'=>'deals','alias'=>'Salesreport','type'=>'LEFT','conditions'=>array('Salesreport.id=DealsPayment.deal_id'))),
                                                          'conditions'=>array($cond1,$condition)));
        $earningArr1=$this->DealsPayment->find('all',array('fields'=>array('SUM(DealsPayment.total_amount) AS earning'),
                                                           'joins'=>array(array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Property.id=DealsPayment.property_id')),
                                                                          array('table'=>'deals','alias'=>'Salesreport','type'=>'LEFT','conditions'=>array('Salesreport.id=DealsPayment.deal_id'))),
                                                          'conditions'=>array('MONTH(DealsPayment.payment_date)'=>$currMonth,'YEAR(DealsPayment.payment_date)'=>$currYear,$cond1,$condition)));
        $monthSalesCount=$this->Salesreport->find('count',array('joins'=>array(array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Property.id=Salesreport.property_id'))),
                                                                'conditions'=>array('MONTH(Salesreport.date)'=>$currMonth,'YEAR(Salesreport.date)'=>$currYear,$cond,$condition)));
        if($earningArr[0][0]['earning']==null)
        $totalEearning=0;
        else
        $totalEearning=$earningArr[0][0]['earning'];
        if($earningArr1[0][0]['earning']==null)
        $earningMonth=0;
        else
        $earningMonth=$earningArr1[0][0]['earning'];
        $tooltipFormatFunction ="function() { return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+''+ this.y ;}";
        $chartName = "My Chartdl";
        $mychart = $this->HighCharts->create($chartName,'line');
        $this->HighCharts->setChartParams(
                                          $chartName,
                                          array(
                                                'renderTo'=> "mywrapperdl",  // div to display chart inside
                                                'title'=> 'Sales Earning',
                                                'titleAlign'=> 'center',
                                                'creditsEnabled'=> FALSE,
                                                'xAxisLabelsEnabled'=> TRUE,
                                                'xAxisCategories'=> $graphMonth,
                                                'yAxisTitleText'=> '',
                                                'tooltipEnabled'=> TRUE,
                                                'tooltipFormatter'=> $tooltipFormatFunction,
                                                'enableAutoStep'=> FALSE,
                                                'plotOptionsShowInLegend'=> TRUE,                                              
                                                )
                                          );
        $series = $this->HighCharts->addChartSeries();
        $series->addName('Sales Report')->addData(array_reverse($performanceChartData));
        $mychart->addSeries($series);
        $this->set('totalSalesCount',$totalSalesCount);
        $this->set('totalEearning',$totalEearning);
        $this->set('earningMonth',$earningMonth);
        $this->set('monthSalesCount',$monthSalesCount);
        $this->set('salesReport',$months);
        $this->loadModel('Project');
        $this->set('projectName',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        $this->set('dateBetween',$dateBetween);
    }
    public function clientsearch()
    {
        $this->autoRender = false;
        // get the search term from URL
        $this->loadModel('Deal');
        $term = $this->request->query['q'];
        $users = $this->Deal->find('all',array('fields'=>array('Client.id','Client.name'),
                                               'joins'=>array(array('table'=>'clients','alias'=>'Client','type'=>'INNER','conditions'=>array('Deal.client_id=Client.id'))),
                                               'conditions' => array('Client.name LIKE' => '%'.$term.'%'),
                                               'group'=>array('Client.id')));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] = (int) $user['Client']['id'];
            $result[$key]['text'] = $user['Client']['name'];
        }
        $users = $result;        
        echo json_encode($users);
    }
}