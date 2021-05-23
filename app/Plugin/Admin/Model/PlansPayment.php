<?php
class PlansPayment extends AppModel
{
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable');
  public $belongsTo=array('Deal');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'PlansPayment.name'));
  public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'amount' =>array('numeric'=>array('rule'=>'numeric','message'=>'Only Number','allowEmpty' => false)),
                           'date' => array('numeric'=>array('rule'=>'date','message'=>'Only Date')),
                           'deal_id' => array('numeric'=>array('rule'=>'numeric','message'=>'Only Number','allowEmpty' => false),
                                            'isUnique'=>array('rule' => 'isUnique','message' => 'This Deal has already been set plan payment! please edit it')),
                           );
  public function beforeValidate($options = array())
  {
      if (!empty($this->data['PlansPayment']['date'])) {
      $this->data['PlansPayment']['date'] = $this->dateFormatBeforeSave($this->data['PlansPayment']['date']);
      }
      return true;
  }  
}
?>