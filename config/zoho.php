<?php

return [
    'auth' => [
        'client_id'     => env('ZOHO_CLIENT_ID'),
        'client_secret' => env('ZOHO_CLIENT_SECRET'),
        'refresh_token' => env('ZOHO_REFRESH_TOKEN'),
        'accounts_url'  => env('ZOHO_ACCOUNTS_URL', 'https://accounts.zohocloud.ca'),
    ],

    'people' => [
        'base_url'     => env('ZOHO_PEOPLE_BASE_URL', 'https://people.zohocloud.ca'),
        'records_path' => env('ZOHO_PEOPLE_RECORDS_PATH', '/people/api/forms/employee/getRecords'),

        // optional tuning
        'page_size'    => env('ZOHO_PEOPLE_PAGE_SIZE', 200),
        'max_pages'    => env('ZOHO_PEOPLE_MAX_PAGES', 50),
    ],
];
