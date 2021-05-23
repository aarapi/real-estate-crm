<?php $receiptNo=$post['DealsPayment']['receipt_no'];?>
<div  class="container">
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Payment Details');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <div class="table-responsive">
			<table class="table table-bordered">
    <tr>
        <td  align="left" valign="top" ><p><?php echo __('Date').': '.$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['DealsPayment']['payment_date']));?></p></td>
        <td  align="right" valign="top" ></td>
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
		    </div>        </div>
    </div>
</div>