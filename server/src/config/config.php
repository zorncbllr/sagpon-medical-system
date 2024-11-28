<?php

return [
    "database" => [
        "host" => $_ENV['DB_HOST'],
        "port" => $_ENV['DB_PORT'],
        "user" => $_ENV['DB_USER'],
        "password" => $_ENV['DB_PASSWORD'],
        "dbname" => $_ENV['DB_NAME'],
        "charset" => "utf8mb4"
    ],
    "cors" => [
        "origin" => "http://localhost:5173",
        "allowed_methods" => [
            "GET",
            "POST",
            "PATCH",
            "DELETE",
            "OPTIONS"
        ],
        "allowed_headers" => [
            "Content-Type",
            "Authorization"
        ]
    ]
];
