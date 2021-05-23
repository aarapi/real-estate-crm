<?php
class PurchasesPayment extends AppModel
{
  public $validationDomain = 'validation';
  public $belongsTo=array('Purchase','Paymenttype');
  public $validate = array('date' => array('date'=>array('rule'=>'datetime','message'=>'Only Date')),
                           'paymenttype_id' =>array('numeric'=>array('rule'=>'numeric','message'=>'Only Number')),
                           'amount' =>array('numeric'=>array('rule'=>'numeric','message'=>'Only Number')),                           
                           'remarks' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')));
  public function beforeValidate($options = array())
  { 
        if (!empty($this->data['PurchasesPayment']['date'])) {
        $this->data['PurchasesPayment']['date'] = $this->dateTimeFormatBeforeSave($this->data['PurchasesPayment']['date']);
        
        }
        return true;
    }
}
?>