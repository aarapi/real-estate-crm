<?php
class Expensereport extends AppModel
{
    public $validationDomain = 'validation';
    public $useTable = 'expenses_payments';
    public $belongsTo=array('Expense');
}
?>