function setup() {alert("S");
tinyMCE.init({
			selector: "textarea",
                        theme: "modern",
                        plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor responsivefilemanager youtube colorpicker"
    ],
    relative_urls: true,
    browser_spellcheck : true ,
    filemanager_title:"Filemanager",    
    codemirror: {
    indentOnInit: true, // Whether or not to indent code on init. 
    path: 'CodeMirror'
  },
    toolbar1: "insertfile undo redo | styleselect fontselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
    toolbar2: "link image media youtube emoticons | colorpicker forecolor backcolor | preview print code ",
    image_advtab: true,
});
		}		