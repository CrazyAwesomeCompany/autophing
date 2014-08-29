<?php

require_once __DIR__ . '/../Webistrano.php';

/**
 * Webistrano Status
 *
 */
class Webistrano_Status extends Webistrano
{
    /**
     * The Webistrano Project ID
     *
     * @var integer
     */
    protected $projectId;

    /**
     * The Webistrano Project Stage ID
     *
     * @var integer
     */
    protected $stageId;

    /**
     * The Webistrano Deployment number
     *
     * @var integer|string
     */
    private $deployment = 'latest';


    /**
     * {@inheritDoc}
     */
    public function main()
    {
        $status = $this->getStatus();

        $this->log(sprintf('Deployment [%s] status: %s', $this->deployment, $status['status']));
    }

    /**
     * Get Webistrano Deployment status
     *
     * @return array
     */
    protected function getStatus()
    {
        $path = sprintf('/projects/%d/stages/%d/deployments/%s.xml', $this->projectId, $this->stageId, $this->deployment);
        $xmldata = $this->request($path);

        if (!$xmldata) {
            throw new BuildException('Could not retrieve status from Webistrano');
        }

        return array(
            'id' => (string) $xmldata->id,
            'status' => (string) $xmldata->status
        );
    }

    /**
     * (non-PHPdoc)
     * @see Webistrano::validate()
     */
    protected function validate()
    {
        parent::validate();

        if (!$this->projectId) {
            throw new BuildException('Webistrano `projectid` is required');
        }

        if (!$this->stageId) {
            throw new BuildException('Webistrano `stageid` is required');
        }
    }

    /**
     * Set project
     *
     * @param integer $project
     */
    public function setProjectid($project)
    {
        $this->projectId = $project;
    }

    /**
     * Set stage
     *
     * @param integer $stage
     */
    public function setStageid($stage)
    {
        $this->stageId = $stage;
    }

    /**
     * Set deployment
     *
     * @param integer $deployment
     */
    public function setDeployment($deployment)
    {
        if (!$deployment) {
            $deployment = 'latest';
        }

        $this->deployment = $deployment;
    }
}
