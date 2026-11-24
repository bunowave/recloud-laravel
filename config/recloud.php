<?php

return [
    'url'       => env('RECLOUD_URL', 'https://recloud-turnstile.bunowave.shop'),
    'site_key'  => env('RECLOUD_SITE_KEY'),
    'secret'    => env('RECLOUD_SECRET'),
    'timeout'   => 10,
    'fail_open' => false,
    'send_ip'   => (bool) env('RECLOUD_SEND_IP', false),
];
