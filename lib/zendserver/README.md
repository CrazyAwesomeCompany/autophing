AutoPhing Zend Server
========================

Zend Server WebAPI targets

## Targets ##

### cacheClear ###
Clear the various Zend Server caches.
* Zend Data Cache
* Zend Page Cache
* Zend Optimizer+

Example:
```
<cacheClear component="${zendserver.cacheClear.datacache}"/>
```

### tasksComplete ###
Task to check if asynchronous tasks like ```cacheClear``` have completed.

Poll every second example:
```
<tasksComplete waitUnit="1" />
```

## Configuration ##
Minimally set to the following config options:
* zendserver.config.user
* zendserver.config.apiKey

## Dependencies ##
None
