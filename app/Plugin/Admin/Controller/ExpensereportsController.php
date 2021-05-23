<?php
App::uses('CakeTime', 'Utility');
class ExpensereportsController extends AdminAppController
{
    public $components = array('HighCharts.HighCharts');
    public function index()
    {
        $cond=array();$date="";$dateBetween=false;
        $condition=$this->CustomFunction->agencyWisePermission(NULL,$this->userType,$this->agencyId,'Expense.project_id');
        if ($this->request->is('post'))
        {
            if($this->request->data['Expensereport']['project_id'])
            {
                $cond[]=array('Expense.project_id'=>$this->request->data['Expensereport']['project_id']);
            }
            if($this->request->data['Expensereport']['expense_category_id'])
            {
                $cond[]=array('Expense.expense_category_id'=>$this->request->data['Expensereport']['expense_category_id']);
            }
            if($this->request->data['Expensereport']['vendor_id'])
            {
                $cond[]=array('Expense.vendor_id'=>$this->request->data['Expensereport']['vendor_id']);
            }
            if($this->request->data['Expensereport']['date'])
            {
                $date=$this->request->data['Expensereport']['date']['year'];
            }
            if($this->request->data['Expensereport']['start_date'] && $this->request->data['Expensereport']['end_date'])
            {
                $startDate=$this->CustomFunction->dateFormatBeforeSave($this->request->data['Expensereport']['start_date']);
                $endDate=$this->CustomFunction->dateFormatBeforeSave($this->request->data['Expensereport']['end_date']);
                $cond[]=array('Expensereport.date BETWEEN ? AND ?'=>array($startDate,$endDate));
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
            $ExpenseCount=$this->Expensereport->find('count',array('conditions'=>array('MONTH(Expensereport.date)'=>$month,'YEAR(date)'=>$year,$cond,$condition)));
            $expenseArr=$this->Expensereport->find('all',array('fields'=>array('SUM(Expensereport.amount) AS expense'),'conditions'=>array('MONTH(Expensereport.date)'=>$month,'YEAR(Expensereport.date)'=>$year,$cond,$condition)));
            if($expenseArr[0][0]['expense']==null)
            $expense=0;
            else
            $expense=$expenseArr[0][0]['expense'];
            $graphMonth[]=$monthName;
            $months[]['MonthArr'] = array('monthName'=>$monthName,'ExpenseCount'=>$ExpenseCount,'expense'=>$expense);
            $performanceChartData[]=(float) $expense;
        }
        $graphMonth=array_reverse($graphMonth);
        $months=array_reverse($months);
        $currMonth=CakeTime::format('m',$this->siteTimezone);
        $currYear=CakeTime::format('Y',$this->siteTimezone);
        $totalExpenseCount=$this->Expensereport->find('count',array('conditions'=>array($cond,$condition)));
        $expenseArr=$this->Expensereport->find('all',array('fields'=>array('SUM(Expensereport.amount) AS expense'),'conditions'=>array($cond,$condition)));
        $expenseArr1=$this->Expensereport->find('all',array('fields'=>array('SUM(Expensereport.amount) AS expense'),
                                                          'conditions'=>array('MONTH(Expensereport.date)'=>$currMonth,'YEAR(Expensereport.date)'=>$currYear,$cond,$condition)));
        $monthExpenseCount=$this->Expensereport->find('count',array('conditions'=>array('MONTH(Expensereport.date)'=>$currMonth,'YEAR(Expensereport.date)'=>$currYear,$cond,$condition)));
        if($expenseArr[0][0]['expense']==null)
        $totalExpense=0;
        else
        $totalExpense=$expenseArr[0][0]['expense'];
        if($expenseArr1[0][0]['expense']==null)
        $expenseMonth=0;
        else
        $expenseMonth=$expenseArr1[0][0]['expense'];
        $tooltipFormatFunction ="function() { return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+''+ this.y ;}";
        $chartName = "My Chartdl";
        $mychart = $this->HighCharts->create($chartName,'line');
        $this->HighCharts->setChartParams(
                                          $chartName,
                                          array(
                                                'renderTo'=> "mywrapperdl",  // div to display chart inside
                                                'title'=> 'Expenses',
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
        $series->addName('Expense Report')->addData(array_reverse($performanceChartData));
        $mychart->addSeries($series);
        $this->set('totalExpenseCount',$totalExpenseCount);
        $this->set('totalExpense',$totalExpense);
        $this->set('expenseMonth',$expenseMonth);
        $this->set('monthExpenseCount',$monthExpenseCount);
        $this->set('expenseReport',$months);
        $this->loadModel('Project');
        $this->set('projectName',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        $this->loadModel('ExpenseCategory');
        $this->set('expenseCategory',$this->ExpenseCategory->find('list',array('conditions'=>array('status'=>'Active'))));
        $this->loadModel('Vendor');
        $this->set('vendorName',$this->Vendor->find('list'));
        $this->set('dateBetween',$dateBetween);
    }
}