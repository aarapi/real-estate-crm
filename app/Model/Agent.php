<?php
class Agent extends AppModel
{
    public $validationDomain = 'validation';
    public $useTable="users";
    public $actsAs = array('search-master.Searchable');
    
}