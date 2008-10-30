#!/usr/local/bin/ruby
# A quick deployment script using rsync, just define FROM, SERVER, and TO

# the location of the project
FROM = "~/location/of/your/project"
# the ip or hostname of the server
SERVER = "project_hostname"
# the location on the server
TO = "~/location/of/project/on/server"

puts("Starting deployment...")
system("rsync -avzC #{FROM} #{SERVER}:#{TO}")
puts("Deployment Completed!...")