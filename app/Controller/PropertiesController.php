<?php
App::uses('CakeTime', 'Utility');
App::uses('CakeEmail', 'Network/Email');
ini_set('max_execution_time', 300);

class PropertiesController extends AppController
{
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg','CustomFunction');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Property.id'=>'desc'));
    public function index($id=null)
    {
        try
        {
            $this->loadModel('User');
            $this->loadModel('Type');
            $this->loadModel('Contract');
            $this->loadModel('Location');
            $this->loadModel('Project');
            $condition=array();$searchArr=array();
            $searchLink="";$notSearch=true;
            if(isset($this->params['named']['history']) && $this->params['named']['history']==1)
            {
                $notSearch=false;
            }
            if(isset($this->params['named']['type']) && strlen($this->params['named']['type'])>0)
            {
                $condition[]=array('Property.type_id'=>$this->params['named']['type']);
                $type=$this->Type->findById($this->params['named']['type']);
                $searchArr[]=array('type'=>$type['Type']['name']);
                $searchLink.='type:'.$this->params['named']['type'].'/';
            }
            if(isset($this->params['named']['contract']) && strlen($this->params['named']['contract'])>0)
            {
                $condition[]=array('Property.contract_id'=>$this->params['named']['contract']);
                $contract=$this->Contract->findById($this->params['named']['contract']);
                $searchArr[]=array('contract'=>$contract['Contract']['name']);
                $searchLink.='contract:'.$this->params['named']['contract'].'/';
            }
            if(isset($this->params['named']['location']) && strlen($this->params['named']['location'])>0)
            {
                $condition[]=array('Property.location_id'=>$this->params['named']['location']);
                $location=$this->Location->findById($this->params['named']['location']);
                $searchArr[]=array('location'=>$location['Location']['name']);
                $searchLink.='location:'.$this->params['named']['location'].'/';
            }
            if(isset($this->params['named']['keyword']) && strlen($this->params['named']['keyword'])>0)
            {
                $condition[]=array('OR'=>array(array('Property.'.'address'.' LIKE'=>"%".$this->params['named']['keyword']."%"),
                                               array('Property.'.'name'.' LIKE'=>"%".$this->params['named']['keyword']."%"),
                                               array('Property.'.'description'.' LIKE'=>"%".$this->params['named']['keyword']."%")));
                $searchArr[]=array('keyword'=>$this->params['named']['keyword']);
                $searchLink.='keyword:'.$this->params['named']['keyword'].'/';
            }
            if(isset($this->params['named']['start_price']) && strlen($this->params['named']['start_price'])>0 && isset($this->params['named']['end_price']) && strlen($this->params['named']['end_price'])>0)
            {
                $startDate=$this->params['named']['start_price'];
                $endDate=$this->params['named']['end_price'];
                $condition[]=array('Property.price BETWEEN ? AND ?'=>array($startDate,$endDate));
                $searchArr[]=array('start_price'=>$this->params['named']['start_price'],'end_price'=>$this->params['named']['end_price']);
                $searchLink.='start_price:'.$this->params['named']['start_price'].'/'.'end_price:'.$this->params['named']['end_price'].'/';
            }
            if(isset($this->params['named']['bedroom']) && strlen($this->params['named']['bedroom'])>0)
            {
                $condition[]=array('bedroom'=>$this->params['named']['bedroom']);
                $searchArr[]=array('bedroom'=>$this->params['named']['bedroom']);
                $searchLink.='bedroom:'.$this->params['named']['bedroom'].'/';
            }
            if(isset($this->params['named']['bathroom']) && strlen($this->params['named']['bathroom'])>0)
            {
                $condition[]=array('bathroom'=>$this->params['named']['bathroom']);
                $searchArr[]=array('bathroom'=>$this->params['named']['bathroom']);
                $searchLink.='bathroom:'.$this->params['named']['bathroom'].'/';
            }
            if(isset($this->params['named']['uniq_id']) && strlen($this->params['named']['uniq_id'])>0)
            {
                $condition[]=array('uniq_id'=>$this->params['named']['uniq_id']);
                $searchArr[]=array('uniq_id'=>$this->params['named']['uniq_id']);
                $searchLink.='uniq_id:'.$this->params['named']['uniq_id'].'/';
            }
            if(isset($this->params['named']['agent']) && strlen($this->params['named']['agent'])>0)
            {
                $condition[]=array('user_id'=>$this->params['named']['agent']);
                $agent=$this->User->findById($this->params['named']['agent']);
                $searchArr[]=array('agent'=>$agent['User']['name']);
                $searchLink.='agent:'.$this->params['named']['agent'].'/';
            }
            if(isset($this->params['named']['agency']) && strlen($this->params['named']['agency'])>0)
            {
                $condition[]=array('Property.project_id'=>$this->params['named']['agency']);
                $agency=$this->Project->findById($this->params['named']['agency']);
                $searchArr[]=array('agency'=>$agency['Project']['name']);
                $searchLink.='agency:'.$this->params['named']['agency'].'/';
            }
            $condition[]=array('Property.published'=>'Yes');
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate;
            $this->Paginator->settings['conditions'] = array($this->Property->parseCriteria($this->Prg->parsedParams()),$condition);
            $this->Paginator->settings['limit']=$this->pageLimit;
            $this->Paginator->settings['maxLimit']=$this->maxLimit;
            $this->set('property', $this->Paginator->paginate());
            $this->set('type',$this->Type->find('list',array('order'=>array('Type.name'=>'asc'))));
            $this->set('contract',$this->Contract->find('list'));
            $this->set('location',$this->Location->find('list',array('order'=>array('Location.name'=>'asc'))));
            if(!$this->Paginator->paginate())
            {
                $this->Session->setFlash(__('No record found'),'flash', array('alert'=> 'danger'));
                $searchRecord=0;
                if($notSearch) {
                    $email=$this->siteEmail;
                    $this->loadModel('Emailtemplate');
                    $emailArr=$this->Emailtemplate->findByType('PNF');
                    
                    if($emailArr['Emailtemplate']['status']=="Published")
                    {
                        $message=$emailArr['Emailtemplate']['description'];
                        foreach($searchArr as $list) {
                            foreach($list as $key=>$value) {
                                if($key=='type') {
                                    $message.='<br>'.__('Type').' = '.$value;
                                }
                                if($key=='contract') {
                                    $message.='<br>'.__('Contract').' = '.$value;
                                }
                                if($key=='location') {
                                    $message.='<br>'.__('Location').' = '.$value;
                                }
                                if($key=='keyword') {
                                    $message.='<br>'.__('Keyword').' = '.$value;
                                }
                                if($key=='start_price') {
                                    $message.='<br>'.__('Start Price').' = '.$value;
                                }
                                if($key=='end_price') {
                                    $message.='<br>'.__('End Price').' = '.$value;
                                }
                                if($key=='bedroom') {
                                    $message.='<br>'.__('Bedroom').' = '.$value;
                                }
                                if($key=='bathroom') {
                                    $message.='<br>'.__('Bathroom').' = '.$value;
                                }
                                if($key=='uniq_id') {
                                    $message.='<br>'.__('Property ID').' = '.$value;
                                }
                                if($key=='agent') {
                                    $message.='<br>'.__('Agent').' = '.$value;
                                }
                                if($key=='agency') {
                                    $message.='<br>'.__('Agency').' = '.$value;
                                }
                            }
                        }
                        $Email = new CakeEmail();
                        $Email->transport($this->emailSettype);
                        if($this->emailSettype=="Smtp")
                        $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword,'timeout'=>90));
                        $Email->from(array($this->siteEmail =>$this->siteName));
                        $Email->to($email);
                        $Email->template('default');
                        $Email->emailFormat('html');
                        $Email->subject($emailArr['Emailtemplate']['name']);
                        $Email->send($message);
                        /* End Email */
                    }
                }
            }
            else
            {
                $searchRecord=1;
            }
            $this->set('searchRecord',$searchRecord);
            if(strlen($searchLink)>0 && $notSearch) {
                $searchHistory=array('name'=>json_encode($searchArr),'link'=>$searchLink,'ip_address'=>$_SERVER['REMOTE_ADDR'],'search'=>$searchRecord);
                $this->loadModel('SearchHistory');
                $this->SearchHistory->create();
                $this->SearchHistory->save($searchHistory);
            }
            if ($this->request->is('ajax'))
            {
                $this->render('index','ajax'); // View, Layout
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function view($id=null)
    {
        $this->loadModel('User');
        $this->loadModel('PropertiesFeature');
        $post = $this->Property->findByIdAndPublished($id,'Yes');
        if(!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash', array('alert'=> 'danger'));
            $this->redirect(array('controller' => 'Properties', 'action' => 'index'));
        }
        $views=$post['Property']['views']+1;
        $this->Property->save(array('id'=>$id,'views'=>$views));
        $feature = $this->PropertiesFeature->find('all',array('joins'=>array(array('table'=>'features','alias'=>'Feature','conditions'=>array('Feature.id=PropertiesFeature.feature_id'))),
                                                              'conditions'=>array('PropertiesFeature.property_id'=>$id),
                                                              'fields'=>array('Feature.name')
                                                             ));
        $this->set('post',$post);
        $this->set('feature',$feature);
        $this->set('userArr',$this->User->findById($post['Property']['user_id']));
        $isRating=CakeSession::read('rating');
        $this->set('isRating',$isRating);
    }
    public function printproperty($id)
    {
        $this->layout=null;
        $this->view($id);
        $this->loadModel('Template');
        $templateArr=$this->Template->findByTypeAndStatus('PRO','Published');
        if($templateArr['Template']['status']=="Published")
        { 
           $this->set('template',$templateArr['Template']['description']);
        }
    }
    public function calculator($amount)
    {
        $this->layout=null;
        $this->set('amount',$amount);
        $frequencyArr=array('12'=>__('Monthly'),'4'=>__('Quarterly'),'26'=>__('Fortnightly'),'52'=>__('Weekly'));
        $loanTypeArr=array('pi'=>__('Principal & Interest'),'io'=>__('Interest only'));
        $this->set('frequencyArr',$frequencyArr);
        $this->set('loanTypeArr',$loanTypeArr);
    }
    public function favourite($id,$status)
    {
        $this->layout=null;
        $this->autoRender=false;
        $favUrl=Router::url(['controller' => 'Properties', 'action' => 'favourite']);
        return $this->CustomFunction->favouriteProperty($favUrl,$id,$status);
    }
    public function compare($id,$status)
    {
        $this->layout=null;
        $this->autoRender=false;
        $compUrl=Router::url(['controller' => 'Properties', 'action' => 'compare']);
        $imgUrl=Router::url(['controller' => 'img']);
        return $this->CustomFunction->compareProperty($compUrl,$imgUrl,$id,$status);
    }
    public function inquiry($id=null)
    {
      try{
      $clientId=null;
      $this->loadModel('Lead');
      $this->loadModel('Client');
      $this->loadModel('Agent');
      $this->loadModel('Property');
      $this->loadModel('Project');
      $post = $this->Property->findById($id);
        if($this->request->is(array('post', 'put'))) {
          $postClient=$this->Client->find('first',array('conditions'=>array('email'=>$this->request->data['email'])));
          if($postClient)
          {
            $clientId=$postClient['Client']['id'];   
          }
          else
          {
              $password = rand();
              $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
              $pass= $passwordHasher->hash($password);
              $code=$this->CustomFunction->generate_rand();
              $client=array('user_id'=>$post['Property']['user_id'],'project_id'=>$post['Property']['project_id'],'category_id'=>1,'password'=>$pass,'name'=>$this->request->data['full_name'],'email'=>$this->request->data['email'],'mobile'=>$this->request->data['mobile'],'reg_code'=>$code,'reg_status'=>"Live",'status'=>"Pending");
              $this->Client->save($client);
              $clientId=$this->Client->id;
            
              $clientName=$this->request->data['full_name'];
              $mobileNo=$this->request->data['mobile'];
              $email=$this->request->data['email'];
              $siteName=$this->siteName;
              $contactNo=$this->contact;
              $rand1=$this->CustomFunction->generate_rand(35);
              $rand2=rand();
              $url="$this->siteDomain/Emailverifications/emailcode/$code/$rand1/$rand2";
              
              $this->loadModel('Emailtemplate');
              $emailArr=$this->Emailtemplate->findByType('INQ');
              if($emailArr['Emailtemplate']['status']=="Published")
              {
                  $message=eval('return "' . addslashes($emailArr['Emailtemplate']['description']) . '";');
                  $Email = new CakeEmail();
                  $Email->transport($this->emailSettype);
                  if($this->emailSettype=="Smtp")
                  $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword,'timeout'=>90));
                  $Email->from(array($this->siteEmail =>$this->siteName));
                  $Email->to($email);
                  $Email->template('default');
                  $Email->emailFormat('html');
                  $Email->subject($emailArr['Emailtemplate']['name']);
                  $Email->send($message);
                  /* End Email */
              }
              if($this->smsNotification)
              {
                  /* Send Sms */
                  $this->loadModel('Smstemplate');
                  $smsTemplateArr=$this->Smstemplate->findByType('INQ');
                  if($smsTemplateArr['Smstemplate']['status']=="Published")
                  {
                      $url="$this->siteDomain/Emailverifications";
                      $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                      
                      $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                  }
                  /* End Sms */
              }
          }
          $property=$this->Property->find('first',array('conditions'=>array('Property.id'=>$id)));
          if($post['Property']['user_id'])
          $userId=$post['Property']['user_id'];
          else $userId=$post['Property']['project_id'];
          $lead=array('user_id'=>$userId,'project_id'=>$post['Property']['project_id'],'status_id'=>1,'client_id'=>$clientId,'property_id'=>$id,'remarks'=>$this->request->data['message'],'follow_up'=>$this->currentDateTime);
          $this->Lead->save($lead);
          
          $agentId=$property['Property']['user_id'];
          if($agentId) {
          $agent=$this->Agent->find('first',array('conditions'=>array('id'=>$agentId)));
          $toEmail=$agent['Agent']['email'];
          }
          else {
          $project=$this->Project->find('first',array('conditions'=>array('id'=>$property['Property']['project_id'])));
          $toEmail=$project['Project']['email'];
          }
          /* E-Mail Sent Code start */
          $message=eval('return "' . addslashes($this->request->data['message']) . '";');
          $Email = new CakeEmail();
          $Email->transport($this->emailSettype);
          if($this->emailSettype=="Smtp")
          $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword,'timeout'=>90));
          $Email->from(array($this->siteEmail =>$this->siteName));
          $Email->to($toEmail);
          $Email->template('default');
          $Email->emailFormat('html');
          $Email->subject($this->request->data['subject']);
          $Email->send($message);
          /* E-Mail Sent Code End */
          $this->Session->setFlash(__('E-Mail Successfully sent'),'flash',array('alert'=>'success'));
          return $this->redirect(array('action' => 'view/',$id));
        }
      }
      catch(Exception $e)
      {
        $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        return $this->redirect(array('action' => 'view',$id));
      }
    }
    
    public function sendbymail($id = null)
    {        
        $this->loadModel('Property');
        $this->loadModel('PropertiesFeature');
        $post = $this->Property->findById($id);
        $feature = $this->PropertiesFeature->find('all',array('joins'=>array(array('table'=>'features','alias'=>'Feature','conditions'=>array('Feature.id=PropertiesFeature.feature_id'))),
                                                              'conditions'=>array('PropertiesFeature.property_id'=>$id),
                                                              'fields'=>array('Feature.name')
                                                             ));
        if(!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash', array('alert'=> 'danger'));
            $this->redirect(array('controller' => 'Properties', 'action' => 'index'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                $email=$this->request->data['Property']['email'];
                $allMails=explode(",",$email);
                $this->loadModel('Template');
                $templateArr=$this->Template->findByTypeAndStatus('EMA','Published');
                if($templateArr['Template']['status']=="Published")
                {
                    $feature1=array();                
                    foreach($post['PropertiesPhoto'] as $post1):
                    $photoUrl=$this->siteDomain.'/img/'.$post1['dir'].'/'.$post1['photo'];break;
                    unset($post1);endforeach;
                    foreach($feature as $fpost):
                    $feature1[]=$fpost['Feature']['name'];
                    unset($fpost);endforeach;
                    $feature=implode(",",$feature1);
                    $propertyPhoto='<img src="'.$photoUrl.'">';
                    $propertyName=$post['Property']['name'];
                    $locationName=$post['Location']['name'];
                    $contractName=$post['Contract']['name'];
                    $agencyName=$post['Project']['name'];
                    $propertyPrice=$this->currencyFull.' '.$post['Property']['price'];
                    $propertyStatus=$post['Property']['status'];
                    $propertyBedroom=$post['Property']['bedroom'];
                    $propertyBathroom=$post['Property']['bathroom'];
                    $propertyArea=$post['Property']['area'].' '.$post['Unit']['name'];
                    $propertyView=$post['Property']['views'];
                    $propertyDescription=$post['Property']['description'];
                    $propertyAgent=$post['User']['name'];
                    $templateValue=eval('return "' . addslashes($templateArr['Template']['description']) . '";');
                    foreach($allMails as $mailValue)
                    {  
                        $Email = new CakeEmail();
                        $Email->transport($this->emailSettype);
                        if($this->emailSettype=="Smtp")
                        $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword,'timeout'=>90));
                        $Email->from(array($this->siteEmail =>$this->siteName));
                        $Email->to($mailValue);
                        $Email->viewVars(array('template'=>$templateValue));
                        $Email->template('mailproperty','default');
                        $Email->emailFormat('html');
                        $Email->subject($templateArr['Template']['name']);
                        $Email->send();
                    }
                    $this->Session->setFlash(__('E-Mail Successfully sent'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'view/',$id));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'view/',$id));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = null;
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }
    public function rating($id)
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        $post=$this->Property->findById($id);
        if($post)
        {
            $ratingUser=$post['Property']['rating_users']+1;
            $ratingCount=$post['Property']['rating_count']+$this->request->data['Property']['rating'];
            $rating=round($ratingCount/$ratingUser,1);
            $recordArr=array('id'=>$id,'rating_users'=>$ratingUser,'rating_count'=>$ratingCount,'rating'=>$rating);
            $this->Property->save($recordArr);
            CakeSession::write('rating',true);
            $startRating=$this->CustomFunction->starRating($rating);
            print'<div class="comment-rating" data-score="'.$rating.'" title="'.__('Rating').' '.$rating.'">'.$startRating.'</div><span>'.$ratingUser.' '.__('Ratings').'</span>';
            die();
        }        
    }
}