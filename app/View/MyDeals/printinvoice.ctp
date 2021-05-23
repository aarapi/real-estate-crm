<?php echo $this->Html->css('print.css');?>
<style type="text/css">
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
border-top: 0px solid #ddd;
}
.recipt_footer{position:relative;top: 25px;}
</style>
<table width="100%" class="table" style="max-height:960px;border-top: 0px">
<tr>
        <td>
            <?php if(strlen($frontLogo)>0){?><?php echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'','height'=>'100'));}?>  
        </td>
        <td colspan="4">
            <table>
            <tr><td><h2><?php echo$siteOrganization;?></h2></td></tr>
            <tr><td><p><?php echo$siteAddress;?></p></td></tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="4" align="left"><strong><?php echo __('INVOICE');?></strong></td>        
    </tr>
    <tr>
      <td valign="top" align="left"><strong><?php echo __('Invoice Number');?></strong></td>
      <td valign="top" align="left"><?php echo$post['MyDeal']['invoice_no'];?></td>
      <td align="left" valign="top"><strong><?php echo __('Invoice Date');?> </strong></td>
      <td align="left" valign="top"><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['MyDeal']['date']));?></td>
    </tr>
    <tr>
      <td align="left" valign="top"><strong><?php echo __('Client');?></strong> </td>
      <td align="left" valign="top"><?php echo h($post['Client']['name']);?></td>
      <td align="left" valign="top"><strong><?php echo __('Contact');?></strong> </td>
      <td  align="left" valign="top"><?php echo h($post['Client']['phone']);?></td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="top"><hr/></td>
    </tr>
    <tr>
      <td align="left" valign="top"><strong><?php echo __('Property');?></strong></td>
      <td align="left" valign="top"><?php echo h($post['Property']['name']);?></td>
      <td align="left" valign="top"><strong><?php echo h($post['PropertiesFlat']['type']);?> <?php echo __('Name');?></strong></td>
      <td align="left" valign="top"><?php echo h($post['PropertiesFlat']['name']);?></td>
    </tr>
    <tr>
      <td align="left" valign="top"><strong><?php echo __('Type');?></strong></td>
      <td align="left" valign="top"><?php echo h($post['Property']['type']);?>&nbsp;<strong><?php echo __('For');?></strong>&nbsp;<?php echo h($post['Property']['availiable']);?></td>
      <td align="left" valign="top"><strong><?php echo __('Area');?></strong></td>
      <td align="left" valign="top"><?php echo $post['PropertiesFlat']['area'].' '.$post['Unit']['name'];?></td>
    </tr>
    <tr>
      <td align="left" valign="top"><strong><?php echo __('Amount');?></strong></td>
      <td valign="top" align="left"><?php echo$currency.$this->Number->format($post['PropertiesFlat']['price']);?></td>
      <td align="left" valign="top"><strong><?php echo __('Discount');?></strong></td>
      <td valign="top" align="left"><?php echo$currency.$this->Number->format($post['MyDeal']['discount']);?></td>
    </tr>
    <tr>
        <td  align="left" valign="top"><strong><?php echo __('Total Amount');?></strong></td>
        <td colspan="3" valign="top" align="left"><strong><?php echo$currency.$this->Number->format($post['MyDeal']['total_amount']);?></strong></td>  
    </tr>
</table>
<?php if($plansPaymentArr)
    {
        ?>
        <table width="100%" class="table" border="1">
       <tr>
            <td colspan="4" align="left"><strong><?php echo __('PAYMENT DETAILS');?></strong></td>        
        </tr>
        <tr>
            <th align="left" valign="top"><?php echo __('#');?></th>
            <th align="left" valign="top"><?php echo __('Installment');?></th>
            <th align="left" valign="top"><?php echo __('Amount');?></th>
            <th align="left" valign="top"><?php echo __('Due Date');?></th>            
        </tr>
        <?php $serialNo=0;$totalAmount=0;
        foreach($plansPaymentArr as $value):$serialNo++;$totalAmount=$totalAmount+$value['PlansPayment']['amount'];?>
        <tr>
           <td align="left" valign="top"><?php echo $serialNo;?></td>
            <td align="left" valign="top"><?php echo h($value['PlansPayment']['name']);?></td>
            <td align="left" valign="top"><?php echo$currency.$this->Number->format($value['PlansPayment']['amount']);?></td>
            <td align="left" valign="top"><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($value['PlansPayment']['date']));?></td>            
        </tr>
        <?php endforeach;unset($value);?>
        <tr><td colspan="2" align="right"><strong><?php echo __('Total');?></strong></td><td colspan="2"><strong><?php echo$this->Number->format($totalAmount);?></strong></td></tr>
        </table>
        <?php }?>
<table  width="100%" class="table">        
    <tr><td colspan="4" valign="top" align="LEFT"><div class="recipt_footer"><strong><?php echo __('Signture');?></strong></div></td></tr>
    
    <tr><td colspan="2" valign="top" align="LEFT"><div class="recipt_footer"><P>
<?php echo __('Thanking You');?>,<BR>
<?php echo __('Yours faithfully');?>,<BR>
<strong><?php echo __('For M/s.');?> <?php echo$siteOrganization; ?></strong>
</P></div></td>
<td colspan="2" valign="top" align="right"><div class="recipt_footer"><strong><?php echo __('Contact No');?>:<br>
<?php echo$contact;?></strong></div>
</td>
</tr>

    
</table>
<script type="text/javascript" language="javascript1.2">
<!--
// Do print the page
if (typeof(window.print) != 'undefined') {
    window.print();
}
//-->
</script>