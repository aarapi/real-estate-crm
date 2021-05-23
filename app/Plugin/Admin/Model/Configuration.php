<?php
class Configuration extends AppModel
{
    public $validationDomain = 'validation';
    public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'organization_name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'email' => array('rule' => 'email','message' => 'Enter a valid email','allowEmpty' => true),
                           'domain_name' => array('rule' => 'url','required' => true,'message' => 'Only URL allowed'),
                           'timezone' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'message' => 'Only letters and numbers allowed')),
                           'date_format' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'message' => 'Only letters and numbers allowed')),
                           'address' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'account_details' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'contact' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'currency' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'message' => 'Only letters and numbers allowed')));
}
?>