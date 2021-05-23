<?php
class MyInvpastdue extends AppModel
{
 public $validationDomain = 'validation';
 public $useTable = "plans_payments";
  public $belongsTo=array('Deal'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('MyInvpastdue.deal_id=Deal.id')),
                          'DealsPayment'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('MyInvpastdue.id=DealsPayment.plans_payment_id')),
                          'Client'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Deal.client_id=Client.id')),
                          'Property'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Deal.property_id=Property.id')),
                          'Project'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Property.project_id=Project.id')));
}
?>