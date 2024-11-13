<?php

return [
    "database" => [
        "host" => "localhost",
        "port" => 3306,
        "user" => "root",
        "password" => "",
        "dbname" => "sample_db",
        "charset" => "utf8mb4"
    ],
    "cors" => [
        "origin" => "*",
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
