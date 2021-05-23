<?php
class Calendar extends AppModel
{
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable');
  public $belongsTo=array('User');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'User.name'));
  public $validate = array('user_id' => array('numeric' => array('rule' => 'numeric','required' => true,'allowEmpty' => false,'message' => 'Please select any agent')),
                           'message_type' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'comments' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'start_date' => array('datetime' => array('rule' => 'datetime','required' => true,'allowEmpty'=>false,'message' => 'Only Date/time format')),
                           'end_date' => array('datetime' => array('rule' => 'datetime','required' => true,'allowEmpty'=>true,'message' => 'Only Date/time format')),
                           'color' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty'=>false,'message' => 'Please pick any color.')),
                           );
  public function beforeValidate($options = array())
  {
      if (!empty($this->data['Calendar']['start_date'])) {
      $this->data['Calendar']['start_date'] = $this->dateTimeFormatBeforeSave($this->data['Calendar']['start_date']);
      }
      if (!empty($this->data['Calendar']['end_date'])) {
      $this->data['Calendar']['end_date'] = $this->dateTimeFormatBeforeSave($this->data['Calendar']['end_date']);
      }
      return true;
  }  
}
?>