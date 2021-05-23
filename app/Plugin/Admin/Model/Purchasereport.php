<?php
class Purchasereport extends AppModel
{
    public $validationDomain = 'validation';
    public $useTable = 'purchases_payments';
    public $belongsTo=array('Purchase');
}
?>