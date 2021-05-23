<?php
class Plan extends AppModel {
    public $validationDomain = 'validation';
    public $actsAs = array('search-master.Searchable');
    public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Plan.name'));
    public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                            'status' => array('alphaNumeric'=>array('rule' => 'alphaNumeric','required' =>true)));
                           
   
}
?>