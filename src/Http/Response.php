<?php

namespace Api\Http;

class Response {

    protected $headers = [];
    protected $statusCode = 200;

    function __construct(){
        $this->headers[] = 'Content-Type:application/json';
    }

    function json(array $data){
        foreach($this->headers as $header){
            header($header);
        }
        echo json_encode($data,true);
    }

    //to convert to html
    function html(array $data) {
        foreach ($this->headers as $header) {
            header($header);
        }
        /*
        header('Content-Type: application/html');
        echo json_encode($data, JSON_PRETTY_PRINT);
        */
    }
    
    //to conver to ajax
    function ajax(){
        
    }

}