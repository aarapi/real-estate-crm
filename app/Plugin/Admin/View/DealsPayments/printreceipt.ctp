<?php echo $this->Html->css('print.css');
$receiptNo=$post['DealsPayment']['receipt_no'];
?>
<html>
<title>Payment Receipt</title>
<style type="text/css">
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
border-top: 0px solid #ddd;}
.recipt_footer{position:relative;top: 180px;text-align: right;}
.recipt{text-align: right;}
</style>
<body>
<table width="100%" class="table" style="max-height:960px;border-top: 0px">
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
        <td  align="left" valign="top" ><p><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['DealsPayment']['payment_date']));?></p></td>
        <td  align="right" valign="top" ><p><?php echo __('Next Due Date').': ';?><?php if($dueDate){echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($dueDate));}else{echo __('PAID');}?></p></td>
    </tr>
    <tr><td colspan="2"  align="left" valign="top" ><p><?php echo __('Receipt number').': '.$receiptNo;?></p></td></tr>
    <tr><td colspan="4"  align="left" valign="top" ><p><?php echo __('Narration').': '.$post['Deal']['remarks'];?></p></td></tr>
    <tr><td colspan="2" valign="top" align="left"><strong><?php echo __('Dear  Mr./Mrs./Ms  ').h($post['Client']['name']);?></strong></td></tr>
    <tr><td colspan="2" valign="top" align="left"><strong><?php echo __('Thank you for your payment against the following details.');?></strong></td></tr>
    </table>
    <table border="1" width="100%" class="table" >
    <tr>
        <td align="left" valign="top"><p><?php echo __('Property Name').': '.h($post['Property']['name']);?></p></td>
        <td align="left" valign="top"><p><?php echo __('Area').': '.h($post['Property']['area']).' '.h($post['Unit']['name']);?></p></td>
    </tr>
    <tr>
        <td align="left" valign="top"><p><?php echo __('Actual Amount').': '.$currency.$this->Number->format($post['DealsPayment']['total_amount']);?></p></td>
        <td colspan="5" align="left" valign="top"><?php echo __('Tax Amount').': '.$currency.$this->Number->format($post['DealsPayment']['tax_amount']);?></td>
    </tr>
    <?php if($post['DealsPayment']['extra_payment']>0){?>
    <tr>
        <td align="left" valign="top" colspan="6"><p><?php echo __('Extra/Late Amount').': '.$currency.$this->Number->format($post['DealsPayment']['extra_payment']);?></p></td>
    </tr>
    <?php }?>
    <tr>
        <td colspan="6" align="left" valign="top"><p><?php echo __('Amount(numerals)').': '.$currency.$this->Number->format($post['DealsPayment']['amount']);?>&nbsp;&nbsp;<strong><?php echo __('For');?></strong>&nbsp;&nbsp;<?php echo h($post['PlansPayment']['name']);?></p></td>
    </tr>
    <tr>
        <td colspan="6" align="left" valign="top"><p><?php echo __('Amount (word)').': '.$this->NumToWord->NumberToWord($post['DealsPayment']['amount']);?></p></td>
    </tr>
    
    <tr>
        <td colspan="6" align="left" valign="top"><p><?php echo  __('Payment Through').': '.$post['Paymenttype']['name'];?>&nbsp;&nbsp;<strong><?php echo __('For');?></strong>&nbsp;&nbsp;<?php echo$post['DealsPayment']['remarks'];?></p></td>
    </tr>
    </table>
        
             <div class="recipt_footer"><h2><?php echo$siteOrganization;?></h2><br><br>
             <strong><?php echo  __('Authorised Signatory');?></strong><br><small><?php echo  __('(Subject to Realisation of Cheque)');?></small></td>
             </div>
    
<script type="text/javascript">
setTimeout(function(){if (typeof(window.print) != 'undefined') {
    window.print();
    window.close();
}}, 300);
</script>
</body>
</html>