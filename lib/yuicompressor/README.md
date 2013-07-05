AutoPhing YUICompressor
=======================

Run YUICompressor

## Targets ##

### yuicompressor ###
Execute YUICompressor and output to file.

## Dependencies ##
You need the YUICompressor jar file and java installed to execute. The jar file kan be downloaded through Composer.

    {
        "type": "package",
        "package": {
            "name": "yui/yuicompressor",
            "version": "2.4.8",
            "dist": {
                "url": "http://tml.github.io/yui/yuicompressor-2.4.8.zip",
                "type": "zip"
            }
        }
    },
    {
        "type": "package",
        "package": {
            "name": "yui/yuicompressor",
            "version": "2.4.7",
            "dist": {
                "url": "http://tml.github.io/yui/yuicompressor-2.4.7.zip",
                "type": "zip"
            }
        }
    }

