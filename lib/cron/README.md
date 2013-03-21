AutoPhing Cron
==============

Adding Cron files to your system environment

## Usage ##
The cron targets adds/deletes cron files to the server crontab. It's possible to specify different cron files per
application and environment. These are used in the filenames. A cron filename in the `cron.files` directory should look like:

`appname-environment-filename`

Example:

`autophing-production-mycron`

## Targets ##

### cron-deploy ###
Execute target `cron-delete-files` and `cron-copy-files`

### cron-copy-files ###
Copy the project cron files to the cron folder to be executed by the cron program

### cron-delete-files ###
Delete all old cron files from the cron folder

### cron-start ###
Start the cron program

### cron-stop ###
Stop the cron program

### cron-restart ###
Restart the cron program

## Configuration ##

+ `cron.files` - Location where the project cron files are
+ `cron.location` - Location on the server where the project cron files should be placed
+ `cron.program` - The cron program location

#### Global configuration ####
The cron targets use some global project properties to know which cron files should be copied/deleted.

+ `project.app` - Name of the project application
+ `project.environment` - Environment the project is running (production/staging/testing/development/etc)

## Dependencies ##
A Cron program installed on the server
