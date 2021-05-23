<?php
class Schedule extends AppModel
{
  public $useTable = 'calendars';
  public $validationDomain = 'validation';
  public function beforeValidate($options = array())
  {
      if (!empty($this->data['Schedule']['start_date'])) {
      $this->data['Schedule']['start_date'] = $this->dateTimeFormatBeforeSave($this->data['Schedule']['start_date']);
      }
      if (!empty($this->data['Schedule']['end_date'])) {
      $this->data['Schedule']['end_date'] = $this->dateTimeFormatBeforeSave($this->data['Schedule']['end_date']);
      }
      return true;
  }
}
?>