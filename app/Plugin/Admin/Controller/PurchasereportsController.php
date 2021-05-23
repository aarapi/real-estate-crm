<?php
App::uses('CakeTime', 'Utility');
class PurchasereportsController extends AdminAppController
{
    public $components = array('HighCharts.HighCharts');
    public function index()
    {
        $cond=array();$date="";$dateBetween=false;
        $condition=$this->CustomFunction->agencyWisePermission(NULL,$this->userType,$this->agencyId,'Purchase.project_id');
        if ($this->request->is('post'))
        {
            if($this->request->data['Purchasereport']['project_id'])
            {
                $cond[]=array('Purchase.project_id'=>$this->request->data['Purchasereport']['project_id']);
            }
            if($this->request->data['Purchasereport']['name'])
            {
                $cond[]=array('Purchase.name LIKE'=>'%'.$this->request->data['Purchasereport']['name'].'%');
            }
            if($this->request->data['Purchasereport']['date'])
            {
                $date=$this->request->data['Purchasereport']['date']['year'];
            }
            if($this->request->data['Purchasereport']['start_date'] && $this->request->data['Purchasereport']['end_date'])
            {
                $startDate=$this->CustomFunction->dateFormatBeforeSave($this->request->data['Purchasereport']['start_date']);
                $endDate=$this->CustomFunction->dateFormatBeforeSave($this->request->data['Purchasereport']['end_date']);
                $cond[]=array('Purchasereport.date BETWEEN ? AND ?'=>array($startDate,$endDate));
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
            $PurchaseCount=$this->Purchasereport->find('count',array('conditions'=>array('MONTH(Purchasereport.date)'=>$month,'YEAR(date)'=>$year,$cond,$condition)));
            $purchaseArr=$this->Purchasereport->find('all',array('fields'=>array('SUM(Purchasereport.amount) AS purchase'),'conditions'=>array('MONTH(Purchasereport.date)'=>$month,'YEAR(Purchasereport.date)'=>$year,$cond,$condition)));
            if($purchaseArr[0][0]['purchase']==null)
            $purchase=0;
            else
            $purchase=$purchaseArr[0][0]['purchase'];
            $graphMonth[]=$monthName;
            $months[]['MonthArr'] = array('monthName'=>$monthName,'PurchaseCount'=>$PurchaseCount,'purchase'=>$purchase);
            $performanceChartData[]=(float) $purchase;
        }
        $graphMonth=array_reverse($graphMonth);
        $months=array_reverse($months);
        $currMonth=CakeTime::format('m',$this->siteTimezone);
        $currYear=CakeTime::format('Y',$this->siteTimezone);
        $totalPurchaseCount=$this->Purchasereport->find('count',array('conditions'=>array($cond,$condition)));
        $purchaseArr=$this->Purchasereport->find('all',array('fields'=>array('SUM(Purchasereport.amount) AS purchase'),'conditions'=>array($cond,$condition)));
        $purchaseArr1=$this->Purchasereport->find('all',array('fields'=>array('SUM(Purchasereport.amount) AS purchase'),
                                                          'conditions'=>array('MONTH(Purchasereport.date)'=>$currMonth,'YEAR(Purchasereport.date)'=>$currYear,$cond,$condition)));
        $monthPurchaseCount=$this->Purchasereport->find('count',array('conditions'=>array('MONTH(Purchasereport.date)'=>$currMonth,'YEAR(Purchasereport.date)'=>$currYear,$cond,$condition)));
        if($purchaseArr[0][0]['purchase']==null)
        $totalPurchase=0;
        else
        $totalPurchase=$purchaseArr[0][0]['purchase'];
        if($purchaseArr1[0][0]['purchase']==null)
        $purchaseMonth=0;
        else
        $purchaseMonth=$purchaseArr1[0][0]['purchase'];
        $tooltipFormatFunction ="function() { return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+''+ this.y ;}";
        $chartName = "My Chartdl";
        $mychart = $this->HighCharts->create($chartName,'line');
        $this->HighCharts->setChartParams(
                                          $chartName,
                                          array(
                                                'renderTo'=> "mywrapperdl",  // div to display chart inside
                                                'title'=> 'Purchases',
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
        $series->addName('Purchase Report')->addData(array_reverse($performanceChartData));
        $mychart->addSeries($series);
        $this->set('totalPurchaseCount',$totalPurchaseCount);
        $this->set('totalPurchase',$totalPurchase);
        $this->set('purchaseMonth',$purchaseMonth);
        $this->set('monthPurchaseCount',$monthPurchaseCount);
        $this->set('purchaseReport',$months);
        $this->loadModel('Project');
        $this->set('projectName',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        $this->set('dateBetween',$dateBetween);
    }
}