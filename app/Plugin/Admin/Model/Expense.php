<?php
class Expense extends AppModel
{
  public $validationDomain = 'validation';
  public $belongsTo=array('ExpenseCategory','Project','Vendor');
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Vendor.name'));
  public $validate = array('project_id' => array('rule' => 'numeric','message' => 'Please Select an item in the list'),
                           'vendor_id' => array('rule' => 'numeric','message' => 'Please Select an item in the list'),
                           'invoice_no' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'invoice_date' => array('numeric'=>array('rule'=>'date','message'=>'Only Date','required' => true,'allowEmpty' => false)),
                           'invoice_amount' =>array('numeric'=>array('rule'=>'numeric','message'=>'Only Number','required' => true,'allowEmpty' => false)),
                           'expense_category_id' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'remarks' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')));
  public function beforeValidate($options = array())
  {
      if (!empty($this->data['Expense']['invoice_date'])) {
      $this->data['Expense']['invoice_date'] = $this->dateFormatBeforeSave($this->data['Expense']['invoice_date']);
      }
      return true;
  }
}
?>