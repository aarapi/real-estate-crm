<?php  
App::uses('AppHelper', 'View/Helper'); 
  
class TinymceHelper extends AppHelper { 
    
    // Take advantage of other helpers 
    public $helpers = array('Js', 'Html', 'Form','TinymceElfinder.TinymceElfinder');    

    // Check if the tiny_mce.js file has been added or not 
    public $_script = false; 

    /** 
    * Adds the tiny_mce.js file and constructs the options 
    * 
    * @param string $fieldName Name of a field, like this "Modelname.fieldname" 
    * @param array $tinyoptions Array of TinyMCE attributes for this textarea 
    * @return string JavaScript code to initialise the TinyMCE area 
    */ 
    function _build($fieldName, $tinyoptions = array()){ 
        if(!$this->_script){ 
            // We don't want to add this every time, it's only needed once 
            $this->_script = true;
            $this->Html->script('tinymce/tinymce.min', array('inline' => false));            
        } 

        // Ties the options to the field 
        $tinyoptions['mode'] = 'exact'; 
        $tinyoptions['elements'] = $this->domId($fieldName); 

        // List the keys having a function 
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
        
        // Encode the array in json
        $json = $this->Js->object($tinyoptions); 
        
        // Replace the functions 
        $json = str_replace($replace_keys, $value_arr, $json);
        $json=str_replace('"file_browser_callback":"elFinderBrowser"','file_browser_callback : elFinderBrowser',$json);
        $this->Html->scriptStart(array('inline' => false));
        echo 'function setup() {tinyMCE.init(' . $json . ');$(".tinybtn").hide();};';
        echo $this->TinymceElfinder->defineElfinderBrowser(false);        
        $this->Html->scriptEnd(); 
    } 
  
    /** 
    * Creates a TinyMCE textarea. 
    * 
    * @param string $fieldName Name of a field, like this "Modelname.fieldname" 
    * @param array $options Array of HTML attributes. 
    * @param array $tinyoptions Array of TinyMCE attributes for this textarea 
    * @param string $preset 
    * @return string An HTML textarea element with TinyMCE 
    */ 
    function textarea($fieldName, $options = array(), $tinyoptions = array(), $preset = null){ 
        // If a preset is defined 
        if(!empty($preset)){ 
            $preset_options = $this->preset($preset); 

            // If $preset_options && $tinyoptions are an array 
            if(is_array($preset_options) && is_array($tinyoptions)){ 
                $tinyoptions = array_merge($preset_options, $tinyoptions); 
            }else{ 
                $tinyoptions = $preset_options; 
            } 
        } 
        return $this->Form->textarea($fieldName, $options) . $this->_build($fieldName, $tinyoptions) . $this->Form->button('Load Editor',array( 'onclick'=>'javascript:setup();','type'=>'button','class'=>'tinybtn')); 
    } 
  
    /** 
    * Creates a TinyMCE textarea. 
    * 
    * @param string $fieldName Name of a field, like this "Modelname.fieldname" 
    * @param array $options Array of HTML attributes. 
    * @param array $tinyoptions Array of TinyMCE attributes for this textarea 
    * @return string An HTML textarea element with TinyMCE 
    */ 
    function input($fieldName, $options = array(), $tinyoptions = array(), $preset = null){ 
        // If a preset is defined 
        if(!empty($preset)){ 
            $preset_options = $this->preset($preset); 

            // If $preset_options && $tinyoptions are an array 
            if(is_array($preset_options) && is_array($tinyoptions)){ 
                $tinyoptions = array_merge($preset_options, $tinyoptions); 
            }else{ 
                $tinyoptions = $preset_options; 
            } 
        }
        $options['type'] = 'textarea';
        return $this->Form->input($fieldName, $options) . $this->_build($fieldName, $tinyoptions) . "<br/>". $this->Form->button('Load Editor',array( 'onclick'=>'javascript:setup();','type'=>'button','class'=>'tinybtn')); 
    } 
    
