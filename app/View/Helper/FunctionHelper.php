<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Helper', 'View');
App::uses('CakeTime', 'Utility');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class FunctionHelper extends Helper
{
    var $helpers = array('Html','Number');
    public function secondsToWords($seconds,$msg="Unlimited")
    {
        $ret = "";
        if($seconds>0)
        {
            /*** get the hours ***/
            $hours = intval(intval($seconds) / 3600);
            if($hours > 0)
            {
                $ret .= $hours.' '.__('Hours').' ';
            }
            /*** get the minutes ***/
            $minutes = bcmod((intval($seconds) / 60),60);
            if($minutes > 0)
            {
                $ret .= $minutes.' '.__('Mins').' ';
            }
            $tarMinutes = bcmod((intval($seconds)),60);
            if(strlen($ret)==0 || $tarMinutes>0)
            {
                if($tarMinutes>0)
                $ret .= $tarMinutes.' '.__('Sec');
                else
                $ret .= $seconds.' '.__('Sec');
            }
        }
        else
        {
            $ret=$msg;
        }
        return $ret;
    }
    public function showGroupName($gropArr,$string=" | ")
    {
        $groupNameArr=array();
        foreach($gropArr as $groupName)
        {
            $groupNameArr[]=$groupName['group_name'];
        }
        unset($groupName);
        $showGroup= implode($string,$groupNameArr);
        unset($groupNameArr);
        return h($showGroup);
    }
    public function starRating($rating)
    {
        $starRating=__('Not Specified');
        if($rating)
        {
            $starRating=null;
            $ratingArr=explode(".",$rating);
            for($i=0;$i<$ratingArr[0];$i++)
            {
                $starRating.='<i class="fa fa-star"></i>';
            }
            if(count($ratingArr)>1 && $ratingArr[1])
            {
                $starRating.='<i class="fa fa-star-half-o"></i>';
            }
            $remRating=substr(5-$rating,0,1);
            if($remRating>0)
            {
                for($i=0;$i<$remRating;$i++)
                {
                    $starRating.='<i class="fa fa-star-o"></i>';
                }
            }
        }
        return$starRating;
    }
    public function favouriteProperty($propertyId)
    {
        $favUrl=$this->Html->url(array('controller'=>'Properties','action'=>'favourite'));
        $sessionId=session_id();
        $Property=ClassRegistry::init('Property');
        $Property->unbindModel(array('belongsTo'=>array('Type','Project','Unit','Location','User','Contract'),
                                     'hasMany'=>array('PropertiesPhoto','PropertiesDocument','PropertiesFloorplan')));
        $Favourite=ClassRegistry::init('Favourite');
        $post=$Property->findById($propertyId);
        $favUrl=$this->Html->url(array('controller'=>'Properties','action'=>'favourite'));
        if($post)
        {
            if(isset($_SESSION['frontUser']))
            {
               $fpost=$Favourite->findByPropertyIdAndClientId($propertyId,$_SESSION['frontUser']['Client']['id']);
            }
            else
            {
                $fpost=$Favourite->findByPropertyIdAndSessionId($propertyId,$sessionId);
            }
            if($fpost)
            {
                return '<span id="'.$propertyId.'printajax"><a href="javascript:void(0);" class="nav-link" onclick="favouriteProperties(\''.$favUrl.'\',\''.$propertyId.'\',\'remove\');"><i class="fa fa-heart"></i>&nbsp;<span>'.__('Remove to favorites').'</span></a></span>';
            }
            else
            {
                return '<span id="'.$propertyId.'printajax"><a href="javascript:void(0);" class="nav-link" onclick="favouriteProperties(\''.$favUrl.'\',\''.$propertyId.'\',\'add\');"><i class="fa fa-heart-o"></i>&nbsp;<span>'.__('Add to favorites').'</span></a></span>';
            }
        }
    }
    public function compareProperty($propertyId)
    {
        $compUrl=$this->Html->url(array('controller'=>'Properties','action'=>'compare'));
        $imgUrl=$this->Html->url(array('controller'=>'img'));
        $sessionId=session_id();
        $Property=ClassRegistry::init('Property');
        $Property->unbindModel(array('belongsTo'=>array('Type','Project','Unit','Location','User','Contract'),
                                     'hasMany'=>array('PropertiesPhoto','PropertiesDocument','PropertiesFloorplan')));
        $post=$Property->findById($propertyId);
        if($post)
        {
            $fpost=$this->readCompare($propertyId,$sessionId);
            if($fpost)
            {
                return '<span id="'.$propertyId.'cprintajax"><a href="javascript:void(0);" class="nav-link" onclick="compareProperties(\''.$compUrl.'\',\''.$propertyId.'\',\'remove\');"><img src="'.$imgUrl.'/compare-selected.png">&nbsp;<span>'.__('Remove to compare').'</span></a></span>';
            }
            else
            {
                return '<span id="'.$propertyId.'cprintajax"><a href="javascript:void(0);" class="nav-link" onclick="compareProperties(\''.$compUrl.'\',\''.$propertyId.'\',\'add\');"><img src="'.$imgUrl.'/compare-unselected.png">&nbsp;<span>'.__('Add to compare').'</span></a></span>';
            }
        }
    }
    public function readCompare($propertyId,$sessionId)
    {
        if(isset($_SESSION['compare'])){
            if(in_array($propertyId,$_SESSION['compare'])){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    public function gridProperty(&$record,$post,$currency,$divClass)
    {
        $photoUrl=$this->Html->url(array('controller'=>'img'));
        $id=$post['Property']['id'];
        $photo=$photoUrl.'/nia.png';
        if(is_array($post['PropertiesPhoto']))
        {
                foreach($post['PropertiesPhoto'] as $photoArr):$iphoto=0;
                if($photoArr['home']=='Yes')
                {
                        $iphoto++;
                        $photo=$photoUrl."/".$photoArr['dir'].'_thumb/'.$photoArr['photo'];
                        break;
                }
                if($iphoto==0)
                $photo=$photoUrl."/".$photoArr['dir'].'_thumb/'.$photoArr['photo'];
                endforeach;
        }
        if($post['Property']['status']=="Sold")$labelColor="label-danger";else$labelColor="label-default";
	$record=
        $divClass.'
            <div class="listing-box">
                <div class="listing-box-image" style="background-image: url(\''.$photo.'\')">
                    <div class="listing-box-image-label '.$labelColor.'">'.__($post['Property']['status']).'</div><!-- /.listing-box-image-label -->
                    <span class="listing-box-image-links">
                        '.$this->favouriteProperty($id).
                        $this->Html->link("<i class='fa fa-search'></i> <span>".__('View detail')."</span>",array('controller'=>'Properties','action'=>'view',$id),array('escape'=>false)).
                        $this->compareProperty($id).'
                    </span>
                </div><!-- /.listing-box-image -->
                <div class="listing-box-title">
                    <h2>'.$this->Html->link($post['Property']['name'],array('controller'=>'Properties','action'=>'view',$id)).'</h2>
                    <h3>'.$currency.$this->Number->format($post['Property']['price']).'</h3>
                </div><!-- /.listing-box-title -->
                <div class="listing-box-content">
                    <dl>
                        <dt>'.__('Type').'</dt><dd>'.$post['Type']['name'].'</dd>
                        <dt>'.__('Location').'</dt><dd>'.$post['Location']['name'].'</dd>
                        <dt>'.__('Contract').'</dt><dd>'.$post['Contract']['name'].'</dd>
                        <dt>'.__('Area').'</dt><dd>'.$post['Property']['area'].' '.$post['Unit']['name'].'</dd>
                    </dl>
                </div><!-- /.listing-box-cotntent -->
            </div><!-- /.listing-box -->
        </div><!-- /.col-* -->';
    }
    public function checkFeature($propertyId,$featureId){
        $PropertyFeature=ClassRegistry::init('PropertiesFeature');
        $post=$PropertyFeature->findByPropertyIdAndFeatureId($propertyId,$featureId);
        if($post){
            return true;
        }
        else{
            return false;
        }
    }
}
