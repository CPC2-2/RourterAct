<?php

namespace Api\Controllers;

use Api\Http\Request;
use Api\Http\Response;


class UserController{

    protected Request $request;
    protected Response $response;

    protected array $users=[];

    function __construct(Request $request) {

        $this->request = $request;

        $this->users = [
            [
                'id' => '0',
                'name' => 'Paco',
                'email' => 'paco@gmail.com'
            ],
            [
                'id' => '1',
                'name' => 'Hugo',
                'email' => 'hugo@gmail.com'
            ]
        ];
    }

    function index(){

        $response = new Response();
        $response->json($this->users);

    }

    function create(Request $request){
        
        
    }

    function show($id){
        if(!$this->users[$id]){
            throw new \Exception("User $id not found");
        }
        $this->response= new Response();
        $this->response->json($this->users[$id]);
    }
}