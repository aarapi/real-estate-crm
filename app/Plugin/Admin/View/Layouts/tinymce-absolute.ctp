<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
echo $this->Html->script('/js/tinymce/tinymce.min');
$preset='absolute';
$tinyoptions=array('language'=>$configLanguage,'directionality'=>$dirType);
if(!empty($preset)){ 
           $preset_options = $this->Tinymce->preset($preset);

           // If $preset_options && $tinyoptions are an array 
           if(is_array($preset_options) && is_array($tinyoptions)){ 
               $tinyoptions = array_merge($preset_options, $tinyoptions); 
           }else{ 
               $tinyoptions = $preset_options; 
           } 
       }
$value_arr = array(); 
$replace_keys = array(); 
foreach($tinyoptions as $key => &$value){ 
    // Checks if the value starts with 'function (' 
    if(strpos($value, 'function(') === 0){ 
        $value_arr[] = $value; 
        $value = '%' . $key . '%';                
        $replace_keys[] = '"' . $value . '"'; 
    } 
} 
$json = $this->Js->object($tinyoptions);
// Replace the functions 
$json = str_replace($replace_keys, $value_arr, $json);
$json=str_replace('"file_browser_callback":"elFinderBrowser"','file_browser_callback : elFinderBrowser',$json);
echo $this->Html->scriptStart();
echo 'function setup() {tinyMCE.init(' . $json . ');$(".tinybtn").hide();};';
echo $this->TinymceElfinder->defineElfinderBrowser(false);        
echo $this->Html->scriptEnd();
echo $this->Js->writeBuffer();
echo $this->fetch('content'); ?>