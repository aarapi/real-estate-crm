<?php
class InventoriesBalance extends AppModel
{
  public $validationDomain = 'validation';
  public $belongsTo=array('Inventory');
  public $validate = array('date' => array('numeric'=>array('rule'=>'date','message'=>'Only Date')),
                           'qty' =>array('numeric'=>array('rule'=>'numeric','message'=>'Only Number')),
                           'remarks' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')));
  public function beforeValidate($options = array())
  {
      if (!empty($this->data['InventoriesBalance']['date'])) {
      $this->data['InventoriesBalance']['date'] = $this->dateFormatBeforeSave($this->data['InventoriesBalance']['date']);
      }
      return true;
  }
}
?>