<?php
$agentName=$this->Form->select('user_id',$agentName,array('empty'=>__('Please Select'),'class'=>'form-control','div'=>false,'id'=>'agentId','label'=>false));
$postArr=array('#DealArea'=>$post['Property']['area'].' '.$post['Unit']['name'],'#DealAmount'=>$post['Property']['price'],'#contractId'=>$post['Property']['contract_id'],'#agentName'=>$agentName);
echo json_encode($postArr);
?>