<?php
App::uses('CakeTime', 'Utility');
class ProfitreportsController extends AdminAppController
{
    public $components = array('HighCharts.HighCharts');
    public function index()
    {
        $this->loadModel('DealsPayment');
        $this->loadModel('PurchasesPayment');
        $cond=array();$cond1=array();$cond2=array();$date="";$dateBetween=false;
        $condition=$this->CustomFunction->agencyWisePermission(NULL,$this->userType,$this->agencyId,'Expense.project_id');
        $condition1=$this->CustomFunction->agencyWisePermission(NULL,$this->userType,$this->agencyId,'Property.project_id');
        $condition2=$this->CustomFunction->agencyWisePermission(NULL,$this->userType,$this->agencyId,'Purchase.project_id');
        if ($this->request->is('post'))
        {
            if($this->request->data['Profitreport']['project_id'])
            {
                $cond[]=array('Property.project_id'=>$this->request->data['Profitreport']['project_id']);
                $cond1[]=array('Expense.project_id'=>$this->request->data['Profitreport']['project_id']);
                $cond2[]=array('Purchase.project_id'=>$this->request->data['Profitreport']['project_id']);
            }
            if($this->request->data['Profitreport']['date'])
            {
                $date=$this->request->data['Profitreport']['date']['year'];
            }
            if($this->request->data['Profitreport']['start_date'] && $this->request->data['Profitreport']['end_date'])
            {
                $startDate=$this->CustomFunction->dateFormatBeforeSave($this->request->data['Profitreport']['start_date']);
                $endDate=$this->CustomFunction->dateFormatBeforeSave($this->request->data['Profitreport']['end_date']);
                $cond[]=array('DealsPayment.payment_date BETWEEN ? AND ?'=>array($startDate,$endDate));
                $cond1[]=array('Profitreport.date BETWEEN ? AND ?'=>array($startDate,$endDate));
                $cond2[]=array('PurchasesPayment.date BETWEEN ? AND ?'=>array($startDate,$endDate));
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
            $earningArr=$this->DealsPayment->find('all',array('fields'=>array('SUM(total_amount) AS earning'),
                                                              'joins'=>array(array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Property.id=DealsPayment.property_id'))),
                                                              'conditions'=>array('MONTH(payment_date)'=>$month,'YEAR(payment_date)'=>$year,$cond,$condition1)));
            $expenseArr=$this->Profitreport->find('all',array('joins'=>array(array('table'=>'expenses','alias'=>'Expense','type'=>'LEFT','conditions'=>array('Expense.id=Profitreport.expense_id'))),
                                                              'fields'=>array('SUM(Profitreport.amount) AS expense'),'conditions'=>array('MONTH(date)'=>$month,'YEAR(date)'=>$year,$cond1,$condition)));
            $purchaseArr=$this->PurchasesPayment->find('all',array('joins'=>array(array('table'=>'purchases','alias'=>'Purchase','type'=>'LEFT','conditions'=>array('Purchase.id=PurchasesPayment.purchase_id'))),
                                                                   'fields'=>array('SUM(PurchasesPayment.amount) AS purchase'),'conditions'=>array('MONTH(date)'=>$month,'YEAR(date)'=>$year,$cond2,$condition2)));
            if($earningArr[0][0]['earning']==null)
            $earning=0;
            else
            $earning=$earningArr[0][0]['earning'];
            if($expenseArr[0][0]['expense']==null)
            $expense=0;
            else
            $expense=$expenseArr[0][0]['expense'];
            if($purchaseArr[0][0]['purchase']==null)
            $purchase=0;
            else
            $purchase=$purchaseArr[0][0]['purchase'];
            $graphMonth[]=$monthName;
            $months[]['MonthArr'] = array('monthName'=>$monthName,'earning'=>$earning,'purchase'=>$purchase,'expense'=>$expense);
            $performanceChartData[]=(float) $earning-$expense-$purchase;
        }
        $graphMonth=array_reverse($graphMonth);
        $months=array_reverse($months);
        $currMonth=CakeTime::format('m',$this->siteTimezone);
        $currYear=CakeTime::format('Y',$this->siteTimezone);
        $earningArr=$this->DealsPayment->find('all',array('fields'=>array('SUM(total_amount) AS earning'),
                                                          'joins'=>array(array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Property.id=DealsPayment.property_id'))),
                                                          'conditions'=>array($condition1,$cond)));
        $earningArr1=$this->DealsPayment->find('all',array('fields'=>array('SUM(total_amount) AS earning'),
                                                           'joins'=>array(array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Property.id=DealsPayment.property_id'))),
                                                           'conditions'=>array('MONTH(payment_date)'=>$currMonth,'YEAR(payment_date)'=>$currYear,$cond,$condition1)));
        $expenseArr=$this->Profitreport->find('all',array('joins'=>array(array('table'=>'expenses','alias'=>'Expense','type'=>'LEFT','conditions'=>array('Expense.id=Profitreport.expense_id'))),
                                                          'fields'=>array('SUM(Profitreport.amount) AS expense'),'conditions'=>array($cond1,$condition)));
        $expenseArr1=$this->Profitreport->find('all',array('joins'=>array(array('table'=>'expenses','alias'=>'Expense','type'=>'LEFT','conditions'=>array('Expense.id=Profitreport.expense_id'))),
                                                           'fields'=>array('SUM(Profitreport.amount) AS expense'),'conditions'=>array('MONTH(date)'=>$currMonth,'YEAR(date)'=>$currYear,$cond1,$condition)));
        $purchaseArr=$this->PurchasesPayment->find('all',array('joins'=>array(array('table'=>'purchases','alias'=>'Purchase','type'=>'LEFT','conditions'=>array('Purchase.id=PurchasesPayment.purchase_id'))),
                                                          'fields'=>array('SUM(PurchasesPayment.amount) AS purchase'),'conditions'=>array($cond2,$condition2)));
        $purchaseArr1=$this->PurchasesPayment->find('all',array('joins'=>array(array('table'=>'purchases','alias'=>'Purchase','type'=>'LEFT','conditions'=>array('Purchase.id=PurchasesPayment.purchase_id'))),
                                                           'fields'=>array('SUM(PurchasesPayment.amount) AS purchase'),'conditions'=>array('MONTH(date)'=>$currMonth,'YEAR(date)'=>$currYear,$cond2,$condition2)));
        $totalProfit=$earningArr[0][0]['earning']-$expenseArr[0][0]['expense']-$purchaseArr[0][0]['purchase'];
        $profitMonth=$earningArr1[0][0]['earning']-$expenseArr1[0][0]['expense']-$purchaseArr1[0][0]['purchase'];
         $tooltipFormatFunction ="function() { return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+''+ this.y ;}";
        $chartName = "My Chartdl";
        $mychart = $this->HighCharts->create($chartName,'line');
        $this->HighCharts->setChartParams(
                                          $chartName,
                                          array(
                                                'renderTo'=> "mywrapperdl",  // div to display chart inside
                                                'title'=> 'Profit & Loss',
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
        $series->addName('Profit & Loss Report')->addData(array_reverse($performanceChartData));
        $mychart->addSeries($series);
        $this->set('totalProfit',$totalProfit);
        $this->set('profitMonth',$profitMonth);
        $this->set('profitReport',$months);
        $this->loadModel('Project');
        $this->set('projectName',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        $this->set('dateBetween',$dateBetween);
    }
}