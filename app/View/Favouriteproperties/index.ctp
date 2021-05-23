<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv">
<div class="page-wrapper">
    <div class="main-wrapper">
	    <div class="main">
	        <div class="main-inner">
	        		        
					<div class="content-title">
	<div class="content-title-inner">
		<div class="container">		
			<h1><?php echo __('Favourite');?> <span><?php echo __('Properties');?></h1>	
		</div><!-- /.container -->
	</div><!-- /.content-title-inner -->
</div><!-- /.content-title -->
				

	            <div class="content">
	                <div class="container">
			<?php echo $this->Session->flash();?>
			<?php if($searchRecord=="Yes"){?>
			<div class="filter filter-gray push-bottom">			
			<div class="row">
			
	<div class="col-sm-12">
		<?php echo $this->element('pagination',array('IsSearch'=>'No','IsDropdown'=>'No'));?>
	</div><!-- /.col-* -->
	
	</div><!-- /.row -->
	
			</div>			
			<?php }?>
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="row">
					<?php  foreach($fProperty as $post):
					$this->Function->gridProperty($record,$post,$currency,'<div class="col-md-6 col-lg-4 col-xl-3">');echo$record;?>
					<?php unset($post);endforeach;?>
					</div><!-- /.row -->
<?php if($searchRecord=="Yes"){?>
			<div class="filter filter-gray push-bottom">			
			<div class="row">
			
	<div class="col-sm-12">
		<?php echo $this->element('pagination',array('IsSearch'=>'No','IsDropdown'=>'No'));?>
	</div><!-- /.col-* -->
	
	</div><!-- /.row -->
	
			</div>			
			<?php }?>
		</div><!-- /.container -->
	            </div><!-- /.content -->
	        </div><!-- /.main-inner -->
	    </div><!-- /.main -->
    </div><!-- /.main-wrapper -->
</div><!-- /.page-wrapper -->
</div><!--Ajax-->

