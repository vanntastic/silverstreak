<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Your title here</title>
		<script type="text/javascript" src="javascripts/prototype.js"></script>
		<script type="text/javascript" src="javascripts/css-browser-select.js"></script>	

		<link rel="stylesheet" href="css/default.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
		
		<style type="text/css" media="screen">
		  h1, #container{
		    margin:1em;padding:1em;border:1px solid #ccc;background-color:#eee;
		  }
		</style>
	</head>

	<body>
		<h1 
		  style="">
      Welcome to Silverstreak!
    </h1>
    
    <div id="container">
  	   <?php yield(); ?>
    </div>
	</body>
</html>
