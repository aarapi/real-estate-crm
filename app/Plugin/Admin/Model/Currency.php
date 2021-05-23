<?php
class Currency extends AppModel
{
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable','Upload.Upload' => array(
            'photo' => array(
                'pathMethod'=>'flat',
                'path' => '{ROOT}webroot{DS}img{DS}currencies{DS}'                
            ),
        )
    );
 public $validate = array('name' => array('alphaNumeric' => array('rule' => '/^[a-z0-9 .-_ ()]*$/i','required' => true,'allowEmpty'=>false,'message' => 'Only letters and numbers allowed'),
                                          'isUnique'=>array('rule' => 'isUnique','message' => 'Currency Name already exist.')),
                          'photo' => array('isValidExtension' =>array('rule' => array('isValidExtension', array('jpg', 'jpeg', 'png','gif'),false),'allowEmpty'=>false,'message' => 'File does not have a valid extension'),
                                           'isValidMimeType' => array('rule' => array('isValidMimeType', array('image/jpeg','image/png','image/bmp','image/gif'),false),'allowEmpty'=>false,'message' => 'You must supply a JPG, GIF  or PNG File.'),
                                           'isBelowMaxHeight' => array('rule'=>array('isBelowMaxHeight',50),'message'=>'You must supply image height is less than 50px'),
                                           'isBelowMaxWidth' => array('rule'=>array('isBelowMaxWidth',50),'message'=>'You must supply image width is less than 50px')),
                          );
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'name'));
}
?>