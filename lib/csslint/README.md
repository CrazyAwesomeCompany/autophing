AutoPhing CSSLint
==============

Run CSSLint

## Usage ##
TODO

## Targets ##

### csslint ###
Execute CSSLint and output to file.

### csslint-tty ###
Execute CSSLint and output to screen

## Dependencies ##
You need Rhino installed on your environment and the CSSLint file. You can install those also with Composer. Add the
Rhino and Csslint repositories to your Repositories.

    {
        "type": "package",
        "package": {
            "name": "mozilla/rhino",
            "version": "v1.7.3",
            "dist": {
                "url": "ftp://ftp.mozilla.org/pub/mozilla.org/js/rhino1_7R3.zip",
                "type": "zip"
            }
        }
    },
    {
        "type": "package",
        "package": {
            "name": "stubbornella/csslint",
            "version": "v0.9.10",
            "dist": {
                "url": "https://github.com/stubbornella/csslint/archive/v0.9.10.zip",
                "type": "zip"
            }
        }
    }

>Version 1.7R4 of Rhino will not work with CSSLint. Use 1.7R3
