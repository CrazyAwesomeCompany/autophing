AutoPhing
=========

Phing targets to import and use. The goal of this library to plugin your favorite development/quality tools
in your project and run it with a simple command.

## Usage ##
Create your `build.xml` file and import the target xml files you want to use.

### Importing build files ###
Importing the AutoPhing build files can be done with the ImportTask. This will import the targets into your own build file.

Example import
`<import file="zf/zf.xml" />`

### Overwriting configuration ###
A lot of the AutoPhing build files use configuration parameters to run the commands. Those parameters are defined in the `.properties` files in the same directory. You can override those parameters with your own by just specifying them in your own build file.

## Available AutoPhing Programs

+ [Composer](lib/composer/README.md)
+ [Cron](lib/cron/README.md)
+ [CSSLint](lib/csslint/README.md)
+ DBDeploy
+ Doctrine
+ [Java](lib/java/README.md)
+ [JSLint](lib/jslint/README.md)
+ Memcached
+ [Mysql](lib/mysql/README.md)
+ PatchDB
+ PDepend
+ PHP Code Sniffer
+ [PHPLint](lib/phplint/README.md)
+ PHPMD
+ PHPUnit
+ [Swagger](lib/swagger/README.md)
+ [Webistrano](lib/webistrano/README.md)
+ [YUICompressor](lib/yuicompressor/README.md)
+ [Zend Framework](lib/zf/README.md)
+ [Zend Framework 2](lib/zf2/README.md)
+ [Zend Server](lib/zendserver/README.md)

