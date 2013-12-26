<?php
require_once 'WebApiTask.php';

/**
 * Restart Server phing task.
 *
 */
class RestartPhp extends WebApiTask
{
    public function main()
    {
        try {
            $this->executeApiTask('restartPhp');
            echo 'Server restarted';
        } catch(RuntimeException $e) {
            echo $e->getMessage();
        }

        echo PHP_EOL;
    }
}
