AutoPhing SOLR
==============

Run SOLR Api commands

## Targets ##

### solr-core-create ###
Create a (new) core in SOLR based on source configuration in your project. It will move the config to the running
solr instance.

### solr-api-core-create ###
Create a core configuration

### solr-api-core-reload ###
Reload a core configuration

### solr-api-core-unload ###
Remove a solr core

## Configuration ##

+ `solr.http.url` - The SOLR http location. Defaults to `http;//localhost:8983/solr/`
+ `solr.config.source` - The SOLR config project location (source files)
+ `solr.config.destination` - The SOLR config folder
+ `solr.core.source` - The SOLR core source configuration
+ `solr.core.name` - The SOLR core name


