<?php
/**
	* Helper for Showing the use of Captcha*
	* @author     Arvind Kumar
	* @link       http://www.devarticles.in/
	* @copyright  Copyright © 2013 http://www.devarticles.in/
  * @version 2.0 - Tested OK in Cakephp 2.4.1
	*/
class CaptchaHelper extends AppHelper {
  public $helpers = array('Html', 'Form');
  function render($settings=array()) {
    switch($settings['captchaType']):
      case 'image':
        echo $this->Html->image($this->Html->url(array('action'=>'captcha'), true),array('id'=>'img-captcha','vspace'=>2));
	echo$this->Html->link($this->Html->image('refresh_icon.png',array('title'=>__('Can\'t read? Reload'),'class'=>'img-thumbnail')),'#',array('escape'=>false,'id'=>'a-reload','style'=>'margin-left:5px;'));
        echo $this->Form->input($settings['modelName'].'.'.$settings['fieldName'], array('autocomplete'=>'off','label'=>false,'class'=>'form-control','placeholder'=>__('Enter security code shown above'),'value'=>'','required'=>true,'div'=>false));
        if($settings['jquerylib'])  {
          echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>';
        }
?>
        <script>
        jQuery('#a-reload').click(function() {
          var $captcha = jQuery("#img-captcha");
            $captcha.attr('src', $captcha.attr('src')+'?'+Math.random());
          return false;
        });
        </script>
<?php
      break;
      case 'math':
        echo '<p>'.__('Answer simple math').':</p>'.$settings['stringOperation'].' = ?';
        echo $this->Form->input($settings['modelName'].'.'.$settings['fieldName'],array('autocomplete'=>'off','label'=>false,'class'=>'form-control','placeholder'=>__('Enter security code shown above'),'value'=>'','required'=>true,'div'=>false));
      break;
    endswitch;
  }
}