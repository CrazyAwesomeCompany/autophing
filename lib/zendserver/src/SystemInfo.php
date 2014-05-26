<?php
require_once 'WebApiTask.php';

/**
 * Server system info phing task.
 *
 */
class SystemInfo extends WebApiTask
{
    public function main()
    {
        try {
            $result = $this->executeApiTask('getSystemInfo', self::HTTP_METHOD_GET);
            $this->getProject()->setProperty('zendserver.config.version', $this->getMaxVersion($result));
        } catch(RuntimeException $e) {
            echo $e->getMessage();
        }

        echo PHP_EOL;
    }

    private function getMaxVersion($result)
    {
        $versions = $result->responseData->systemInfo->supportedApiVersions;
        $maxVersion = array_pop($versions);
        preg_match_all('!\d+\.*\d*!', $maxVersion, $match);
        return floatval($match[0][0]);
    }
}
