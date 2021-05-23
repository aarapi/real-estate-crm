<?php echo $this->Html->css('print.css');?>
<style type="text/css">
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
border-top: 0px solid #ddd;
}
</style>
<table width="100%" class="table" style="max-height:960px;border-top:0px">
<tr><td valign="top" align="left"><p><strong><?php echo __('Ref. No');?>:-</strong> <?php echo$deal['Deal']['invoice_no'];?> </p></td><td valign="top" align="right"><p><strong><?php echo __('Date');?>:- </strong><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($deal['Invpastdue']['date']));?></p></td></tr>
<tr><td colspan="2" valign="top" align="center"><strong><?php echo __('DEMAND LETTER');?></strong></td></tr>
<tr><td colspan="2" valign="top" align="left"><p><strong><?php echo __('To');?>,<br>
<?php echo h($deal['Client']['name']);?><br>
<?php echo nl2br($deal['Client']['address']);?>
</strong>
</p></td></tr>
<tr><td colspan="2" valign="top" align="center"><strong><?php echo __('Sub');?>: <?php echo __('Demand For Due Payment');?></strong></td></tr>
<tr><td colspan="2" valign="top" align="left"><p><?php echo __('Dear Sir / Madam');?>,<br>
<p><font style='padding-left:40px;'><?php echo __('We are please allot you');?> <u><strong><?php echo$deal['Type']['name'];?></strong></u> <?php echo __('Property :');?><u><strong><?php echo$deal['Property']['name'];?></strong></u> <?php echo __('on the');?> <u><strong><?php echo$deal['Property']['address'];?></strong></u> <?php echo __('in');?></font>
<?php echo __('complex to be known as');?> <u><strong>"<?php echo$deal['Project']['name'];?>"</strong></u> <?php echo __('to be');?> / <?php echo __('being constructed,');?> 
 <?php echo __('for a total consideration of');?> <u><strong> <?php  echo$currency.$this->Number->format($deal['Deal']['total_amount']);?>/-</strong></u> <strong>(<?php echo$this->NumToWord->NumberToWord($deal['Deal']['total_amount']);?>).</strong>
</p></td></tr>
<tr><td colspan="2" valign="top" align="left">
<p ><?php echo __('We are please to inform you that the');?> <u><strong><?php echo$deal['Invpastdue']['name'];?></strong></u> <?php echo __('Level of');?> 
<u><strong>"<?php echo$deal['Property']['name'];?>"</strong></u> <?php echo __('is completed and as per agreement the total amount');?> <u><strong><?php $total=($deal['Invpastdue']['amount']); echo$currency.$this->Number->format($total);?>/-</strong></u> <?php echo __('Plus Service');?>
<?php echo __('is due at this stage');?>.
</p></td></tr>
<tr><td colspan="2" valign="top" align="left">
<p ><?php echo __('You are requested to pay');?> <u><strong> <?php echo$currency.$this->Number->format($total);?>/- <strong>(<?php echo$this->NumToWord->NumberToWord($deal['Invpastdue']['amount']);?>).</strong></strong></u> <?php echo __('Plus Service Tax amount  within a');?> <?php echo$dueDays;?> <?php echo __('days');?>
<?php echo __('from the date of receipt of this letter');?>. <?php echo __('The interest would be charged');?> @ <?php echo$lateFees;?>% <?php echo __('if payment is delayed');?>.
</p></td></tr>
<tr><td colspan="2" valign="top" align="left">
<p><?php echo __('Please note that the payment for this transactions should be made by crossed cheque');?> /<br>
<?php echo __('Transfer of funds favouring');?> <u><strong> <?php echo $siteAccount;?> </strong></u> 
</p></td></tr>
<tr><td colspan="2" valign="top" align="left"><u><strong><?php echo __('Note');?>: <?php echo __('Please prepare separate cheque for service tax');?>.</strong></u></td></tr>
<tr><td colspan="2" valign="top" align="left">
<?php echo __('Thanking You');?>,<br>
<?php echo __('Yours faithfully');?>,<br>
<strong><?php echo __('For M/s');?>. <?php echo$siteOrganization; ?></strong>
</td></tr>
<tr><td colspan="2" valign="top" align="right"><strong><?php echo __('Contact No');?>:<br>
<?php echo$contact;?></strong>
</td></tr>
<tr><td colspan="2" valign="top" align="left"><strong><?php echo __('Director');?></strong></td></tr>
</table>
<script type="text/javascript" language="javascript1.2">
<!--
// Do print the page
if (typeof(window.print) != 'undefined') {
    window.print();
}
//-->
</script>