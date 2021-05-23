<?php
class PropertiesFlat extends AppModel
{
  public $validationDomain = 'validation';
  public $belongsTo=array('Unit','Property');
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'PropertiesFlat.name'));
  public $validate = array('type' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Please select one of these options.')),
                           'name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'area' =>array('numeric'=>array('rule'=>'numeric','message'=>'Only Number')),
                           'unit_id' => array('rule' => 'numeric','message' => 'Please Select an item in the list'),
                           'price' =>array('numeric'=>array('rule'=>'numeric','message'=>'Only Number')),
                           'floor_no' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'bedroom' =>array('numeric'=>array('rule'=>'numeric','required' => true,'allowEmpty' => true,'message'=>'Only Number')),
                           'bathroom' =>array('numeric'=>array('rule'=>'numeric','required' => true,'allowEmpty' => true,'message'=>'Only Number')),
                           'studyroom' =>array('numeric'=>array('rule'=>'numeric','required' => true,'allowEmpty' => true,'message'=>'Only Number')),
                           'furnished' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Please select one of these options.')),
                           'remarks' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')));
}
?>