<?php
class Type extends AppModel
{
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable','Upload.Upload' => array(
             'photo' => array('pathMethod'=>'flat','thumbnailSizes' => array('' => '300x300',),'thumbnailMethod' => 'php','thumbnailPrefixStyle' => false,'thumbnailType'=>true)));
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Type.name'));
  public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed'),'isUnique'=>array('rule' => 'isUnique','message' => 'This Type has already been exist! try new one'),),
                           'photo' => array('isValidExtension' =>array('rule' => array('isValidExtension', array('jpg', 'jpeg', 'png','gif'),false),'allowEmpty'=>true,'message' => 'File does not have a valid extension'),
                                           'isValidMimeType' => array('rule' => array('isValidMimeType', array('image/jpeg','image/png','image/bmp','image/gif'),false),'allowEmpty'=>true,'message' => 'You must supply a JPG, GIF  or PNG File.')),
                           );
}
?>