<?php
class Searchhistory extends AppModel
{
  public $useTable = "search_histories";
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Searchhistory.name'));
}
?>