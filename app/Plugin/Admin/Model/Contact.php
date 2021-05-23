<?php
class Contact extends AppModel
{
  public $useTable="clients";
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable');
  public $belongsTo=array('Category');
  public $filterArgs = array('cid' => array('field'=>'Contact.category_id'),
                             'cname' => array('type' => 'like','field'=>'Contact.name'),
                             );
  public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'category_id' => array('numeric'=>array('rule'=>'numeric','message'=>'Only Number','allowEmpty' => false,'required' => true)),
                           'address' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'district' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'state' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'pincode' => array('numeric'=>array('rule'=>'numeric','message'=>'Only Number','allowEmpty' => true)),
                           'email' => array('email'=>array('rule' => 'email','message' => 'Enter a valid email','allowEmpty' => true),
                                            'isUnique'=>array('rule' => 'isUnique','message' => 'This Email has already been exist! try new one')),
                           'mobile' => array('numeric'=>array('rule'=>'numeric','message'=>'Only Numbers allowed','allowEmpty' => false,'required' => true)),
                           'phone' => array('numeric' => array('rule' => 'numeric','required' => true,'allowEmpty' => true,'message' => 'Only numbers allowed')),
                           );
}
?>