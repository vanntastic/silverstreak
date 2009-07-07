<?php
	// anchor hoook similar to rails' link_to function
	// USAGE : link_to("My Page", "my_page", "your_title")
	// you can also pass without href if content is the same name
	// 		   link_to("Home") // => <a href="home" title="Home">Home</a>
	// it also adds dashes in strings with spaces so if you name your pages like special-order.php then you can do:
	//         link_to("Special Order") // => <a href="special-order" title="Special Order"></a>
	// it also applies an 'over' class for state based navigation...
	function link_to($content='',$href='',$title='')
	{
		$href = ($href == '') ? strtolower(dasherize($content)) : $href;
		$title = ($title == '') ? $href : $title;
		
		if ($href==this_file()) {
		  $klass ='over';
		}
		
		// allows you to set a link to / and still set an over class
		if ($href=='/' && this_file() == 'index.php') {
		  $klass ='over';
		}
		
		echo "<a href='" . $href . "' title='" . $title . "' class='" . $klass . "'>" . $content . "</a>";
	}
	
	/* links to the css files in your css directory
  	 you can pass either a string or array of files... and it should
     include them all
     EXAMPLE:
     for multiple files
     include_css(array('default','reset'));
     <link href='css/default.css' ...
     <link href='css/reset.css' ...
     for single files
     include_css('reset');
     <link href='css/reset.css' ... */
  
	function include_css($files='')
	{
	  $css_link = '';
	  if (is_array($files)) {
	   for ($i=0; $i < count($files); $i++) { 
	     $css_link .= "<link rel='stylesheet'";
	     $css_link .= " href='css/" . $files[$i] . ".css' type='text/css'";
	     $css_link .= " media='screen' />\n";
	   }
	  } else {
      $css_link .= "<link rel='stylesheet'";
	    $css_link .= " href='css/" . $files . ".css' types='text/css' media='screen' />\n";
	  }
	  echo $css_link;
	}
	
	/* links to the js files in your javascripts directory
  	 you can pass either a string or array of files... and it should
     include them all
     EXAMPLE:
       for multiple files
       include_js(array('jquery','app'));
       <link href='javascripts/jquery.js' ...
       <link href='javascripts/app.js' ...
       for single files
       include_css('app');
       <link href='javascripts/app.js' ... */
	
	function include_js($files='')
	{
	  $js_link = '';
	  if (is_array($files)) {
	   for ($i=0; $i < count($files); $i++) { 
	     $js_link .= "<script type='text/javascript'";
	     $js_link .= " src='javascripts/" . $files[$i] . ".js'></script>\n";
	   }
	  } else {
      $js_link .= "<script type='text/javascript'";
      $js_link .= " src='javascripts/" . $files . ".js'></script>\n";
	  }
	  echo $js_link;
	}
	
  // google ajax api hook : include any js library you want courtesy of google!
  // EXAMPLE:
  //  Single Library
  //    include_js_lib('jquery-1.3.2');
  //  Multiple Libraries
  //    include_js_lib('jquery-1.3.2','jqueryui-1.7.2');
  // --
  // Google Documentation : http://code.google.com/apis/ajaxlibs/documentation/index.html
	function include_js_lib($libs='')
	{
	  $js_libs = '';
    $content = '<script src="http://www.google.com/jsapi"></script>';
    if (is_array($libs)) {
      for ($i=0; $i < count($libs); $i++) { 
        $_lib = split("-",$libs[$i]);
        $lib = $_lib[0];
        $_version = split("-",$libs[$i]);
        $version = $_version[1];
        $js_libs .= "google.load('${lib}','${version}');";
      }
    } else {
        $_lib = split("-",$libs);
        $lib = $_lib[0];
        $_version = split("-",$libs);
        $version = $_version[1];
        $js_libs = "google.load('${lib}','${version}');";
    }
    $output = $content;
    $output .= '<script type="text/javascript" charset="utf-8">';
    $output .= $js_libs;
    $output .= '</script>';
    echo $output;
	}
	
  // simply a way to include a file based on the _filename.php convention
  // EXAMPLE : to include a nav partial (_nav.php), just do partial('nav');
	function partial($name) {
	  $file = "_" . $name . ".php";
	  include $file;
	}
	
	// displays a partial if the the condition is true
  // USAGE : display_partial_if((1==1),'data_output');
	function display_partial_if($condition, $partial)
	{
	  if ($condition) { partial($partial); }
	}
	
	function dasherize($string)	{ return str_replace(" ","-",$string);}
	function underscore($string) { return str_replace(" ","_",$string);}
	
	function select_for_states($name_of_select='state')
	{
		$select = "<select name='" . $name_of_select . "' id='" . $name_of_select . "'>";
		$states = '
		<option selected="selected" value="">--Choose One--</option>
			<option value="AL">Alabama</option>
			<option value="AK">Alaska</option>
			<option value="AZ">Arizona</option>
			<option value="AR">Arkansas</option>

			<option value="CA">California</option>
			<option value="CO">Colorado</option>
			<option value="CT">Connecticut</option>
			<option value="DE">Delaware</option>
			<option value="FL">Florida</option>
			<option value="GA">Georgia</option>

			<option value="HI">Hawaii</option>
			<option value="ID">Idaho</option>
			<option value="IL">Illinois</option>
			<option value="IN">Indiana</option>
			<option value="IA">Iowa</option>
			<option value="KS">Kansas</option>

			<option value="KY">Kentucky</option>
			<option value="LA">Louisiana</option>
			<option value="ME">Maine</option>
			<option value="MD">Maryland</option>
			<option value="MA">Massachusetts</option>
			<option value="MI">Michigan</option>

			<option value="MN">Minnesota</option>
			<option value="MS">Mississippi</option>
			<option value="MO">Missouri</option>
			<option value="MT">Montana</option>
			<option value="NE">Nebraska</option>
			<option value="NV">Nevada</option>

			<option value="NH">New Hampshire</option>
			<option value="NJ">New Jersey</option>
			<option value="NM">New Mexico</option>
			<option value="NY">New York</option>
			<option value="NC">North Carolina</option>
			<option value="ND">North Dakota</option>

			<option value="OH">Ohio</option>
			<option value="OK">Oklahoma</option>
			<option value="OR">Oregon</option>
			<option value="PA">Pennsylvania</option>
			<option value="RI">Rhode Island</option>
			<option value="SC">South Carolina</option>

			<option value="SD">South Dakota</option>
			<option value="TN">Tennessee</option>
			<option value="TX">Texas</option>
			<option value="UT">Utah</option>
			<option value="VT">Vermont</option>
			<option value="VA">Virginia</option>

			<option value="WA">Washington</option>
			<option value="DC">Washington, D.C.</option>
			<option value="WV">West Virginia</option>
			<option value="WI">Wisconsin</option>
			<option value="WY">Wyoming</option>';
			
		$options = $select . $states . "</select>";
		echo $options;
	}

	// returns the filename of the current file .. useful for using in code
	function this_file()
	{
		$currentFile = $_SERVER["SCRIPT_NAME"];
	  $parts = Explode('/', $currentFile);
	  $currentFile = $parts[count($parts) - 1];
		return $currentFile;
	}
	
	// echos this file ... useful if you need to display the file name on the page...
	function this_page(){ echo this_file(); }

  // alias for $_SERVER['REQUEST_METHOD']
  function request_method(){ return $_SERVER['REQUEST_METHOD']; }
	
  // a nice easy way to check to see if the form has been posted
  // USAGE : is_form_submitted("submit_button_value","your_request_method")
  // EX : if(is_form_submitted){ 
  //  // do stuff when the form is submitted...
  // }
  function is_form_submitted($submit_name="submit", $method="POST"){
    $m = ($method=="POST") ? $_POST : $_GET;
    if ((request_method() == $method) && isset($m[$submit_name])) {
      return true;
    };
  }
  
  // simple helper for submit button
  // submit_btn("Submit Value")
  function submit_btn($value='Submit')
  {
    echo('<input type="submit" value="' . $value . '" name="submit" id="submit">');
  }
  
	// shortcut for checking on the post request
	function is_post_request(){
    if (request_method() == "POST"){
      return true;
    }
	}
	
	// shortcut for checking on the get request
	function is_get_request(){
    if (request_method() == "GET"){
      return true;
    }
	}
	
	// useful for having state based navigation...
	function nav_class_for($btn, $over_class="over")
	{
	  $btn_class = explode(".", this_file());
	  if ($btn_class[0] == $btn) { 
	    echo $over_class;
    }
	}
	
	function yield()
	{
	  $view_file = 'views/' . this_file();
	  if (file_exists($view_file)) {
      include($view_file);
    } else {
      echo "View for ". $this_file() . " cannot be found...";
    }
	}
	
?>
