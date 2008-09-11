namespace :silverstreak do
  
  desc 'Generates the public dir and copies over the template files'
  task :install do
    system("mkdir -p ../public")
    system("mkdir -p ../public/images")
    system("rsync -aC templates/* ../public")

    # differentiate between development and production modes
    folder_name = Dir.entries("..").include?("core") ? "core" : "silverstreak"
      
    File.open("../public/_dispatch.php", "w+") do |file|
      file << "<?php\n"
      file << "// initialization file for helpers\n"
      file << "include '../" << folder_name << "/_helpers.php';\n"
      file << "include 'helpers/application.php'; \n"
      file << "$form_helper = 'form_helpers/' . this_file();\n"
      file << "$email_to = 'you@yourplace.com';\n"
      file << "if (file_exists($form_helper)) {\n"
      file << "  // parses form values, so you can do $name instead of $_POST['name']\n"
      file << "  foreach ($_POST as $index => $value) {\n"
      file << "    $$index = $value;\n"
      file << "  }\n"
      file << "  include $form_helper;\n"
      file << " }\n"
      file << "$layout_file = 'layouts/' . this_file();\n"
      file << "$app_layout = 'layouts/' . 'application.php';\n"
      file << "$helper_file = 'helpers/' . this_file();\n"
      file <<  "if (file_exists($layout_file)) {\n"
      file <<  "  include($layout_file);\n"
      file <<  "} else {\n"
      file <<  "  include($app_layout);\n"
      file << "}\n"
      file << "if (file_exists($helper_file)) { include($helper_file); }\n"
      file << "initialize(); \n"
      file << "?>"
    end
    
    # generate the htaccess file
    File.open("../public/.htaccess", "w+") do |file|
      file << "# Request SEO friendly urls\n"
      file << "RewriteEngine on\n"
      file << "RewriteCond %{REQUEST_FILENAME} !-d\n"
      file << "RewriteCond %{REQUEST_FILENAME}\.php -f\n"
      file << "RewriteRule ^(.*)$ $1.php\n"
    end

    puts "====="
    puts "Silverstreak installed successfully!"
  end
end
