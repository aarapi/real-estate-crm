<?php
App::uses('Component','Controller');
App::uses('CakeTime', 'Utility');
App::uses('HttpSocket', 'Network/Http');
App::uses('CakeSession', 'Model/Datasource');
class CustomfunctionComponent extends Component
{
    public $components = array('Session');
    public function secondsToWords($seconds)
    {
        /*** return value ***/
        $ret = "";
    
        /*** get the hours ***/
        $hours = intval(intval($seconds) / 3600);
        if($hours > 0)
        {
            $ret .= "$hours Hours ";
        }
        /*** get the minutes ***/
        $minutes = bcmod((intval($seconds) / 60),60);
        if($hours > 0 || $minutes > 0)
        {
            $ret .= "$minutes Mins. ";
        }
        return $ret;
    }
    public function generate_rand($digit=6)
    {
      $no=substr(strtoupper(md5(uniqid(rand()))),0,$digit);
      return $no;
    }
    public function upload($tmpFile,$file,$path,$width=150,$height=150,$fileName="",$isThumb=true,$extArr=array("jpg","gif","png","jpeg","JPG"))
    {
        if(strlen($file)>0)
        {
            $pathinfo   = pathinfo(trim($file));
            if(strlen($fileName)==0)
            if(in_array($pathinfo['extension'],$extArr))
            {
                $imageDir = APP.'webroot'.DS;
                $fileName=date('Y-m-d').'-'.rand().'.'.$pathinfo['extension'];
                $uploadPath='img'.DS.$path.DS;
                if(move_uploaded_file($tmpFile,$uploadPath.$fileName))
                {
                    $imgSizeArr=getimagesize($uploadPath.$fileName);
                    if($imgSizeArr[0]>800 && $imgSizeArr[1]>600){
                        $this->resizedUrl($fileName,$uploadPath,$uploadPath,'800','600');
                    }
                    if($isThumb==true)
                    {
                        $thumbPath='img'.DS."$path"."_thumb".DS;
                        $this->resizedUrl($fileName,$uploadPath,$thumbPath,$width,$height);
                    }
                    return $fileName;
                }
            }
        }
        $fileName="";
        return$fileName;
    }
    public function resizedUrl($file,$uploadPath,$thumbPath, $width, $height, $quality = 100){
        # We define the image dir include Theme support
        $imageDir = APP.'webroot'.DS;
        # We find the right file
        $pathinfo   = pathinfo(trim($file, '/'));
        $targetFile=$imageDir . $uploadPath.$file;
        $output     = $imageDir.$thumbPath.$file;
        if (file_exists($targetFile)) {
            # Setting defaults and meta
            $info  = getimagesize($targetFile);
            list($width_old, $height_old) = $info;
            # Create image ressource
            switch ( $info[2] ) {
                case IMAGETYPE_GIF:   $image = imagecreatefromgif($targetFile);   break;
                case IMAGETYPE_JPEG:  $image = imagecreatefromjpeg($targetFile);  break;
                case IMAGETYPE_PNG:   $image = imagecreatefrompng($targetFile);   break;
                default: return false;
            }
            # We find the right ratio to resize the image before cropping
            $heightRatio = $height_old / $height;
            $widthRatio  = $width_old /  $width;
            $optimalRatio = $widthRatio;
            if ($heightRatio < $widthRatio) {
                $optimalRatio = $heightRatio;
            }
            $height_crop = ($height_old / $optimalRatio);
            $width_crop  = ($width_old  / $optimalRatio);
            # The two image ressources needed (image resized with the good aspect ratio, and the one with the exact good dimensions)
            $image_crop = imagecreatetruecolor( $width_crop, $height_crop );
            $image_resized = imagecreatetruecolor($width, $height);
            # This is the resizing/resampling/transparency-preserving magic
            if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
                $transparency = imagecolortransparent($image);
                if ($transparency >= 0) {
                    $transparent_color  = imagecolorsforindex($image, $trnprt_indx);
                    $transparency       = imagecolorallocate($image_crop, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                    imagefill($image_crop, 0, 0, $transparency);
                    imagecolortransparent($image_crop, $transparency);
                    imagefill($image_resized, 0, 0, $transparency);
                    imagecolortransparent($image_resized, $transparency);
                }elseif ($info[2] == IMAGETYPE_PNG) {
                    imagealphablending($image_crop, false);
                    imagealphablending($image_resized, false);
                    $color = imagecolorallocatealpha($image_crop, 0, 0, 0, 127);
                    imagefill($image_crop, 0, 0, $color);
                    imagesavealpha($image_crop, true);
                    imagefill($image_resized, 0, 0, $color);
                    imagesavealpha($image_resized, true);
                }
            }
            imagecopyresampled($image_crop, $image, 0, 0, 0, 0, $width_crop, $height_crop, $width_old, $height_old);
            imagecopyresampled($image_resized, $image_crop, 0, 0, ($width_crop - $width) / 2, ($height_crop - $height) / 2, $width, $height, $width, $height);
            # Writing image according to type to the output destination and image quality
            switch ( $info[2] ) {
              case IMAGETYPE_GIF:   imagegif($image_resized, $output, $quality);    break;
              case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
              case IMAGETYPE_PNG:   imagepng($image_resized, $output, 9);    break;
              default: return false;
            }
        }
        return $output;
    }
    public function fileDelete($fileName,$imageDir,$isThumb=true,$path=null)
    {
        $fileThumb=null;
        if($path==null)
        {
            $file=APP.WEBROOT_DIR.DS.'img'.DS.$imageDir.DS.$fileName;
            if($isThumb==true)
            $fileThumb=APP.WEBROOT_DIR.DS.'img'.DS.$imageDir.'_thumb'.DS.$fileName;
        }
        else
        {
            $file=$path.$fileName;
        }
        if(file_exists($file))
        {
            unlink($file);
        }
        if(file_exists($fileThumb) && $isThumb==true)
        {
            unlink($fileThumb);
        }
    }
    public function showGroupName($gropArr,$string=" , ")
    {
        $groupNameArr=array();
        foreach($gropArr as $groupName)
        {
            $groupNameArr[]=$groupName['name'];
        }
        unset($groupName);
        $showGroup= implode($string,$groupNameArr);
        unset($groupNameArr);
        return h($showGroup);
    }
    public function awalletInsert($agentId,$amount,$type,$remarks=null,$dealsPaymentId=null,$isLog=true)
    {
        $recordArr=array();$arecordArr=array();
        $Awallet=ClassRegistry::init('Awallet');
        $User=ClassRegistry::init('User');
        if($amount<=0)
        {
            return false;
        }
        else
        {
            $userArr=$User->findById($agentId);
            $walletArr=$Awallet->findByUserId($agentId);
            if($walletArr)
            {
                if($type=="CR")
                {
                    $fieldType="credit";
                    $netAmount=$walletArr['Awallet']['credit']+$amount;
                    $balance=$walletArr['Awallet']['balance']+$amount;
                }
                else
                {
                    $fieldType="debit";
                    $netAmount=$walletArr['Awallet']['debit']+$amount;
                    $balance=$walletArr['Awallet']['balance']-$amount;
                }
                $recordArr=array('id'=>$walletArr['Awallet']['id'],'user_id'=>$agentId,'project_id'=>$userArr['User']['project_id'],$fieldType=>$netAmount,'balance'=>$balance);
            }
            else
            {
                if($type=="CR")
                $fieldType="credit";
                else
                $fieldType="debit";
                $recordArr=array('user_id'=>$agentId,'project_id'=>$userArr['User']['project_id'],$fieldType=>$amount,'balance'=>$amount);
                $Awallet->create();
            }
            if($Awallet->save($recordArr))
            {
                if($isLog==true)
                {
                    $AwalletHistory=ClassRegistry::init('AwalletHistory');
                    $this->currentDateTime=CakeTime::format('Y-m-d H:i:s',CakeTime::convert(time(),$this->siteTimezone));
                    $arecordArr=array('AwalletHistory'=>array('user_id'=>$agentId,'project_id'=>$userArr['User']['project_id'],'deals_payment_id'=>$dealsPaymentId,'amount'=>$amount,'type'=>$type,'date'=>$this->currentDateTime,'remarks'=>$remarks));
                    $AwalletHistory->create();
                    $AwalletHistory->save($arecordArr);
                }
                return true;
            }
            else
            {
                return false;
            }
        }
    }
    public function awalletBalance($id)
    {
        $Awallet=ClassRegistry::init('Awallet');
        $walletArr=$Awallet->findByUserId($id);
        if($walletArr)
        $balance=$walletArr['Awallet']['balance'];
        else
        $balance=" 0.00";
        return $balance;
    }
    public function awalletDelete($agentId,$amount)
    {
        $Awallet=ClassRegistry::init('Awallet');
        $walletArr=$Awallet->findByUserId($agentId);
        $netAmount=$walletArr['Awallet']['credit']-$amount;
        $balance=$walletArr['Awallet']['balance']-$amount;
        $recordArr=array('id'=>$walletArr['Awallet']['id'],'user_id'=>$agentId,'project_id'=>$walletArr['Awallet']['project_id'],'credit'=>$netAmount,'balance'=>$balance);
        if($Awallet->save($recordArr))
        {
            return true;
        }
    }
    public function favouriteProperty($favUrl,$propertyId,$status=null)
    {
        $sessionId=session_id();
        $Property=ClassRegistry::init('Property');
        $Property->unbindModel(array('belongsTo'=>array('Type','Project','Unit','Location','User','Contract'),
                                     'hasMany'=>array('PropertiesPhoto','PropertiesDocument','PropertiesFloorplan')));
        $Favourite=ClassRegistry::init('Favourite');
        $post=$Property->findById($propertyId);
        if(isset($_SESSION['User']))
        {
           $fpost=$Favourite->findByPropertyIdAndUserId($propertyId,$_SESSION['User']['User']['id']);
        }
        else
        {
            $fpost=$Favourite->findByPropertyIdAndSessionId($propertyId,$sessionId);
        }
        if($post)
        {
            if($status=="add")
            {
                if(!$fpost)
                {
                    if($this->Session->check('User'))
                    {
                        $userArr=$this->Session->read('User');
                        $userId=$userArr['User']['id'];
                        $favArr=array('user_id'=>$userId,'session_id'=>$sessionId,'property_id'=>$propertyId);
                    }
                    else
                    {
                        $favArr=array('session_id'=>$sessionId,'property_id'=>$propertyId);
                    }
                    $Favourite->save($favArr);
                    return '<span id="'.$propertyId.'printajax"><a href="javascript:void(0);" class="nav-link" onclick="favouriteProperties(\''.$favUrl.'\',\''.$propertyId.'\',\'remove\');"><i class="fa fa-heart"></i>&nbsp;<span>'.__('Remove to favorites').'</span></a></span>';
                }
            }
            else
            {
                if($fpost)
                {
                    $id=$fpost['Favourite']['id'];
                    $Favourite->delete($id);
                    return '<span id="'.$propertyId.'printajax"><a href="javascript:void(0);" class="nav-link" onclick="favouriteProperties(\''.$favUrl.'\',\''.$propertyId.'\',\'add\');"><i class="fa fa-heart-o"></i>&nbsp;<span>'.__('Add to favorites').'</span></a></span>';
                }
            }
        }
    }
    public function compareProperty($compUrl,$imgUrl,$propertyId,$status=null)
    {
        $Property=ClassRegistry::init('Property');
        $Property->unbindModel(array('belongsTo'=>array('Type','Project','Unit','Location','User','Contract'),
                                     'hasMany'=>array('PropertiesPhoto','PropertiesDocument','PropertiesFloorplan')));
        $post=$Property->findById($propertyId);
        if($post)
        {
            if($status=="add")
            {
                if(count($this->readPackage())<3)
                {
                    $this->addPackage($propertyId);
                    return '<span id="'.$propertyId.'cprintajax"><a href="javascript:void(0);" class="nav-link" onclick="compareProperties(\''.$compUrl.'\',\''.$propertyId.'\',\'remove\');"><img src="'.$imgUrl.'/compare-selected.png">&nbsp;<span>'.__('Remove to compare').'</span></a></span>';
                }
                else
                {
                    ?><script>alert(getLocale("You can not compare more than 3 properties"));</script><?php
                    return '<span id="'.$propertyId.'cprintajax"><a href="javascript:void(0);" class="nav-link" onclick="compareProperties(\''.$compUrl.'\',\''.$propertyId.'\',\'add\');"><img src="'.$imgUrl.'/compare-unselected.png">&nbsp;<span>'.__('Add to compare').'</span></a></span>';
                }
            }
            else
            {
                $carts = $this->readPackage();
                unset($carts[$propertyId]);
                $this->savePackage($carts);
                return '<span id="'.$propertyId.'cprintajax"><a href="javascript:void(0);" class="nav-link" onclick="compareProperties(\''.$compUrl.'\',\''.$propertyId.'\',\'add\');"><img src="'.$imgUrl.'/compare-unselected.png">&nbsp;<span>'.__('Add to compare').'</span></a></span>';
            }
        }
    }
    public function addPackage($productId) {
        $allPackages = $this->readPackage();
        $allPackages[$productId] = $productId;
        $this->savePackage($allPackages);
    }
    public function readPackage() {
        return CakeSession::read('compare');
    }
    public function savePackage($data) {
        return CakeSession::write('compare',$data);
    }
    public function readCompare($propertyId)
    {
        $compArr=$this->readPackage();
        if($compArr[$propertyId]==$propertyId){
            return true;
        }
        else{
            return false;
        }
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
    public function userWisePermission($id,$luserId,$userType,$agencyId,$field1,$field2,$fieldType=1){
        $condition=array();
        if($id!=null){
            if($fieldType==1)
            {
                $condition=array($field1=>$id);
            }
            if($fieldType==2)
            {
                $condition=array($field2=>$id);
            }            
	}
	if($userType!='ADR' && $userType!='MAR'){
	    if($userType=='AGT'){
		$condition=array($field2=>$luserId);
	    }
	    else{
		$condition=array($field1=>$agencyId);
	    }
	}
        return $condition;
    }
    public function agencyWisePermission($id,$userType,$agencyId,$field1){
        $condition=array();
        if($id!=null){
	    $condition=array($field1=>$id);
	}
        if($userType=='AGT' || $userType=='AGY'){
            $condition=array($field1=>$agencyId);
	}
        return $condition;
    }
    public function agencyWiseList($userType,$agencyId)
    {
        $condition=array();
        if($userType=='ADR' && $userType='MAR'){
            $condition=array();
        }
        else{
            $condition=array('Project.id'=>$agencyId);
        }
        $Project=ClassRegistry::init('Project');
        $listArr=$Project->find('list',array('conditions'=>$condition));
        return$listArr;
    }
    public function sendSms($mobileNo,$message,$smsArr=array())
    {
        $url=$smsArr['Smssetting']['api'];
        $query=array($smsArr['Smssetting']['husername']=>$smsArr['Smssetting']['username'],$smsArr['Smssetting']['hpassword']=>$smsArr['Smssetting']['password'],$smsArr['Smssetting']['hsenderid']=>$smsArr['Smssetting']['senderid'],$smsArr['Smssetting']['hmobile']=>$mobileNo,$smsArr['Smssetting']['hmessage']=>$message,'smstype'=>'TRANS');
        
        //$file = new File(TMP.'sms.txt',true,0777);
        //$file->write($url.'\n'.$mobileNo.'\n'.$message.'\n','a',true);
        //$file->close();
        if (!$this->HttpSocket) {
            $this->HttpSocket = new HttpSocket();
        }
        if($smsArr['Smssetting']['type']=="Get")
        $response=$this->HttpSocket->get($url, $query);
        else
        $response=$this->HttpSocket->post($url, $query);
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