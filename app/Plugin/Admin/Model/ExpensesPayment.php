<?php
class ExpensesPayment extends AppModel
{
  public $validationDomain = 'validation';
  public $belongsTo=array('Expense','Paymenttype');
  public $validate = array('date' => array('numeric'=>array('rule'=>'date','message'=>'Only Date')),
                           'paymenttype_id' =>array('numeric'=>array('rule'=>'numeric','message'=>'Only Number')),
                           'amount' =>array('numeric'=>array('rule'=>'numeric','message'=>'Only Number')),
                           'remarks' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')));
  public function beforeValidate($options = array())
  {
      if (!empty($this->data['ExpensesPayment']['date'])) {
      $this->data['ExpensesPayment']['date'] = $this->dateFormatBeforeSave($this->data['ExpensesPayment']['date']);
      }
      return true;
  }
}
?>