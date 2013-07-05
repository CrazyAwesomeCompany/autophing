AutoPhing JSLint
==============

Run JSLint

## Targets ##

### jslint ###
Execute JSLint and output to file.

### jslint-tty ###
Execute JSLint and output to screen

## Configuration ##

TODO

## Dependencies ##
You need the JSLint4Java jar to run jslint.. You can install thoe also with Composer. Add the
JSLint4Java binary to your repositories.

    {
        "type": "package",
        "package": {
            "name": "jslint/jslint4java",
            "version": "2.0.5",
            "dist": {
                "url": "https://jslint4java.googlecode.com/files/jslint4java-2.0.5-dist.zip",
                "type": "zip"
            }
        }
    }
