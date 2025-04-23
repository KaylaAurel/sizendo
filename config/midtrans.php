<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY'), // Jangan ada nilai default di sini
    'client_key' => env('MIDTRANS_CLIENT_KEY'), // Jangan ada nilai default di sini
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
];
