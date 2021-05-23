<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    function unbindValidation($type, $fields, $require=false) 
    { 
        if ($type === 'remove') 
        { 
            $this->validate = array_diff_key($this->validate, array_flip($fields)); 
        } 
        else 
        if ($type === 'keep') 
        { 
            $this->validate = array_intersect_key($this->validate, array_flip($fields)); 
        } 
         
        if ($require === true) 
        { 
            foreach ($this->validate as $field=>$rules) 
            { 
                if (is_array($rules)) 
                { 
                    $rule = key($rules); 
                     
                    $this->validate[$field][$rule]['required'] = true; 
                } 
                else 
                { 
                    $ruleName = (ctype_alpha($rules)) ? $rules : 'required'; 
                     
                    $this->validate[$field] = array($ruleName=>array('rule'=>$rules,'required'=>true)); 
                } 
            } 
        } 
    }
    public function alphaNumericCustom($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];
        return true;
        //return preg_match('/^[a-zA-Z0-9 \/ \s\\\\,-.:;"~!@#$&%&*{}\\[\\]()_=+|?]*$/i', $value);
    }
    public function passwordHasher($plainPassword)
    {
        $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
        $password = $passwordHasher->hash($plainPassword);
        return $password;
    }
    public function dateFormatBeforeSave($dateString)
    {
      return date('Y-m-d', strtotime($dateString));
    }
    public function dateTimeFormatBeforeSave($dateString)
    {
      return date('Y-m-d H:i:s', strtotime($dateString));
    }
}
