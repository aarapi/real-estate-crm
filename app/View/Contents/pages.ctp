<div class="main-wrapper">
	    <div class="main">
	        <div class="main-inner">
	        		        
	<div class="content-title">
                <div class="content-title-inner">
                        <div class="container">		
                                <h1><?php echo h($linkName1);?> <span><?php echo h($linkName2);?></span></h1>	
                        </div><!-- /.container -->
                </div><!-- /.content-title-inner -->
        </div><!-- /.content-title -->
	            <div class="content">
	                <div class="container">
                                <?php echo str_replace("<script","",$contentPost['Content']['main_content']);?>
                        </div><!-- /.container -->
	            </div><!-- /.content -->
	        </div><!-- /.main-inner -->
	    </div><!-- /.main -->
    </div><!-- /.main-wrapper -->

