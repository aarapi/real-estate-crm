<?php
class Invpastdue extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable = "plans_payments";
  public $belongsTo=array('Deal'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Invpastdue.deal_id=Deal.id')),
                          'DealsPayment'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Invpastdue.id=DealsPayment.plans_payment_id')),
                          'Client'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Deal.client_id=Client.id')),
                          'Property'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Deal.property_id=Property.id')),
                          'Project'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Property.project_id=Project.id')),
                          'Type'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Type.id=Property.type_id')),
                          );
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('start_date' => array('type'=>'query','method'=>'CreationDateRangeCondition'),
                             'end_date' => array('type'=>'query','method'=>'CreationDateRangeCondition'));                     
}
?>