<?php

require_once "phing/BuildException.php";
require_once __DIR__ . '/Status.php';

/**
 * Webistrano Deploy
 *
 */
class Webistrano_Deploy extends Webistrano_Status
{
    /**
     * The revision to deploy
     *
     * @var string
     */
    private $revision;


    /**
     * {@inheritDoc}
     */
    public function main()
    {
        $params = array(
            'authenticity_token' => '',
            'deployment' => array(
                'task' => 'deploy',
                'description' => '',
                'prompt_config' => array(
                    'branch' => $this->revision
                ),
                'override_locking' => ''
            ),
            'commit' => 'Start deployment'
        );

        $path = sprintf('/projects/%d/stages/%d/deployments', $this->projectId, $this->stageId);
        $result = $this->request($path, $params, 'POST');

        $deploymentId = $this->getDeploymentId($result->saveXML());
        if ($deploymentId) {
            $this->setDeployment($deploymentId);
        }

        $status = null;
        do {
            sleep(2);
            $result = $this->getStatus();

            if (isset($result['status'])) {
                $status = $result['status'];
            } else {
                $status = 'failed';
            }
        } while ($status === 'running');

        if ('failed' === $status) {
            throw new BuildException("Webistrano deploy failed");
        }

        $this->log('Webistrano deploy success', Project::MSG_INFO);
    }

    /**
     * Get the Deployment ID from the curl call
     *
     * @param string $result
     *
     * @return integer|boolean
     */
    protected function getDeploymentId($result)
    {
        preg_match(
            sprintf(
                "/projects\/%d\/stages\/%d\/deployments\/(.*)\"/m",
                $this->projectId,
                $this->stageId
            ),
            $result,
            $matches
        );

        if (isset($matches[1])) {
            return $matches[1];
        }

        return false;
    }

    /**
     * (non-PHPdoc)
     * @see Webistrano_Status::validate()
     */
    protected function validate()
    {
        parent::validate();

        if (!$this->revision) {
            throw new BuildException('Webistrano `revision` is required');
        }
    }

    /**
     * Set revision
     *
     * @param string $revision
     */
    public function setRevision($revision)
    {
        $this->revision = $revision;
    }
}
