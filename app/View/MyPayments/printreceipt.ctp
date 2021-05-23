<?php echo $this->Html->css('print.css');
$receiptNo=$post['MyPayment']['receipt_no'];
?>
<html>
<title><?php echo __('Payment Receipt');?></title>
<style type="text/css">
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
border-top: 0px solid #ddd;}
.recipt_footer{position:relative;top: 180px;text-align: right;}
.recipt{text-align: right;}
</style>
<body>
<table width="100%" class="table"  style="max-height:960px;border-top: 0px">
    <tr>
        <td>
            <?php if(strlen($frontLogo)>0){?><?php echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'','height'=>'100'));}?>  
        </td>
        <td colspan="3">
            <table>
            <tr><td><h2><?php echo$siteOrganization;?></h2></td></tr>
            <tr><td><p><?php echo$siteAddress;?></p></td></tr>
            </table>
        </td>
    </tr>
    <tr>
        <td  align="left" valign="top" ><p><?php echo __('Payment Date');?> :</p></td>
        <td  valign="top" align="left"><p><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['MyPayment']['payment_date']));?></p></td>
        <td  align="left" valign="top" ><p><?php echo __('Next Due Date');?> :</p></td>
        <td  valign="top" align="left"><p><?php if($dueDate){echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($dueDate));}else{echo __('PAID');}?></p></td>
    </tr>
    <tr><td  align="left" valign="top" ><p><?php echo __('ReceiptNo');?> :</p></td><td colspan="3" valign="top" align="left"><p><?php echo$receiptNo;?></p></td></tr>
    <tr><td  align="left" valign="top" ><p><?php echo __('Narration');?> :</p></td><td colspan="3" valign="top" align="left"><p><?php echo$post['Deal']['remarks'];?></p></td></tr>
    <tr><td colspan="4" valign="top" align="left"><strong><?php echo __('Dear  Mr./Mrs./Ms');?>  <?php echo h($post['Client']['name']);?></strong></td></tr>
    <tr><td colspan="4" valign="top" align="left"><strong><?php echo __('Thank you for your payment against the following details');?>.</strong></td></tr>
    </table>
    <table  width="100%" class="table"  >
    <tr>
        <td align="left" valign="top" width="20%"><p><?php echo __('Property Name');?>:</p></td>
        <td align="left" valign="top" width="30%"><p><?php echo h($post['Property']['name']);?></p></td>
        <td align="left" valign="top" width="10%"><p><?php echo h($post['PropertiesFlat']['type']);?> No:</p></td>
        <td align="left" valign="top" width="5%"><p><?php echo h($post['PropertiesFlat']['name']);?></p></td>
        <td align="left" valign="top" width="15%"><p><?php echo __('Area');?>:</p></td>
        <td align="left" valign="top" width="20%"><p><?php echo h($post['PropertiesFlat']['area']).' '.h($post['Unit']['name']);?></p></td>
    </tr>
    <tr>
        <td align="left" valign="top"><p><?php echo __('Actual Amount');?>:</p></td>
        <td align="left" valign="top"><?php echo$currency.$this->Number->format($post['MyPayment']['total_amount']);?></td>
        <td align="left" valign="top"><p><?php echo __('Tax Amount');?>:</p></td>
        <td align="left" valign="top" colspan="3"><?php echo$currency.$this->Number->format($post['MyPayment']['tax_amount']);?></td>
    </tr>
    <tr>
        <td align="left" valign="top"><p><?php echo __('Amount(numerals)');?>:</p></td>
        <td align="left" valign="top"  colspan="3"><?php echo$currency.$this->Number->format($post['MyPayment']['amount']);?>&nbsp;&nbsp;<strong><?php echo __('For');?></strong>&nbsp;&nbsp;<?php echo h($post['PlansPayment']['name']);?></td>
    </tr>
    <tr>
        <td align="left" valign="top"><p><?php echo __('Amount (word)');?>:</p></td>
        <td align="left" valign="top" colspan="3"><p> <?php echo$this->NumToWord->NumberToWord($post['MyPayment']['amount']);?></p></td>
    </tr>
    
    <tr>
        <td align="left" valign="top"><p><?php echo __('Payment Through');?>:</p></td>
        <td align="left" valign="top" colspan="3"><?php echo$post['Paymenttype']['name'];?>&nbsp;&nbsp;<strong><?php echo __('For');?></strong>&nbsp;&nbsp;<?php echo$post['MyPayment']['remarks'];?></td>
    </tr>
    </table>
        
             <div class="recipt_footer"><h2><?php echo$siteOrganization;?></h2><br><br>
             <strong><?php echo __('Authorised Signatory');?></strong><br><small>(<?php echo __('Subject to Realisation of Cheque');?>)</small></td>
             </div>
    
<script type="text/javascript" language="javascript1.2">
<!--
// Do print the page
if (typeof(window.print) != 'undefined') {
    window.print();
}
//-->
</script>
</body>
</html>