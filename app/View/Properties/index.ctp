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
			<h1><?php echo __('Search Properties');?></h1>
		</div><!-- /.container -->
	</div><!-- /.content-title-inner -->
</div><!-- /.content-title -->
<div class="row">
	            <div class="content">
	                <div class="container">
			<?php echo $this->Session->flash();?>
			<?php if($searchRecord=="1"){?>
			<div class="filter filter-gray push-bottom">			
			<div class="row">
			
	<div class="col-sm-12">
		<?php echo $this->element('pagination',array('IsSearch'=>'No','IsDropdown'=>'No'));?>
	</div><!-- /.col-* -->
	<div class="col-sm-12">
		<div>
			<strong><?php echo __('Sort By');?></strong>
			<?php echo $this->Paginator->sort('price', __('Price'), array('direction' => 'asc'));?> |
			<?php echo $this->Paginator->sort('created', __('Date Added'), array('direction' => 'asc'));?>
		</div><!-- /.filter-sort -->
		
	</div><!-- /.row -->
	</div><!-- /.row -->
	
			</div>			
			<?php }?>
	
	<div class="row">
	<div class="col-md-4 col-lg-3"> 			
			<div class="widget">
   	                     
<header id="head" class="secondary">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				
    <h3 class="widgettitle"><?php echo __('Quick Search');?></h3>
			</div>
		</div>
	</div>
</header>
<?php echo $this->Form->create(array( 'controller' => 'Properties', 'action' => 'index','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
    <div class="col-sm-12">
      <div class="row">
	<div class="col-sm-12">
	  <?php echo $this->Form->select('type',$type,array('empty'=>__('Type'),'label' => false,'class'=>'form-control','div'=>false));?>
	</div>
	<div class="col-sm-12">
	  <?php echo $this->Form->select('contract',$contract,array('empty'=>__('Contract'),'label' => false,'class'=>'form-control','div'=>false));?>
	</div>
	<div class="col-sm-12">
	  <?php echo $this->Form->select('location',$location,array('empty'=>__('Location'),'label' => false,'class'=>'form-control','div'=>false));?>
	</div>
	<div class="col-sm-12">
	  <?php echo $this->Form->input('keyword',array('label' => false,'class'=>'form-control','placeholder'=>__('Keyword'),'div'=>false));?>
	</div>
	<div class="col-sm-6">
	  <?php echo $this->Form->input('start_price',array('type'=>'number','label' => false,'class'=>'form-control','placeholder'=>__('Price From'),'div'=>false));?>
	</div>
	<div class="col-sm-6">
	  <?php echo $this->Form->input('end_price',array('type'=>'number','label' => false,'class'=>'form-control','placeholder'=>__('Price To'),'div'=>false));?>
	</div>	  
	<div class="col-sm-6">
	  <?php echo $this->Form->input('bedroom',array('label' => false,'class'=>'form-control','placeholder'=>__('Beds'),'div'=>false));?>
	</div>  
	<div class="col-sm-6">
	  <?php echo $this->Form->input('bathroom',array('label' => false,'class'=>'form-control','placeholder'=>__('Baths'),'div'=>false));?>
	</div>
	<div class="col-sm-12">
	  <?php echo $this->Form->input('uniq_id',array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>__('Property ID'),'div'=>false));?>
	</div>
	<div class="col-sm-12"><?php echo $this->Form->button('<i class="fa fa-search"></i>&nbsp;'.__('Search'),array('class'=>'btn btn-primary btn-block'));?>
	</div>
	<div class="col-sm-12"><?php echo $this->Html->link('<i class="fa fa-close"></i>&nbsp;'.__('Reset'),array('controller'=>'Properties'),array('class'=>'btn btn-danger btn-block','escape'=>false));?>
	</div>
      </div>
    </div>
    <?php echo $this->Form->end();?>
    
                        </div><!-- /.widget -->					
		</div><!-- /.col-* -->
		<div class="col-md-8 col-lg-9">
			<div class="row">
				<?php
				foreach($property as $post):
				$this->Function->gridProperty($record,$post,$currency,'<div class="col-md-6 col-lg-4">');echo$record;?>
			<?php unset($post);endforeach;?>	
			</div><!-- /.row -->
				
		</div><!-- /.col-sm-* -->
	</div><!-- /.row -->
	<?php if($searchRecord=="Yes"){?>
	<div class="filter filter-gray push-bottom">
			<div class="row">
	<div class="col-sm-12">
		<?php echo $this->element('pagination',array('IsSearch'=>'No','IsDropdown'=>'No'));?>
	</div><!-- /.col-* -->
	<div class="col-sm-12">
		<div>
			<strong><?php echo __('Sort By');?></strong>
			<?php echo $this->Paginator->sort('price', __('Price'), array('direction' => 'asc'));?> |
			<?php echo $this->Paginator->sort('created', __('Date Added'), array('direction' => 'asc'));?>
		</div><!-- /.filter-sort -->
		
	</div><!-- /.row -->
	</div><!-- /.row -->
			</div>
			<?php }?>
</div><!-- /.container -->
	            </div><!-- /.content -->
	        </div><!-- /.main-inner -->
	    </div><!-- /.main -->
    </div><!-- /.main-wrapper -->
</div><!-- /.page-wrapper -->
</div><!--Ajax--></div>