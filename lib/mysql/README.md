AutoPhing MySQL
===============

MySQL targets

## Targets ##

### mysql-dump ###
Dump a mysql database

## Configuration ##

+ `mysql.dump.file` - File where the mysql dump should be placed
+ `mysql.dump.gzip` - Gzip the mysqldump (true/false)

#### Global configuration ####
The mysql targets use some global properties shared between different AutoPhing targets

+ `database.host` - Database host=127.0.0.1
+ `database.user` - Database user
+ `database.password` - Database password
+ `database.name` - Database name
+ `database.port` - Database port

## Dependencies ##
+ MySQL installed on the command line
+ GZip command line program when enabling GZip compression
