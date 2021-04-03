<?php

return [
    
    'database' => [
        
        'name' => 'chessable',
        
        'username' => 'root',
        
        'password' => 'root',
        
        'connection' => 'mysql:Applications/MAMP_2021-02-22_10-35-47/Library/bin/mysql:host=127.0.0.1',
        
        'options' => [
            
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            
        ]
        
    ]
    
];

