<?php
class ConfigurationsController extends AdminAppController {
    public $helpers = array('Html','Form','Session');
    public $components = array('Session','search-master.Prg');    
    public function index()
    {
        $this->loadModel('Currency');
        $this->set('currency',$this->Currency->find('list',array('fields'=>array('id','name'))));
        $language=array('af'=>'Afrikaans','sq'=>'Albanian','ar'=>'العربية','hy'=>'Armenian/Armenia','eu'=>'Basque','bs'=>'Bosnian','bg'=>'Bulgarian','be'=>'Byelorussian','ca'=>'Catalan','zh'=>'中文','cs'=>'Czech','da'=>'Danish','nl'=>'Dutch','en'=>'English','et'=>'Estonian','fo'=>'Faeroese','fa'=>'فارسی','fi'=>'Finnish','fr'=>'French','gl'=>'Galician','de'=>'German','el'=>'Greek','he'=>'עִברִית','hi'=>'Hindi','hu'=>'Hungarian','is'=>'Icelandic','id'=>'Indonesian','ga'=>'Irish','it'=>'Italian','ja'=>'日本語','kk'=>'Kazakh','ko'=>'Korean','lv'=>'Latvian','lt'=>'Lithuanian','mk'=>'Macedonian','ms'=>'Malaysian','mt'=>'Maltese','no'=>'Norwegian','pl'=>'Polish','pt'=>'Portuguese','ro'=>'Romanian','ru'=>'Russian','se'=>'Sami','sr'=>'Serbian','sk'=>'Slovak','sl'=>'Slovenian','sb'=>'Sorbian','es'=>'Spanish','sv'=>'Swedish','th'=>'Thai','ts'=>'Tsonga','tn'=>'Tswana','tr'=>'Turkish','uk'=>'Ukrainian','ur'=>'Urdu','ve'=>'Venda','vi'=>'Vietnamese','cy'=>'Welsh','xh'=>'Xhosa','yi'=>'Yiddish','zu'=>'Zulu');
        $id=1;        
        $post = $this->Configuration->findById($id); 
        if ($this->request->is('post'))
        {
            $this->Configuration->id = $id;
            try
            {
                if ($this->Configuration->save($this->request->data))
                {
                    $this->Session->setFlash(__('Your Setting has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Setting Problem.'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
        $this->set('language',$language);
    }    
}
?>