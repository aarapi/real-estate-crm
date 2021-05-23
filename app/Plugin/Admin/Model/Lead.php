<?php
class Lead extends AppModel
{
  public $validationDomain = 'validation';
  public $belongsTo=array('Property'=>array('className'=>'Property'),'Status','Contract'=>array('foreignKey'=>false,'conditions'=>array('Property.contract_id=Contract.id')),
                          'Type'=>array('foreignKey'=>false,'conditions'=>array('Property.type_id=Type.id')),'Client');
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Client.name'));
  public $validate = array('project_id' => array('numeric' => array('rule' => 'numeric','required' => true,'allowEmpty' => false,'message' => 'Please select any agency')),
                           'user_id' => array('numeric' => array('rule' => 'numeric','required' => true,'allowEmpty' => false,'message' => 'Please select any agent')),
                           'client_id' => array('numeric' => array('rule' => 'numeric','required' => true,'allowEmpty' => false,'message' => 'Please select any client')),
                           'follow_up' => array('date'=>array('rule'=>'datetime','message'=>'Only Date & Time')),
                           'remarks' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'status_id' => array('numeric' => array('rule' => 'numeric','required' => true,'allowEmpty' => false,'message' => 'Please select any status')));
  public function beforeValidate($options = array())
  {
      if (!empty($this->data['Lead']['follow_up'])) {
      $this->data['Lead']['follow_up'] = $this->dateTimeFormatBeforeSave($this->data['Lead']['follow_up']);
      }
      return true;
  }
}
?>