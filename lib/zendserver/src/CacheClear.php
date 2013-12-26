<?php
require_once 'WebApiTask.php';

/**
 * Cache clear phing task.
 *
 */
class CacheClear extends WebApiTask
{
    /**
     * @var string
     */
    protected $component = null;

    public function setComponent($component)
    {
        $this->component = $component;
    }

    public function getComponent()
    {
        return $this->component;
    }

    public function main()
    {
        try {
            $this->setParams(array('component' => $this->getComponent()));
            $this->executeApiTask('cacheClear');
            echo $this->getComponent() .' cache cleared';
        } catch(RuntimeException $e) {
            echo $e->getMessage();
        }

        echo PHP_EOL;
    }
}
