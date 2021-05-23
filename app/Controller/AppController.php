<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    //public $components = array('Session','DebugKit.Toolbar','CustomFunction');
    public $components = array('Session','CustomFunction');
    public $siteTimezone,$siteName,$siteEmail,$siteDomain,$userValue,$adminValue,$frontRegistration,$frontSlides;
    public function authenticate()
    {
        // Check if the session variable User exists, redirect to loginform if not
        if( $this->action != 'login' )
        {
            if(!$this->Session->check('frontUser'))
            {
                $this->redirect(array('controller' => 'Clients', 'action' => 'login'));
                exit();
            }
        }
    }
    public function beforeFilter()
    {
        $this->loadModel('Configuration');
        $this->loadModel('Currency');
        $sysSetting=$this->Configuration->find('first');
        $currencyArr=$this->Currency->findById($sysSetting['Configuration']['currency']);
        $this->configLanguage=$sysSetting['Configuration']['language'];
        $this->siteTimezone=$sysSetting['Configuration']['timezone'];
        Configure::write('Config.language', $this->configLanguage);
        Configure::write('Config.timezone', $this->siteTimezone);
        date_default_timezone_set($this->siteTimezone);
        $this->siteDomain=$sysSetting['Configuration']['domain_name'];
        $this->siteAccount=$sysSetting['Configuration']['account_details'];
        $this->contact=$sysSetting['Configuration']['contact'];
        $this->emailNotification=$sysSetting['Configuration']['email_notification'];
        $this->smsNotification=$sysSetting['Configuration']['sms_notification'];
        $this->currentDate=CakeTime::format('Y-m-d',time());
        $this->currentDateTime=CakeTime::format('Y-m-d H:i:s',time());
        $this->dueDays=$sysSetting['Configuration']['due_days'];
        $this->lateFees=$sysSetting['Configuration']['late_fees'];
        $this->set('siteTitle',$sysSetting['Configuration']['meta_title']);
        $this->set('siteDescription',$sysSetting['Configuration']['meta_desc']);
        $this->set('siteName',$sysSetting['Configuration']['name']);
        $this->set('siteOrganization',$sysSetting['Configuration']['organization_name']);
        $this->set('siteAuthorName',$sysSetting['Configuration']['author']);
        $this->set('siteYear',$sysSetting['Configuration']['created']);
        $this->set('siteAddress',$sysSetting['Configuration']['address']);
        $this->set('siteAccount',$this->siteAccount);
        $this->set('siteShort',$sysSetting['Configuration']['short_name']);
        $this->siteShort=$sysSetting['Configuration']['short_name'];
        $this->set('frontRegistration',$sysSetting['Configuration']['front_end']);
        $this->set('frontSlides',$sysSetting['Configuration']['slides']);
        $this->set('frontLogo',$sysSetting['Configuration']['photo']);
        $this->set('translate',$sysSetting['Configuration']['translate']);
        $this->set('siteTimezone',$sysSetting['Configuration']['timezone']);
        $this->set('siteDomain',$sysSetting['Configuration']['domain_name']);
        $this->set('contact',$this->contact);
        $this->set('emailNotification',$this->emailNotification);
        $this->set('smsNotification',$this->smsNotification);
        $this->set('dueDays',$this->dueDays);
        $this->set('lateFees',$this->lateFees);
        $this->set('currentDate',$this->currentDate);
        $this->set('currentDateTime',$this->currentDateTime);
        $currency='<img src="'.$this->webroot.'img/currencies/'.$currencyArr['Currency']['photo'].'"> ';
        $this->currency=$currency;
        $this->currencyFull='<img src="'.$this->siteDomain.'/img/currencies/'.$currencyArr['Currency']['photo'].'"> ';
        $this->currencyType=$currencyArr['Currency']['short'];
        $this->currencyName=$currencyArr['Currency']['photo'];
        $this->set('currency',$currency);
        $this->set('currencyType',$this->currencyType);
        $this->emiArr=array('M'=>__('Monthly'),'Q'=>__('Quarterly'),'S'=>__('Semi Annually'),'A'=>__('Annually'));
        $this->set('emiArr',$this->emiArr);
        $sysDateArr=explode(",",$sysSetting['Configuration']['date_format']);
        $this->sysDay=$sysDateArr[0];$this->sysMonth=$sysDateArr[1];$this->sysYear=$sysDateArr[2];
        $this->sysHour=$sysDateArr[3];$this->sysMin=$sysDateArr[4];$this->sysSec=$sysDateArr[5];$this->sysMer=$sysDateArr[6];
        $this->set('sysDay',$this->sysDay);$this->set('sysMonth',$this->sysMonth);$this->set('sysYear',$this->sysYear);
        $this->set('sysHour',$this->sysHour);$this->set('sysMin',$this->sysMin);$this->set('sysSec',$this->sysSec);$this->set('sysMer',$this->sysMer);
        $this->dateSep=$sysDateArr[7];$this->timeSep=$sysDateArr[8];$this->dateGap=" ";
        $this->set('dateSep',$this->dateSep);$this->set('timeSep',$this->timeSep);$this->set('dateGap',$this->dateGap);
        $dpDay=null;$dpMonth=null;$dpYear=null;$this->dtFormat=null;
        if(strtolower($this->sysDay)==strtolower("Y"))
        $dpDay=4;
        elseif(strtolower($this->sysDay)==strtolower("m"))
        $dpDay=2;
        elseif(strtolower($this->sysDay)==strtolower("d"))
        $dpDay=2;
        if(strtolower($this->sysMonth)==strtolower("Y"))
        $dpMonth=4;
        elseif(strtolower($this->sysMonth)==strtolower("m"))
        $dpMonth=2;
        elseif(strtolower($this->sysMonth)==strtolower("d"))
        $dpMonth=2;
        if(strtolower($this->sysYear)==strtolower("Y"))
        $dpYear=4;
        elseif(strtolower($this->sysYear)==strtolower("m"))
        $dpYear=2;
        elseif(strtolower($this->sysYear)==strtolower("d"))
        $dpYear=2;
        if($dpDay==null || $dpMonth==null || $dpYear==null)
        {
            $this->dpFormat="YYYY-MM-DD";
            $this->dtFormat="Y-m-d";
        }
        else
        {
            $this->dpFormat=strtoupper(str_repeat($this->sysDay,$dpDay).$this->dateSep.str_repeat($this->sysMonth,$dpMonth).$this->dateSep.str_repeat($this->sysYear,$dpYear));
            $this->dtFormat=$this->sysDay.$this->dateSep.$this->sysMonth.$this->dateSep.$this->sysYear;
        }
        $this->set('dpFormat', $this->dpFormat);
        $this->set('dtFormat', $this->dtFormat);
        if($sysSetting['Configuration']['min_limit'])
        $minLimit=$sysSetting['Configuration']['min_limit'];
        else
        $minLimit=20;
        if($sysSetting['Configuration']['max_limit'])
        $maxLimit=$sysSetting['Configuration']['max_limit'];
        else
        $maxLimit=500;
        $this->pageLimit=$minLimit;
        $this->maxLimit=$maxLimit;
        $this->siteName=$sysSetting['Configuration']['name'];
       
        $this->siteEmail=$sysSetting['Configuration']['email'];
        $this->frontRegistration=$sysSetting['Configuration']['front_end'];
        $this->frontSlides=$sysSetting['Configuration']['slides'];
        $this->mapKey=$sysSetting['Configuration']['map_key'];
        $this->set('mapKey',$this->mapKey);
        if($sysSetting['Configuration']['captcha_type']==1)
        $this->captchaType="image";
        else
        $this->captchaType="math";
        $this->set('captchaType',$this->captchaType);
        $menuArr=array(array('Page'=>array('model_name'=>__('Dashboard'),'controller_name'=>'Dashboards','action_name'=>'index','icon'=>'fa fa-dashboard','sel_name'=>'')),
                       array('Page'=>array('model_name'=>__('Search Properties'),'controller_name'=>'Properties','action_name'=>'index','icon'=>'fa fa-building','sel_name'=>'')),
                       array('Page'=>array('model_name'=>__('Favourite Properties'),'controller_name'=>'Favouriteproperties','action_name'=>'index','icon'=>'fa fa-heart','sel_name'=>'')),
                       array('Page'=>array('model_name'=>__('My Deals'),'controller_name'=>'MyDeals','action_name'=>'index','icon'=>'fa fa-thumbs-up','sel_name'=>'')),
                       array('Page'=>array('model_name'=>__('My Payments'),'controller_name'=>'MyPayments','action_name'=>'index','icon'=>'fa fa-dollar','sel_name'=>'')),
                       array('Page'=>array('model_name'=>__('Invoices Past Due'),'controller_name'=>'MyInvpastdues','action_name'=>'index','icon'=>'fa fa-thumb-tack','sel_name'=>'')),
                       array('Page'=>array('model_name'=>__('My Profile'),'controller_name'=>'MyProfiles','action_name'=>'index','icon'=>'fa fa-user','sel_name'=>'')),
                       array('Page'=>array('model_name'=>__('Change Password'),'controller_name'=>'Changepasswords','action_name'=>'index','icon'=>'fa fa-cog','sel_name'=>'')),
                       array('Page'=>array('model_name'=>__('Signout'),'controller_name'=>'Clients','action_name'=>'logout','icon'=>'fa fa-power-off','sel_name'=>'')),
                       );
        $frontmenuArr=array("Dashboard"=>array('model_name'=>__('Dashboard'),'controller'=>'Dashboards','action'=>'index','icon'=>'fa fa-dashboard','sel_name'=>''));
        $this->set('menuArr',$menuArr);
        $this->set('siteEmail',$this->siteEmail);
        $this->set('frontmenuArr',$frontmenuArr);
        if($sysSetting['Configuration']['dir_type']==1)
        $this->dirType="ltr";
        else
        $this->dirType="rtl";
        $this->set('dirType',$this->dirType);
        $this->set('captchaType',$this->captchaType);
        $this->set('configLanguage',$this->configLanguage);
        $this->userValue=$this->Session->read('frontUser');
        $this->adminValue=$this->Session->read('User');
        $this->loadModel('Content');
        $contents=array();$menuArr=array();
       
        $contents=$this->Content->find('all',array('fileds'=>array('link_name,is_url,url,page_url'),'conditions'=>array('published'=>'Published'),
                                            'order'=>'ordering asc'));
        $this->set('contents',$contents);
        $this->set('contentId','');
        $this->emailSettings();
        $this->smsSettings();
    }
    /* Email Setting */
    public function emailSettings()
    {
        if($this->emailNotification)
        {
            $this->loadModel('Emailsetting');
            $emailSettingArr=$this->Emailsetting->findById(1);
            $this->emailSettype=$emailSettingArr['Emailsetting']['type'];
            if($this->emailSettype=="Smtp")
            {
                $this->emailHost=$emailSettingArr['Emailsetting']['host'];
                $this->emailPort=$emailSettingArr['Emailsetting']['port'];
                $this->emailUsername=$emailSettingArr['Emailsetting']['username'];
                $this->emailPassword=$emailSettingArr['Emailsetting']['password'];
            }
        }
    }
    /* End Email Settings */
    /* Email Setting */
    public function smsSettings()
    {
        if($this->smsNotification)
        {
            $this->loadModel('Smssetting');
            $smsSettingArr=$this->Smssetting->findById(1);
            $this->smsSettingArr=$smsSettingArr;
        }
    }
    /* End Email Settings */
}
?>