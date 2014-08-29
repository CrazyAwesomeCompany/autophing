<?php

require_once "phing/Task.php";

/**
 * Base Webistrano Class
 *
 */
abstract class Webistrano extends Task
{
    /**
     * The Webistrano Host (e.g. http://webistrano.company.com)
     *
     * @var string
     */
    private $host;

    /**
     * The Webistrano Username
     *
     * @var string
     */
    private $username;

    /**
     * The Webistrano Password
     *
     * @var string
     */
    private $password;


    /**
     * Perform a cURL request against Webistrano
     *
     * @param string $path
     * @param array  $params
     * @param string $method
     *
     * @return SimpleXMLElement
     */
    protected function request($path, $params = array(), $method = 'GET')
    {
        $this->validate();

        $url = sprintf("%s/%s", $this->host, ltrim($path, '/'));

        $c = curl_init();
        curl_setopt_array(
            $c,
            array(
                CURLOPT_URL => $url,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
                CURLOPT_USERPWD => sprintf("%s:%s", $this->username, $this->password)
            )
        );

        if ('POST' === $method) {
            curl_setopt($c, CURLOPT_POST, 1);
            if ($params) {
                curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($params));
            }
        }

        $this->log(
            sprintf(
                'Webistrano request [%s: %s] - %s',
                $method,
                $url,
                http_build_query($params)
            )
        );

        $r = curl_exec($c);
        curl_close($c);

        $r = trim($r);

        //enable error reporting
        libxml_use_internal_errors(true);
        //parse the xml response string
        return simplexml_load_string($r);
    }

    /**
     * Validate input
     *
     * @throws BuildException
     */
    protected function validate()
    {
        if (!$this->host) {
            throw new BuildException('Webistrano `host` is required');
        }

        if (!$this->username) {
            throw new BuildException('Webistrano `username` is required');
        }

        if (!$this->password) {
            throw new BuildException('Webistrano `password` is required');
        }
    }

    /**
     * Set host
     *
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = rtrim($host, '/');
    }

    /**
     * Set the username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Set the password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
