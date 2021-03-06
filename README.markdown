Silverstreak
============

This is a small php framework... actually more like a collection of files if you will. This
set of files that might be useful if you are under the following situations:

1. Designing a brochure (5-6 page) website and maybe it has a form
2. Don't need a database
3. Using a LAMP Stack
4. Want an easier way to work with the post/get requests and/or forms for that matter

Features
--------

1. an .htaccess for nice SEO friendly urls, so you can call pages with 'index' instead
of index.php, this only works on the the main root directory and not any subdirectories
2. stop writing echo all the time, certain methods such as link_to automatically echoes the output, so:

INSTEAD OF:
     
       echo link_to("Home Page");
     
YOU CAN WRITE:
     
       link_to("Home Page")
     
3. nice abstraction methods for checking on request methods and form submitting
4. some form helpers and text helpers...
5. dry layouts and views, in the railsy format
6. rake generators for generating layouts and view stubs

Requirements
============

- Rake (get it at : http://rake.rubyforge.org/)
- Apache (Litespeed works okay though, except .htaccess doesn't work)

Installation
============

Just put the silverstreak folder inside a php site like so:

    - my_cool_website
      |- silverstreak

1. cd silverstreak
2. rake silverstreak:install
3. it should generate a public folder with all the files that you need in the root of 
   your web/project folder, so make sure you point your vhost to my_cool_website/public
4. it will generate a default index.php file for you, on any pages that you setup, make
   sure that the following line is at the top of the page, so that you can use all the
   features for silverstreak, the index file is basically a stub for the index view   
   (more information about layouts and views below):
   
     <?php include '_dispatch.php'; ?>   
   
   
How it Works
============

Think MVC without the Model or even the Controller, this is more like just the View and 
Layout, when you submit a request, this is what happens:
  
1. GET http://yoursite.com/
2. Attempts to find the default document (which might be 'index' in this case)
3. Renders index.php (which is just a stub) 
4. Looks for any form helpers/helpers/layouts/views named 'index', it will render the 
   application layout if the 'index' layout cannot be found
   
Generators
==========

Silverstreak uses rake to generate stubs for helpers, views, form_helpers, and layouts. 
Simply call Rake generate:[command] to use. Here are the following generators:
   
   1. generate:view FOR='name of view'
   2. generate:layout FOR='name of layout'
   3. generate:helper FOR='name of helper'
   4. generate:form_helper FOR='name of form helper'
   
Helpers and methods
===================

Silverstreak uses form helpers and standard page helpers, they are located in:
  
  Location of page helper
    - public/helpers/[name of request]
    
  Location of form helper
    - public/form_helpers/[name of request]
    
Page helpers are files that contain page specific methods that you can use for a specific 
page. Form helpers are somewhat like controllers, but their main purpose is to process 
forms. When you write form helpers, forget using the $_POST varables to access form 
values, simply call a form value by its name:

INSTEAD OF: 

      $_POST['first_name']
DO: 

      $first_name
  
An example of a form helper might look like this:
  
    if (is_form_submitted()) {
      $subject = "Someone has just contact you!";

      $body = "The following person has signed up: \n";
      $body .= "--------\n\n";  
      $body .= "Here is the information that was submitted:\n\n";
      $body .= "Email : $email\n";

      mail($email_to, $subject, $body, 'From:you@yourwebsite.com');
    }

Deployment
==========

Using capistrano is overkill, it has been replaced with rsync, chmod 755 config/deploy.rb 
Open and configure the following variables:

* FROM : location/of/project
* SERVER : hostname or ip of server
* TO : destination/of/project/on/server

Then run ./config/deploy.rb to deploy site

Public Helper Methods
=====================

link_to 
-------

Somewhat similar to rails' link_to method, this will automatically generate an anchor with
to the page you want it to link to.

    link_to($content='',$href='',$title='');
  
USAGE

    link_to("Home");
      #=> <a href='home' title='Home'>Home</a> # it works because of the .htaccess
    
    link_to("Home", "index.php");
      #=> <a href='index.php' title='Home'>Home</a>
    
    link_to("Home", "index.php", "Go to Home Page")
      #=> <a href='index.php' title='Go to Home Page'>Home</a>
  
partial
-------

Includes a file, I know you can use include, but if you following the convention of naming
your partials (pages) with a leading underscore (_) then it will automatically know that 
it is a partial.

    partial($name);

USAGE

    partial('nav') #=> include('_nav.php');
  
display_partial_if
------------------

Displays a partial if a given condition is true... can be useful if you are displaying 
user specific data.

    display_partial_if($condition, $partial);
  
USAGE

    display_partial_if(is_form_submitted(),'success');
    # => will display the success partial after the form is submitted
  
dasherize
---------

Replaces spaces in a string with dashes

    dasherize($string);
  
USAGE

    dasherize("Black magic woman");
    # => "Black-magic-woman";
  
underscore
----------

Replaces spaces in a string with underscores
  
    underscore($string);
  
USAGE

    underscore("Black magic woman");
    # => "Black_magic_woman";
  
select_for_states
-----------------

Generates a select form element that will have a list of all the states in the US.

    select_for_states($name_of_select='state');
  
this_file
---------

Returns the name of the current file in question

    this_file();
  
this_page
---------

Basically echoes this_file(), use this when you need to echo the page name

    this_page();
  
request_method
--------------

Returns the request method, (GET or POST), basically an abstraction from 
$_SERVER['REQUEST_METHOD'];

    request_method();
  
is_form_submitted
-----------------

Checks whether the form has been submitted or not.

    is_form_submitted($submit_name="submit", $method="POST");
 
is_post_request
---------------

Returns true if the request method for the page is POST

    is_post_request();
 
is_get_request
--------------

Returns true if the request method for the page is GET
 
    is_get_request();
 
include_css
-----------

Includes css files from the css directory, you can pass an array to include multiple css files.

    // single css file
    include_css('default');
  
    // multiple css files
    include_css(array('default','app'))
  
include_js
----------

Includes js files from the javascripts directory, you can pass an array to include 
multiple js files.

    // single js file
    include_js('app');

    // multiple js files
    include_js(array('jquery','app'))
  
yield
-----

Yields the output for the view, mainly used in layouts to designate where the view file 
will output to:

    // assuming this paragraph is in your layout file somewhere
    <p><?php yield(); ?></p>
  
include_js_lib
--------------

Hooks into the google ajax libraries, so you can use any library you want! get more info at [google](http://code.google.com/apis/ajaxlibs/)

    // include jquery 1.3.2
    include_js_lib('jquery-1.3.2');
    
    // include jquery 1.3.2 and jqueryui-1.7.2
    include_js_lib('jquery-1.3.2','jqueryui-1.7.2');
    
    
tag($name,$content,$attrs)
--------------------------

Creates an (opening and closing) html tag.

    // <h1 title="Sweet" class="heading">My Header</h1>
    tag('h1','My Header','title="Sweet" class="heading");
    
single_tag($name,$attrs)
------------------------

Creates a self closing tag.

    // <img src="http://www.google.com/intl/en_ALL/images/logo.gif" />
    single_tag('img', 'src="http://www.google.com/intl/en_ALL/images/logo.gif"');
    
output_tag($name,$content,$attrs)
---------------------------------

Echos an (opening and closing) tag.

    // <h1 title="Sweet" class="heading">My Header</h1>
    output_tag('h1','My Header','title="Sweet" class="heading");
    
output_single_tag($name,$attrs)
-------------------------------

Echos a self closing tag.

    // <img src="http://www.google.com/intl/en_ALL/images/logo.gif" />
    output_single_tag('img', 'src="http://www.google.com/intl/en_ALL/images/logo.gif"');