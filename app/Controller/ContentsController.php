<?php
class ContentsController extends AppController {
    public function pages($id=null)
    {
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'pages','action' => 'home'));
        }
        $checkPost=$this->Content->findByPageUrlAndPublished($id,'Published');
        if(!$checkPost)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'pages','action' => 'home'));
        }
        $this->set('contentPost',$checkPost);
        $views=$checkPost['Content']['views'];
        $views++;
        $userResult=array('id'=>$checkPost['Content']['id'],'views'=>$views);
        $this->Content->save($userResult);
        $linkNameArr=explode(" ",$checkPost['Content']['page_name'],2);
        $linkName1=$linkNameArr['0'];
        if(count($linkNameArr)>1)
        $linkName2=$linkNameArr['1'];
        else
        $linkName2="";
        $this->set('linkName1',$linkName1);
        $this->set('linkName2',$linkName2);
        $this->set('contentId',$id);
    }    
}
