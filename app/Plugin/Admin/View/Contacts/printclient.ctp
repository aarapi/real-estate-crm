<?php echo $this->Html->css('print.css');?>
<style type="text/css">
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
border-top: 0px solid #ddd;
}
</style>
<table width="100%">
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
        <td colspan="4" align="center"><strong><?php echo $post['Category']['name'].__(' Details');?></strong></td>        
    </tr>
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Name');?></small></strong></td>
				<td><?php echo h($post['Contact']['name']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Address');?></small></strong></td>
				<td><?php echo h($post['Contact']['address']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('District');?></small></strong></td>
				<td><?php echo h($post['Contact']['district']);?></td>
				<td><strong><small class="text-danger"><?php echo __('State');?></small></strong></td>
				<td><?php echo h($post['Contact']['state']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Pincode');?></small></strong></td>
				<td><?php echo h($post['Contact']['pincode']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Email');?></small></strong></td>
				<td><?php echo h($post['Contact']['email']);?></td>
			    </tr>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Cell phone');?></small></strong></td>
				<td><?php echo h($post['Contact']['mobile']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Phone');?></small></strong></td>
				<td><?php echo h($post['Contact']['phone']);?></td>
			    </tr>
			</table>
<script type="text/javascript">
setTimeout(function(){if (typeof(window.print) != 'undefined') {
    window.print();
    window.close();
}}, 300);
</script>