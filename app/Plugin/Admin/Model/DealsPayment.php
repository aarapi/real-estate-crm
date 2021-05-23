<?php
class DealsPayment extends AppModel
{
  public $validationDomain = 'validation';
  public $belongsTo=array('Paymenttype');
  public $validate = array('payment_date' => array('numeric'=>array('rule'=>'date','message'=>'Only Date')),
                           'due_date' => array('numeric'=>array('rule'=>'date','message'=>'Only Date')),
                           'amount' =>array('numeric'=>array('rule'=>'numeric','message'=>'Only Number')),
                           'paymenttype_id' =>array('numeric'=>array('rule'=>'numeric','message'=>'Only Number')),
                           'remarks' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')));
  public function beforeValidate($options = array())
  {
      if (!empty($this->data['DealsPayment']['payment_date'])) {
      $this->data['DealsPayment']['payment_date'] = $this->dateFormatBeforeSave($this->data['DealsPayment']['payment_date']);
      }
      if (!empty($this->data['DealsPayment']['due_date'])) {
      $this->data['DealsPayment']['due_date'] = $this->dateFormatBeforeSave($this->data['DealsPayment']['due_date']);
      }
      return true;
  }
}
?>