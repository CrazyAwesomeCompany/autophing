<?php
require_once 'phing/Task.php';

abstract class WebApiTask extends Task
{
    const HTTP_METHOD_GET = 'GET';
    const HTTP_METHOD_POST = 'POST';

    /**
     * HTTP method
     *
     * @var string
     */
    private $method = self::HTTP_METHOD_POST;

    /**
     * Request parameter storage
     *
     * @var array
     */
    protected $params = array();

    /**
     * @param string $method
     */
    private function setMethod($method)
    {
        if (!in_array($method, array(self::HTTP_METHOD_GET, self::HTTP_METHOD_POST))) {
            throw new \UnexpectedValueException('Method not allowed');
        }
        $this->method = $method;
    }

    /**
     * @return string
     */
    private function getMethod()
    {
        return $this->method;
    }

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
    protected function executeApiTask($task, $method = self::HTTP_METHOD_POST)
    {
        $tstamp = time();
        $this->setMethod($method);
        $version = $this->getProject()->getProperty('zendserver.config.version');
        $host = $this->getProject()->getProperty('zendserver.config.host');
        $path = '/ZendServer/Api/'.$task;
        $body = http_build_query($this->getParams());

        $signature = $this->generateRequestSignature($host, $path, $tstamp);

        $opts = array(
            'http' => array(
                'method' => $this->getMethod(),
                'header' =>
                    "User-Agent: ". $this->getProject()->getProperty('zendserver.config.userAgent'). "\r\n".
                    "X-Zend-Signature: $signature\r\n".
                    "Accept: application/vnd.zend.serverapi+json;version=$version\r\n".
                    "Date: ". gmdate('D, d M Y H:i:s ', $tstamp) . "GMT\r\n",
            ),
        );

        if (self::HTTP_METHOD_POST === $this->getMethod()) {
            $opts['http']['header'] .= "Content-Type: application/x-www-form-urlencoded\r\n".
                "Content-Length: ".strlen($body)."\r\n";
            $opts['http']['content'] = $body;
        } else {
            $path .= '?'.$body;
        }

        $context = stream_context_create($opts);

        $result = @file_get_contents('http://'.$host.$path, false, $context);
        if (!$result) {
            throw new \RuntimeException('Problem communicating with Zend Server instance');
        }
        return json_decode($result);
    }

    /**
     * Calculate Zend Server Web API request signature
     *
     * @param string $host Exact value of the 'Host:' HTTP header
     * @param string $path Request URI
     * @param integer $timestamp Timestamp used for the 'Date:' HTTP header
     * @return string Calculated request signature
     */
    private function generateRequestSignature($host, $path, $timestamp)
    {
        $data = $host . ":" .
            $path . ":" .
            $this->getProject()->getProperty('zendserver.config.userAgent') . ":" .
            gmdate('D, d M Y H:i:s ', $timestamp) . 'GMT';

        return $this->getProject()->getProperty('zendserver.config.user').'; '
            . hash_hmac('sha256', $data, $this->getProject()->getProperty('zendserver.config.apiKey'));
    }

}
