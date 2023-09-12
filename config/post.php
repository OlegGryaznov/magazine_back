<?php

return [
    'new_post' => [
        'api_key' => env('NEW_POST_API_KEY', '2fd4131a6cb0c8910fb3c590de2c09f7'),
        'base_url' => 'https://api.novaposhta.ua/v2.0/json',
        'retry' => [
            'attempts' => env('NEW_POST_RETRY_ATTEMPTS', 3),
            'delay' => env('NEW_POST_RETRY_DELAY', 100)
        ],
        'limit' => env('NEW_POST_LIMIT', 50),
    ],
];
