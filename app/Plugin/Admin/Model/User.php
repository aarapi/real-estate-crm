<?php
class User extends AppModel {
    public $validationDomain = 'validation';
    public $belongsTo=array('Ugroup','Location');
    public $actsAs = array('search-master.Searchable','Upload.Upload' => array(
            'photo' => array('pathMethod'=>'flat','thumbnailSizes' => array('' => '150x150',),'thumbnailMethod' => 'php','thumbnailPrefixStyle' => false,'thumbnailType'=>true),));
    public $filterArgs = array('keyword' => array('type' => 'like','field'=>'User.name'));
    public $validate = array(
                             'name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'username' => array('isUnique'=>array('rule' => 'isUnique','message' => 'This Username has already been taken.'),
                                            'alphaNumeric'=>array('rule'=>'alphaNumericCustom','message'=>'Only letters and numbers allowed')),
                           'address' => array('alphaNumeric'=>array('rule' => 'alphaNumericCustom','message' => 'Address Required.')),
                           'phone' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => false,'allowEmpty' => true,'message' => 'Only numbers allowed')),
                           'mobile' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => false,'allowEmpty' => true,'message' => 'Only numbers allowed')),
                           'email' => array('rule' => 'email','message' => 'Enter a valid email','required' => true,'allowEmpty' => true),
                           'skype' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' =>false,'allowEmpty' => true,'message' => 'Only correct Skype ID is allowed.')),
                           'twitter' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' =>false,'allowEmpty' => true,'message' => 'Only correct Twitter ID is allowed.')),
                           'facebook' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' =>false,'allowEmpty' => true,'message' => 'Only correct Facebook ID is allowed.')),
                           'linkedin' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' =>false,'allowEmpty' => true,'message' => 'Only correct Linkedin ID is allowed.')),
                           'description' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => false,'allowEmpty' => true,'message' => 'Only correct Skype ID is allowed.')),
                           'photo' => array('isValidExtension' =>array('rule' => array('isValidExtension', array('jpg', 'jpeg', 'png','gif'),false),'allowEmpty'=>true,'message' => 'File does not have a valid extension'),
                                           'isValidMimeType' => array('rule' => array('isValidMimeType', array('image/jpeg','image/png','image/bmp','image/gif'),false),'allowEmpty'=>true,'message' => 'You must supply a JPG, GIF  or PNG File.')),
                            );
    public function assingPages($id)
    {
        $Page=ClassRegistry::init('Page');
        return$Page->find('all',array('joins'=>array(array('table'=>'page_rights','alias'=>'PageRight','type'=>'Left',
                                                        'conditions'=>array('Page.id=PageRight.page_id',"PageRight.ugroup_id=$id"))),
                                      'fields'=>array('Page.*,PageRight.*'),                                      
                                   'order'=>'Page.model_name asc',
                                   'conditions'=>array('Page.published'=>'Yes','Page.page_name NOT'=>NULL)));
    }
    public function beforeSave($options = array())
    {
        if (!empty($this->data['User']['password'])) {
        $this->data['User']['password'] = $this->passwordHasher($this->data['User']['password']);
        }
        else
        {
          unset($this->data['User']['password']);  
        }
        return true;
    }
}
?>