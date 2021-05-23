<?php
class Weblogo extends AppModel
{
    public $validationDomain = 'validation';
    public $useTable="configurations";
    public $actsAs = array('Upload.Upload' => array(
            'photo' => array(
                'pathMethod'=>'flat',
                'path' => '{ROOT}webroot{DS}img{DS}',
                'deleteOnUpdate' => true,
            ),
        )
    );
    public $validate = array('photo' => array(
                                              'isValidExtension' => array('rule' => array('isValidExtension', array('jpg', 'jpeg', 'png'),false),'allowEmpty'=>true,'message' => 'File does not have a valid extension'),
                                              'isValidMimeType' => array('rule' => array('isValidMimeType', array('image/jpeg','image/png','image/bmp','image/gif'),false),'message' => 'You must supply a JPG, GIF  or PNG File.'),
                                              'isBelowMaxHeight' => array('rule'=>array('isBelowMaxHeight',220),'message'=>'You must supply image height is less than 220px'),
                                              )
                             );
}
?>