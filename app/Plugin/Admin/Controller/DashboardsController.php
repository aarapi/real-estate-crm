<?php
App::uses('CakeTime', 'Utility');
App::uses('CakeNumber', 'Utility');
class DashboardsController extends AdminAppController
{
    public $components = array('HighCharts.HighCharts');
    public function index()
    {
        $limit=5;
        $this->loadModel('Favourite');
        $this->loadModel('Deal');
        $this->loadModel('DealsPayment');
        $this->loadModel('ExpensesPayment');
        $this->loadModel('PurchasesPayment');
        $currentDateTime=CakeTime::format('Y-m-d',CakeTime::convert(time(),$this->siteTimezone));
        $this->Favourite->deleteAll(array('client_id'=>NULL,'created <'=>$currentDateTime));
        
        $conditionPur=$this->CustomFunction->agencyWisePermission(null,$this->userType,$this->agencyId,'Purchase.project_id');
        $conditionExp=$this->CustomFunction->agencyWisePermission(null,$this->userType,$this->agencyId,'Expense.project_id');
        
        $conditionPro=$this->CustomFunction->userWisePermission(null,$this->luserId,$this->userType,$this->agencyId,'Property.project_id','Property.user_id');
        
       for ($i = 0; $i < 12; ++$i)
        {
            $year=CakeTime::format("-$i months",'%Y',$this->siteTimezone);
            $month=CakeTime::format("-$i months",'%m',$this->siteTimezone);
            $monthName=__(CakeTime::format("-$i months",'%b',$this->siteTimezone)).CakeTime::format("-$i months",'%Y',$this->siteTimezone);;
            $graphMonth[]=$monthName;
            $earningArr=$this->DealsPayment->find('all',array('fields'=>array('SUM(DealsPayment.total_amount) AS earning'),
                                                              'joins'=>array(array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Property.id=DealsPayment.property_id'))),
                                                              'conditions'=>array('MONTH(DealsPayment.payment_date)'=>$month,'YEAR(DealsPayment.payment_date)'=>$year,$conditionPro)));
            if($earningArr[0][0]['earning']==null)
            $earning=0;
            else
            $earning=$earningArr[0][0]['earning'];
            $earningChartData[]=(float) $earning;
            
            $expenseArr=$this->ExpensesPayment->find('all',array('joins'=>array(array('table'=>'expenses','alias'=>'Expense','type'=>'LEFT','conditions'=>array('Expense.id=ExpensesPayment.expense_id'))),
                                                         'fields'=>array('SUM(ExpensesPayment.amount) AS expense'),
                                                         'conditions'=>array('MONTH(date)'=>$month,'YEAR(date)'=>$year,$conditionExp)));
            if($expenseArr[0][0]['expense']==null)
            $expense=0;
            else
            $expense=$expenseArr[0][0]['expense'];
            $expenseChartData[]=(float) $expense;
            
            $purchaseArr=$this->PurchasesPayment->find('all',array('joins'=>array(array('table'=>'purchases','alias'=>'Purchase','type'=>'LEFT','conditions'=>array('Purchase.id=PurchasesPayment.purchase_id'))),
                                                         'fields'=>array('SUM(PurchasesPayment.amount) AS purchase'),
                                                         'conditions'=>array('MONTH(date)'=>$month,'YEAR(date)'=>$year,$conditionPur)));
            if($purchaseArr[0][0]['purchase']==null)
            $purchase=0;
            else
            $purchase=$purchaseArr[0][0]['purchase'];
            $purchaseChartData[]=(float) $purchase;
            
            $profitChartData[]=(float) $earning-$purchase-$expense;
        }
        $graphMonth=array_reverse($graphMonth);
        $tooltipFormatFunction ="function() { return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+''+ this.y ;}";
        $chartName = "My Chartsr";
        $mychart = $this->HighCharts->create($chartName,'line');
        $this->HighCharts->setChartParams(
                                          $chartName,
                                          array(
                                                'renderTo'=> "mywrappersr",  // div to display chart inside
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
        $series->addName(__('Sales Report'))->addData(array_reverse($earningChartData));
        $mychart->addSeries($series);
        $series = $this->HighCharts->addChartSeries();
        $series->addName(__('Purchase Report'))->addData(array_reverse($purchaseChartData));
        $mychart->addSeries($series);
        $series = $this->HighCharts->addChartSeries();
        $series->addName(__('Expense Report'))->addData(array_reverse($expenseChartData));
        $mychart->addSeries($series);
        $series = $this->HighCharts->addChartSeries();
        $series->addName(__('Profit & Loss Report'))->addData(array_reverse($profitChartData));
        $mychart->addSeries($series);
        
        
        //$this->loadModel('Lead');
        //$this->Lead->bindModel(array('belongsTo'=>array('Client','Property'=>array('className'=>'Property'),
        //                                                'Type'=>array('foreignKey'=>false,'conditions'=>array('Property.type_id=Type.id')),
        //                                                'Contract'=>array('foreignKey'=>false,'conditions'=>array('Property.contract_id=Contract.id')))));
        //$Lead=$this->Lead->find('all',array(
        //                                    'fields'=>array('Property.name','Client.name','Client.phone','Contract.name','Lead.follow_up'),
        //                                    'conditions'=>array('Lead.follow_up >='=>$currentDateTime),
        //                                    'order'=>array('Lead.follow_up'=>'asc'),
        //                                    'limit'=>$limit));
        //$this->set('Lead',$Lead);
        //
        //$this->Deal->bindModel(array('belongsTo'=>array('Client','Property')));
        //$Deal=$this->Deal->find('all',array(
        //                                    'fields'=>array('Client.name','Property.name','Deal.date','Deal.total_amount'),
        //                                    'order'=>array('Deal.date'=>'desc'),
        //                                    'limit'=>$limit));
        //$this->set('Deal',$Deal);
        //
        //$this->loadModel('Property');
        //$Property=$this->Property->find('all',array('order'=>array('Property.id'=>'desc'),
        //                                            'limit'=>$limit));
        //$this->set('Property',$Property);
        //
        //$Expense=$this->ExpensesPayment->find('all',array(
        //                                        'joins'=>array(array('table'=>'expenses','alias'=>'Expense','type'=>'LEFT','conditions'=>array('Expense.id=ExpensesPayment.expense_id')),
        //                                                       array('table'=>'expense_categories','alias'=>'ExpenseCategory','type'=>'LEFT','conditions'=>array('ExpenseCategory.id=Expense.expense_category_id'))),
        //                                          'fields'=>array('ExpenseCategory.name','ExpensesPayment.amount','ExpensesPayment.date','ExpensesPayment.remarks'),
        //                                          'order'=>array('Expense.id'=>'desc'),
        //                                          'limit'=>$limit));
        //$this->set('Expense',$Expense);
        
        #### Calendar Script #####
       
        try
        {
            $this->loadModel('Property');
            $this->loadModel('Calendar');
            $this->loadModel('Lead');
            $currentDateTime=CakeTime::format('Y-m-d H:i:s',CakeTime::convert(time(),$this->siteTimezone));
            $startDate=date('Y-m-d',strtotime($currentDateTime.'-1 month'));
            $endDate=date('Y-m-d',strtotime($currentDateTime.'+3 month'));
            $condition=$this->CustomFunction->userWisePermission(null,$this->luserId,$this->userType,$this->agencyId,'User.project_id','Calendar.user_id');
            $condition1=$this->CustomFunction->userWisePermission(null,$this->luserId,$this->userType,$this->agencyId,'Lead.project_id','Lead.user_id');
            $value=$this->Calendar->find('all',array('fields'=>array('User.name','Calendar.*'),
                                                     'joins'=>array(array('table'=>'users','alias'=>'User','type'=>'LEFT','conditions'=>array('Calendar.user_id=User.id'))),
                                                                    'conditions'=>array('start_date >='=>$startDate,'start_date <='=>$endDate,$condition)));
            $leads=$this->Lead->find('all',array('fields'=>array('Client.name','Lead.*','Status.*'),
                                                 'joins'=>array(array('table'=>'clients','alias'=>'Client','type'=>'LEFT','conditions'=>array('Lead.client_id=Client.id')),
                                                                array('table'=>'statuses','alias'=>'Status','type'=>'LEFT','conditions'=>array('Lead.status_id=Status.id'))),
                                                 'conditions'=>array('follow_up >='=>$startDate,'follow_up <='=>$endDate,$condition1)));
            $this->set('leads',$leads);
            $this->set('Schedule',$value);
            $this->set('currentDateTime',$currentDateTime);
            
            
            $propertyCount=$this->Property->find('count',array('conditions'=>$conditionPro));
            $this->set('propertyCount',$propertyCount);
        
        $dealCount=$this->Deal->find('count',array('joins'=>array(array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Deal.property_id=Property.id'))),
                                                            
                                                   'conditions'=>$conditionPro));
        $this->set('dealCount',$dealCount);
        
        $expenseArr=$this->ExpensesPayment->find('all',array('joins'=>array(array('table'=>'expenses','alias'=>'Expense','type'=>'LEFT','conditions'=>array('Expense.id=ExpensesPayment.expense_id'))),
                                                             'conditions'=>$conditionExp,
                                                             'fields'=>array('SUM(ExpensesPayment.amount) AS expense')));
        $totalExpenses=$expenseArr[0][0]['expense'];
        if(strlen($totalExpenses)==0)
        $totalExpenses=0;
        else
        $totalExpenses=$expenseArr[0][0]['expense'];
        $this->set('totalExpenses',$totalExpenses);
        
        
            $earningArr=$this->DealsPayment->find('all',array('conditions'=>$conditionPro,
                                                              'fields'=>array('SUM(DealsPayment.total_amount) AS earning'),
                                                              'joins'=>array(array('table'=>'deals','alias'=>'Salesreport','type'=>'LEFT','conditions'=>array('Salesreport.id=DealsPayment.deal_id')),
                                                                             array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Salesreport.property_id=Property.id'))),
                                                             ));
            if($earningArr[0][0]['earning']==null)
            $totalSale=0;
            else
            $totalSale=$earningArr[0][0]['earning'];
            $this->set('totalSale',$totalSale);
            
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
           
        }
    }    
}