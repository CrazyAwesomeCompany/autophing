# AutoPhing Git

Perform Git commands

## Targets ##

### git-changeset-files ###
Get the files from a git diff. The results are stored in the `files.changeset` and `files.changeset.php` properties.

An example usage of this command is to get the changed PHP files for a Pull Request and run quality checks only
against the changeset.

## Configuration ##

+ `git.file` - The Git binary file
+ `git.revision` - The Git revision to compare
+ `git.base.revision` - The Git revision use as base
