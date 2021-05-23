<?php
class Favouriteproperty extends AppModel
{
    public $validationDomain = 'validation';
    public $useTable="properties";
    public $actsAs = array('search-master.Searchable');
    
}
