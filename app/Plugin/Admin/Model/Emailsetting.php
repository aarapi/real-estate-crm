<?php
class Emailsetting extends AppModel
{
  public $validationDomain = 'validation';
  public $validate = array('type' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' =>true,'allowEmpty' =>true,'message' => 'Only letters and numbers allowed')),
                           'host' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'username' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>true,'message'=>'Only Alphabets')),
                            'password' => array('alphaNumeric'=>array('rule'=>'alphaNumericCustom','required' => true,'message'=>'Password required','allowEmpty' => true)),
                           'port' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' =>true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed'))
                           );
}
?>