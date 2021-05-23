<?php
class Etcpayment extends AppModel {
    public $validationDomain = 'validation';
    public $belongsTo=array('Unit');
    public $actsAs = array('search-master.Searchable');
    public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Etcpayment.name'));
    public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'short' => array('alphaNumeric'=>array('rule' => 'alphaNumeric','message' => 'short Required.')),
                           'rate' => array('numeric' => array('rule' => 'numeric','required' => true,'message' => 'Only numbers allowed')));
                           
                        
   
}
?>