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

### restartPhp ###
Restart the Zend Server instance or cluster either graceful or forced. The force parameter is optional.

```
<restartPhp force="true" />
```

### tasksComplete ###
Task to check if asynchronous tasks like `cacheClear` have completed.

Poll every second example and wait for maximum seconds. These are optional values, and the defaults are shown here.
```
<tasksComplete waitUnit="1" maxWait="30" />
```

## Configuration ##
Minimally set to the following config options:
* zendserver.config.user
* zendserver.config.apiKey

## Dependencies ##
None
