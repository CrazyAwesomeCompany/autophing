<?php
require_once 'WebApiTask.php';

/**
 * Restart Server phing task.
 *
 */
class TasksComplete extends WebApiTask
{
    /**
     * @var boolean
     */
    private $tasksComplete = false;

    /**
     * @var integer
     */
    private $waitUnit = 1;

    /**
     * @var integer
     */
    private $maxWait = 30;

    /**
     * Set the interval to wait between checks
     */
    public function setWaitUnit($waitUnit)
    {
        $this->waitUnit = intval($waitUnit);
    }

    /**
     * Set the maximum waiting time
     */
    public function setMaxWait($maxWait)
    {
        $this->maxWait = $maxWait;
    }

    public function main()
    {
        try {
            do {
                $result = $this->executeApiTask('tasksComplete', self::HTTP_METHOD_GET);
                $this->tasksComplete = $this->getTasksComplete($result);
                if (!$this->tasksComplete) {
                    echo 'Waiting for tasks to complete' . PHP_EOL;
                    sleep($this->waitUnit);
                    $this->maxWait = $this->maxWait - $this->waitUnit;
                    if (0 >= $this->maxWait) {
                        throw new \RuntimeException('tasksComplete polling timed out!');
                    }
                }
            }
            while (!$this->tasksComplete);
        } catch(RuntimeException $e) {
            echo $e->getMessage();
        }

        echo PHP_EOL;
    }

    private function getTasksComplete($result)
    {
        return $result->responseData->tasksComplete;
    }
}
