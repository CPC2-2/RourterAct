<?php

    use Api\Controllers\UserController;
    
    return [
        [
            "method" => "GET",
            "path" => "/api/users",
            "handler" => [UserController::class, "index"]
        ],
        [
            "method" => "POST",
            "path" => "/api/users",
            "handler" => [UserController::class, "create"]
        ],
        [
            "method" => "GET",
            "path" => "/api/users/{id}",
            "handler" => [UserController::class, "show"]
        ],
];