<?php
require_once 'WebApiTask.php';

/**
 * Restart Server phing task.
 *
 */
class TasksComplete extends WebApiTask
{
    private $tasksComplete = false;

    private $waitUnit = 1;

    private $maxWait = 30;

    public function setWaitUnit($waitUnit)
    {
        $this->waitUnit = intval($waitUnit);
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
