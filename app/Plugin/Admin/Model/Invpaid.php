<?php
class Invpaid extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable = "deals";
  public $belongsTo=array('Client','Property',
                          'DealsPayment'=>array('foreignKey'=>false,'type'=>'INNER','conditions'=> array('DealsPayment.deal_id=Invpaid.id')),
                          'PlansPayment'=>array('foreignKey'=>false,'type'=>'INNER','conditions'=> array('DealsPayment.plans_payment_id=PlansPayment.id')));
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('start_date' => array('type'=>'query','method'=>'CreationDateRangeCondition'),
                             'end_date' => array('type'=>'query','method'=>'CreationDateRangeCondition'));
}
?>