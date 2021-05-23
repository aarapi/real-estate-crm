<?php
class Agent extends AppModel {
    public $useTable='users';
    public $validationDomain = 'validation';
    public $actsAs = array('search-master.Searchable','Upload.Upload' => array(
    'photo' => array('pathMethod'=>'flat','thumbnailSizes' => array('' => '150x150',),'thumbnailMethod' => 'php','thumbnailPrefixStyle' => false,'thumbnailType'=>true),));
    public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Agent.name'));
    public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'address' => array('alphaNumeric'=>array('rule' => 'alphaNumericCustom','message' => 'Address Required.')),
                           'status' => array('alphaNumeric'=>array('rule' => 'alphaNumeric','required' =>true)),
                           'phone' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => false,'allowEmpty' => true,'message' => 'Only numbers allowed')),
                           'mobile' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'message' => 'Only numbers allowed')),
                           'email' => array('email'=>array('required'=>false,'allowEmpty'=>true,'rule'=>'email','message'=>'Enter a valid email'),
                                           /*'isUnique'=>array('rule' => 'isUnique','message' => 'This Email has already been exist! try new one'),*/),
                           'skype' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' =>false,'allowEmpty' => true,'message' => 'Only correct Skype ID is allowed.')),
                           'twitter' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' =>false,'allowEmpty' => true,'message' => 'Only correct Twitter ID is allowed.')),
                           'facebook' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' =>false,'allowEmpty' => true,'message' => 'Only correct Facebook ID is allowed.')),
                           'linkedin' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' =>false,'allowEmpty' => true,'message' => 'Only correct Linkedin ID is allowed.')),
                           'amount' => array('numeric' => array('rule' => 'numeric','required' => true,'message' => 'Only numbers allowed')),
                           'action' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message' => 'Please select')),
                           'remarks' => array('alphaNumeric'=>array('rule' =>'alphaNumeric','required'=>true,'allowEmpty'=>false,'message'=>'Only Alphabets')),
                           'description' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only correct Skype ID is allowed.')),
                           'photo' => array('isValidExtension' =>array('rule' => array('isValidExtension', array('jpg', 'jpeg', 'png','gif'),false),'allowEmpty'=>true,'message' => 'File does not have a valid extension'),
                                           'isValidMimeType' => array('rule' => array('isValidMimeType', array('image/jpeg','image/png','image/bmp','image/gif'),false),'allowEmpty'=>true,'message' => 'You must supply a JPG, GIF  or PNG File.')),
                          );
    public $hasOne=array('Awallet');
}
?>