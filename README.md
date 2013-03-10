AutoPhing
=========

Phing targets to import and use.

## Usage ##
Create your `build.xml` file and import the target xml files you want to use.

### Importing build files ###
Importing the AutoPhing build files can be done with the ImportTask. This will import the targets into your own build file.

Example import
`<import file="zf/zf.xml" />`

### Overwriting configuration ###
A lot of the AutoPhing build files use configuration parameters to run the commands. Those parameters are defined in the `.properties` files in the same directory. You can override those parameters with your own by just specifying them in your own build file.

