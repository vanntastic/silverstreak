#!/usr/local/bin/ruby
# A quick deployment script using rsync, just define FROM, SERVER, and TO

# the location of the project
FROM = "~/location/of/your/project"
# the ip or hostname of the server, can use the following conventions for this variable:
#   - server_name # => if you have server_name setup in ~/.ssh/config
#   - username@host 
SERVER = "project_hostname"
# the location on the server don't forget to append the slash/
TO = "~/location/of/project/on/server"

puts("Starting deployment...")
# use -avzC to exclude .git and .svn repositories
system("rsync -avz #{FROM} #{SERVER}:#{TO}")
puts("Deployment Completed!...")