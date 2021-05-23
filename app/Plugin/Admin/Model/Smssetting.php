<?php
class Smssetting extends AppModel
{
  public $validationDomain = 'validation';
  public $validate = array('api' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' =>true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'username' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>true,'message'=>'Only Alphabets')),
                           'password' => array('alphaNumeric'=>array('rule'=>'alphaNumericCustom','required' => true,'message'=>'Password required','allowEmpty' => true)),
                           'senderid' => array('alphaNumeric' => array('rule' =>'alphaNumericCustom','required' =>true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'husername' => array('alphaNumeric' => array('rule' =>'alphaNumericCustom','required' =>true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'hpassword' => array('alphaNumeric' => array('rule' =>'alphaNumericCustom','required' =>true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'hmobile' => array('alphaNumeric' => array('rule' =>'alphaNumericCustom','required' =>true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'hmessage' => array('alphaNumeric' => array('rule' =>'alphaNumericCustom','required' =>true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'hsenderid' => array('alphaNumeric' => array('rule' =>'alphaNumericCustom','required' =>true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed'))
                           );
}
?>