    /** 
    * Creates a preset for TinyOptions 
    * 
    * @param string $name 
    * @return array 
    */ 
    public function preset($name){ 
        // Full Feature
        if($name == 'full'){ 
            return array( 
                'selector' => 'textarea',
                'theme' => 'modern',
                'plugins' => 'advlist,autolink,lists,link,image,charmap,print,preview,hr,anchor,pagebreak,
                            searchreplace,wordcount,visualblocks,visualchars,code,fullscreen,
                            insertdatetime,media,nonbreaking,save,table,contextmenu,directionality,
                            emoticons,template,paste,textcolor,youtube,colorpicker',
                'relative_urls' => true,
                'browser_spellcheck' => true,
                'toolbar1' => 'insertfile, undo, redo, |, styleselect, fontselect, |, fontsizeselect, |, bold, italic, |, alignleft, aligncenter, alignright, alignjustify, |, bullist, numlist, outdent, indent',
                'toolbar2' => 'link, image, media, youtube, emoticons, |, colorpicker, forecolor, backcolor, |, preview, print, code',
                'image_advtab' => true,
                'file_browser_callback' => 'elFinderBrowser'
                
            ); 
        } 

        // Basic 
        if($name == 'basic'){ 
            return array( 
                'theme' => 'advanced', 
                'plugins' => 'safari,advlink,paste', 
                'theme_advanced_buttons1' => 'code,|,copy,pastetext,|,bold,italic,underline,|,link,unlink,|,bullist,numlist',
                'theme_advanced_buttons2' => '', 
                'theme_advanced_buttons3' => '', 
                'theme_advanced_toolbar_location' => 'top', 
                'theme_advanced_toolbar_align' => 'center', 
                'theme_advanced_statusbar_location' => 'none', 
                'theme_advanced_resizing' => false, 
                'theme_advanced_resize_horizontal' => false, 
                'convert_fonts_to_spans' => false
            ); 
        } 

        // Simple 
        if($name == 'simple'){ 
            return array( 
                'theme' => 'modern',
            ); 
        } 

        // BBCode 
        if($name == 'bbcode'){ 
            return array( 
                'theme' => 'advanced', 
                'plugins' => 'bbcode', 
                'theme_advanced_buttons1' => 'bold,italic,underline,undo,redo,link,unlink,image,forecolor,styleselect,removeformat,cleanup,code',
                'theme_advanced_buttons2' => '', 
                'theme_advanced_buttons3' => '', 
                'theme_advanced_toolbar_location' => 'top', 
                'theme_advanced_toolbar_align' => 'left', 
                'theme_advanced_styles' => 'Code=codeStyle;Quote=quoteStyle', 
                'theme_advanced_statusbar_location' => 'bottom', 
                'theme_advanced_resizing' => true, 
                'theme_advanced_resize_horizontal' => false, 
                'entity_encoding' => 'raw', 
                'add_unload_trigger' => false, 
                'remove_linebreaks' => false, 
                'inline_styles' => false 
            ); 
        }
        // Absolute Url
        if($name == 'absolute'){ 
            return array( 
                'selector' => 'textarea',
                'theme' => 'modern',
                'plugins' => 'advlist,autolink,lists,link,image,charmap,print,preview,hr,anchor,pagebreak,
                            searchreplace,wordcount,visualblocks,visualchars,code,fullscreen,
                            insertdatetime,media,nonbreaking,save,table,contextmenu,directionality,
                            emoticons,template,paste,textcolor,youtube,colorpicker',
                'relative_urls' => false,
                'remove_script_host'=> false,
                'browser_spellcheck'=> true,
                'toolbar1' => 'insertfile, undo, redo, |, styleselect, fontselect, |, fontsizeselect, |, bold, italic, |, alignleft, aligncenter, alignright, alignjustify, |, bullist, numlist, outdent, indent',
                'toolbar2' => 'link, image, media, youtube, emoticons, |, colorpicker, forecolor, backcolor, |, preview, print, code',
                'image_advtab' => true,
                'file_browser_callback' => 'elFinderBrowser'
                
            ); 
        } 
        return null; 
    } 
}