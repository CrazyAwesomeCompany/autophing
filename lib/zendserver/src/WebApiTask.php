<?php
require_once 'phing/Task.php';

abstract class WebApiTask extends Task
{
    /**
     * Request parameter storage
     *
     * @var array
     */
    protected $params = array();

    /**
     * Set all the params for the body or query string
     *
     * @param array $params
     */
    protected function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @return array
     */
    protected function getParams()
    {
        return $this->params;
    }

    /**
     * This method does the physical HTTP API execution
     *
     * @param $task
     * @throws RuntimeException
     */
    protected function executeApiTask($task)
    {
        $tstamp = time();
        $version = $this->getProject()->getProperty('zendserver.config.version');
        $host = $this->getProject()->getProperty('zendserver.config.host');
        $path = '/ZendServer/Api/'.$task;
        $body = http_build_query($this->getParams());

        $signature = $this->generateRequestSignature($host, $path, $tstamp);

        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' =>
                    "User-Agent: ". $this->getProject()->getProperty('zendserver.config.userAgent'). "\r\n".
                    "X-Zend-Signature: $signature\r\n".
                    "Accept: application/vnd.zend.serverapi+xml;version=$version\r\n".
                    "Date: ". gmdate('D, d M Y H:i:s ', $tstamp) . "GMT\r\n".
                    "Content-Type: application/x-www-form-urlencoded\r\n".
                    "Content-Length: ".strlen($body)."\r\n",
                'content' => $body,
            ),
        );

        $context = stream_context_create($opts);

        $result = @file_get_contents('http://'.$host.$path, false, $context);
        if (!$result) {
            throw new RuntimeException('Problem communicating with Zend Server instance');
        }
    }

    /**
     * Calculate Zend Server Web API request signature
     *
     * @param string $host Exact value of the 'Host:' HTTP header
     * @param string $path Request URI
     * @param integer $timestamp Timestamp used for the 'Date:' HTTP header
     * @return string Calculated request signature
     */
    protected function generateRequestSignature($host, $path, $timestamp)
    {
        $data = $host . ":" .
            $path . ":" .
            $this->getProject()->getProperty('zendserver.config.userAgent') . ":" .
            gmdate('D, d M Y H:i:s ', $timestamp) . 'GMT';

        return $this->getProject()->getProperty('zendserver.config.user').'; '
            . hash_hmac('sha256', $data, $this->getProject()->getProperty('zendserver.config.apiKey'));
    }

}
