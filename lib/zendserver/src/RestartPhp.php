<?php
require_once 'WebApiTask.php';

/**
 * Restart Server phing task.
 *
 */
class RestartPhp extends WebApiTask
{
    /**
     * @var mixed
     */
    protected $force = null;

    public function setForce($force)
    {
        $this->force = $force;
    }

    public function getForce()
    {
        return $this->force;
    }

    public function main()
    {
        try {
            if (null !== $this->getForce()) {
                $this->setParams(array('force' => 'TRUE'));
            }
            $this->executeApiTask('restartPhp');
            echo 'Server restarted';
        } catch(RuntimeException $e) {
            echo $e->getMessage();
        }

        echo PHP_EOL;
    }
}
