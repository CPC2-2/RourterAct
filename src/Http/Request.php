<?php

namespace Api\Http;


class Request {

    protected $headers=[];
    protected $params=[];
    protected $body=[];
    protected $path;
    protected $method;
    
    function __construct() {
        $this->path=parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $this->method =  $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->headers= $this->getRequestHeaders();
        $this->params = [];
        $this->body = $this->parseRequestBody();
    }    


    private function getRequestHeaders(){
        $headers = [];
        if (function_exists('getallheaders')){
            $headers = getallheaders();
        }
        return $headers;
    }

    private function parseRequestBody():array{
        $body = [];
        $content_type = '';
        if (in_array($this->method,['POST','PUT','PATCH','DELETE'])){

            $content_type = $this->getHeader('Content-Type');

        }
        if (strpos($content_type,'application/json') !== false){
            $content = file_get_contents('php://input');
            $json = json_decode($content,true);
            $json = $json ?? [];
        }elseif(strpos($content_type,'application/x-www-form-urlencoded') !== false){
            $body = $_POST ?? [];
        }
        return $body;
    }

    /**
     * Get the value of body
     */ 
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the value of body
     *
     * @return  self
     */ 
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get the value of params
     */ 
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set the value of params
     *
     * @return  self
     */ 
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    public function getHeader($header,$default= null){

        if (isset($this->headers[$header])){
            return $this->headers($header);
        }

        return $default;

    }

    /**
     * Get the value of header
     */ 
    public function getHeaders():array
    {
        return $this->headers;
    }

    /**
     * Set the value of header
     *
     * @return  self
     */ 
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Get the value of path
     */ 
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set the value of path
     *
     * @return  self
     */ 
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the value of method
     */ 
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the value of method
     *
     * @return  self
     */ 
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }
}