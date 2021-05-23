
<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>


<script type="text/javascript"> var connectorUrl = '<?php echo $connectorUrl?>';var language = '<?php echo $language?>';var FileBrowserDialogue = {init: function() {},mySubmit: function (URL) {top.tinyMCE.activeEditor.windowManager.getParams().setUrl(URL);top.tinyMCE.activeEditor.windowManager.close();}};$().ready(function() {var elf = $('#elfinder').elfinder({lang : language,url: connectorUrl,getFileCallback: function(file) {FileBrowserDialogue.mySubmit(file);}}).elfinder('instance');});</script>
