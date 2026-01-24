<?php

return [
    'index' => [
        'per_page_default' => (int) env('API_INDEX_PER_PAGE_DEFAULT', 15),
        'per_page_max' => (int) env('API_INDEX_PER_PAGE_MAX', 100),
    ],
];
