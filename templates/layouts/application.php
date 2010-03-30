<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Your title here</title>
    <?php include_js_lib('jquery-1.4.2','jqueryui-1.8.0'); ?>
    <?php include_js('app'); ?>
    <?php include_css(array('default','reset')); ?>
		
		<style type="text/css" media="screen">
		  h1, #container{
		    margin:1em;padding:1em;border:1px solid #ccc;background-color:#eee;
		  }
		</style>
	</head>

	<body>
		<h1>
      Welcome to Silverstreak!
    </h1>
    
    <div id="container">
  	   <?php yield(); ?>
    </div>
	</body>
</html>
