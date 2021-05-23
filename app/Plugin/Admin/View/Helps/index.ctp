<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Help');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
               <div class="cust-supt"><?php echo __('CUSTOMER SUPPORT');?></div>
            <div class="row">
                <div class="col-md-7"><div class="cust-head2"><?php echo __('A Responsive and Dedicated Technical Support, Any where, Any time');?>.</div>
                    <ul class="cust-list">
                        <li><span><?php echo __('Forum');?></span> -- (<?php echo __('24');echo __('Hours');?>)</li>
                        <li><span><?php echo __('Email Support');?></span> -- (<?php echo __('24');echo __('Hours');?>)</li>
                        <li><span><?php echo __('Live Chat');?></span> -- (<?php echo __('10:30');echo __('AM');__('to');__('8.00');__('PM');?> (<?php echo __('GMT +5:30, INDIA');?>))</li>
                        <li><span><?php echo __('Telephonic Support');?></span> -- (<?php echo __('10:30');echo __('AM');__('to');__('6.00');__('PM');?>(<?php echo __('GMT +5:30, INDIA');?>))</li>                        
                    </ul>
                </div>
                <div class="col-md-5">
                    <?php echo$this->Html->image('customer-support.png',array('class'=>'img-rounded'));?>
                </div>
            </div>
                </div>
            </div>