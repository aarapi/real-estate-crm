<?php
class MyPayment extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable="deals_payments";
  public $belongsTo=array('Paymenttype');
}
?>