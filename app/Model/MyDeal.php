<?php
class MyDeal extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable="deals";
   public $belongsTo=array('Client','Property'=>array('className'=>'Property'),
                           'Plan','User',
                           'Unit'=>array('foreignKey'=>false,'conditions'=> array('Property.unit_id=Unit.id')));
}
?>