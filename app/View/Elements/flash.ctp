<div class="alert alert-<?php echo (isset($alert)? $alert : 'info' ) ?>">
<button type="button" class="close" data-dismiss="alert">x</button>
<center><?php echo (isset($message)? $message : __('Something went wrong') ) ?></center>
</div>