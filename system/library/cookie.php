<?php
class Cookie
{
    private $path;
    private $domain;
    private $secure;
    private $httponly;

    public function __construct($path = "", $domain = "", $secure = false, $httponly = false)
    {
        $this->path = $path;
        $this->domain = $domain;
        $this->secure = $secure;
        $this->httponly = $httponly;
    }

    public function get($key) {
        if (isset($_COOKIE[$key])){
            return $_COOKIE[$key];
        }

        return false;
    }

    public function set($key, $value, $time = 3600) {
        setcookie($key, $value, time()+$time, '/'.$this->path, $this->domain, $this->secure, $this->httponly);
    }

    public function delete($key){
        setcookie($key, '', time() - 42000, '/'.$this->path, $this->domain);
    }
}