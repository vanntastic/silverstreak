# if you are using textmate (or e?) then grab the textmate snippet here:
#   http://snipplr.com/view/8355/capistrano-recipe-for-staticphp-sites/
# 
# 1. fill in all your values
# 2. cap:setup
# 3. cap:deploy
# 4. apache:setup # if you're using apache2
# anytime after that just cap:deploy

set :application, "app"
set :repository, "svn://"
set :port, "22"

role :web, "yoursite.com" #eg "myapp.com" or "123.456.789.10"
role :app, "yoursite.com"
role :db, "yoursite.com", :primary => true
set :user, 'user'
# set :use_sudo, false

set :svn_repository_url, 'svn://'
set :checkout, 'export'
set :deploy_via, :export
set :home_path, "/home/path"
set :deploy_to, "deploy/path"
set :shared_dir, "shared"
set :log, "#{shared_dir}/log"
set :etc, "#{shared_dir}/etc"

# if you are using apache, here's some stuff to set
set :apache_root, "/etc/apache2"
set :apache_vhosts_dir, "#{apache_root}/sites-available"

namespace :deploy do
  task :restart do
    # no need to restart the app
  end
end

namespace :apache do
  
  desc 'Setup the vhost and enable the site'
  task :setup do
    vhost = <<-HOST
<VirtualHost *:80>
  ServerName your.site
  ServerAlias www.your.site

  DocumentRoot #{deploy_to}/current/public     
</VirtualHost>
    HOST
    
    put vhost, "#{home_path}/#{application}.tmp"
    sudo "mv #{home_path}/#{application}.tmp #{apache_vhosts_dir}/#{application}"
    
    enable_site
  end
  
  desc 'Enables the site'
  task :enable_site do
    sudo "a2ensite #{application}"
    reload
  end

  desc 'Reloads apache'
  task :reload do
    sudo "/etc/init.d/apache2 reload"
  end
  
  desc 'Restarts apache gracefully'
  task :restart do
    sudo "apache2ctl graceful"
  end
  
end


