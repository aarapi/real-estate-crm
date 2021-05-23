<?php
class Purchase extends AppModel
{
  public $validationDomain = 'validation';
  public $belongsTo=array('Project','Unit');
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Purchase.name'));
  
  public $validate = array('project_id' => array('rule' => 'numeric','message' => 'Please Select an item in the list'),
                           'name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'address' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'mobile' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'property_name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'area' =>array('numeric'=>array('rule'=>'numeric','message'=>'Only Number')),
                           'unit_id' => array('rule' => 'numeric','message' => 'Please Select an item in the list'),
                           'amount' =>array('numeric'=>array('rule'=>'numeric','message'=>'Only Number')),
                           'description' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'remarks' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')));
}
?>