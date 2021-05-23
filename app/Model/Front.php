<?php
class Front extends AppModel
{
    public $validationDomain = 'validation';
    public $useTable='properties';
    public $hasMany=array('PropertiesPhoto');
    public $actsAs = array('search-master.Searchable');
}