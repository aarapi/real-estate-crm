<?php
class Slide extends AppModel
{
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable','Upload.Upload' => array(
            'photo' => array(
                'pathMethod'=>'flat',
                'thumbnailSizes' => array(
                    '' => '1140x350',
                ),
                'path' => '{ROOT}webroot{DS}img{DS}slides{DS}',
                'thumbnailPath' => '{ROOT}webroot{DS}img{DS}slides_thumb{DS}',
                'thumbnailMethod' => 'php',
                'thumbnailPrefixStyle' => false,
                'deleteOnUpdate' => true,
                'thumbnailType'=>true
            ),
        )
    );
 public $validate = array('slide_name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty'=>false,'message' => 'Only letters and numbers allowed')),
                          'photo' => array('isValidExtension' =>array('rule' => array('isValidExtension', array('jpg', 'jpeg', 'png'),false),'allowEmpty'=>false,'message' => 'File does not have a valid extension'),
                                           'isValidMimeType' => array('rule' => array('isValidMimeType', array('image/jpeg','image/png','image/bmp','image/gif'),false),'allowEmpty'=>true,'message' => 'You must supply a JPG, GIF  or PNG File.')),
                          );
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Slide.slide_name'));
}
?>