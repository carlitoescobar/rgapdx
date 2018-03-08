<?php 
	extract($_GET);
	$font = explode('/', $font); 
	$font_family = explode('-', $font[1]);
?>
<html>
	<head>
	</head>
	<?php
	switch ($font[0]) {
	    case 'default':
	    	echo '
	    	<style type="text/css">
		      body{
		      	font-family: '.$font[1].';
		      }
		    </style>';
	        break;
	    case 'google':
	    	$google_font = explode(':',$font[1]);
	    	echo 
	         '<script type="text/javascript">
	      		WebFontConfig = {
	        		google: { families: [ "'.$google_font[0].'" ] }
	      		};
	      		(function() {
			        var wf = document.createElement("script");
			        wf.src = ("https:" == document.location.protocol ? "https" : "http") +
			            "://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";
			        wf.type = "text/javascript";
			        wf.async = "true";
			        var s = document.getElementsByTagName("script")[0];
			        s.parentNode.insertBefore(wf, s);
			    })();
		    </script>
		    <style type="text/css">
		      body{
		      	font-family: '.$google_font[0].';
		      	font-weight: '.$google_font[1].';
		      }
		    </style>';
	        break;
   	}
	?>
	<style type="text/css">
	.preview-text{
		width: 112px;
		border: 3px solid #666;
		padding: 30px;
		font-size: 20px;
	}
	</style>
	<body>

		<div class="preview-text">Hello World</div>
	</body>
</html>