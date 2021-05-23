<?php
class Register extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable="clients";
  var $captcha = '';
  public $actsAs = array('Upload.Upload' => array(
            'photo' => array(
                'pathMethod'=>'flat',
                'thumbnailSizes' => array(
                    '' => '150x150',
                ),
                'path' => '{ROOT}webroot{DS}img{DS}client{DS}',
                'thumbnailPath' => '{ROOT}webroot{DS}img{DS}client_thumb{DS}',
                'thumbnailMethod' => 'php',
                'thumbnailPrefixStyle' => false,
                'thumbnailType'=>true
            ),
        )
    );
  public $validate = array('email' => array('isUnique'=>array('rule' => 'isUnique','message' => 'This Email has already been exist! try new one'),
		   'email'=>array('rule'=>'email','message'=>'Enter a valid email')),
		   'name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
		  'password' => array('alphaNumeric'=>array('rule'=>'alphaNumericCustom','required' => true,'message'=>'Password required'),
								'between'=>array('rule'=>array('minLength','4'),'message'=>'Password minimum 4 character long')),
		  'mobile' => array('numeric'=>array('rule'=>'numeric','allowEmpty' => false,'required' => true,'message'=>'Only Number')),
		   'address' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed'))
		  );
		  
  function matchCaptcha($inputValue)	{
	  return $inputValue['captcha']==$this->getCaptcha(); //return true or false after comparing submitted value with set value of captcha
  }

  function setCaptcha($value)	{
	  $this->captcha = $value; //setting captcha value
  }

  function getCaptcha()	{
	  return $this->captcha; //getting captcha value
  }
}
?>