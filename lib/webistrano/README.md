# AutoPhing Webistrano

Webistrano target to call Webistrano deploys from Phing

## Targets

### webistrano-deploy
Deploy a stage with Webistrano

Required Target configuration:

+ `webistrano.deploy.branch`: Branch to deploy. This can also be a Git commit hash

### webistrano-status
Get the status of a Webistrano deploy

Optional target configuration:

+ `webistrano.deployment`: The Webistrano Deployment ID to check (default: latest)

## Configuration

Required:

+ `webistrano.url`: Base url of the Webistrano environment
+ `webistrano.username`: Webistrano user
+ `webistrano.password`: Webistrano password
+ `webistrano.project`: The Project ID
+ `webistrano.project.stage`: The Stage ID

## Dependencies

cUrl is used to retrieve the status from Webistrano
