<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed'));
$fleetConfig = [
    'section' => [
        'id' => 'suvs',
        'class' => 'fleet-section',
        'title' => 'Our Fleet',
        'reservation_btn' => [
            'text' => 'Reservation',
            'url' => '/reservation' . PHP,
            'aria_label' => 'Make a reservation'
        ]
    ],
    'category' => [
        'title' => 'Luxury Suvs'
    ],
    'vehicles' => [
        [
            'type' => 'suv',
            'model' => 'Cadillac Escalade 2024',
            'main_img' => '/uploads/fleets/photo_2024-08-23_14-20-29-e1724681871707-qt6j5ucrsq8brttk411723xuhb7n2b6mesb7prl3xo.jpg',
            'main_alt' => 'Cadillac Escalade 2024',
            'inner_img' => '/uploads/fleets/sport-1in-1-qt6j7hkh79tu8nzqiljhojiiwn7q1fnwh9x5ojx0c2.png',
            'inner_alt' => 'Cadillac Escalade 2024 interior',
            'capacity' => 'Up to 6 people',
            'luggage' => '8 medium size suitcases',
            'quote_aria' => 'Get price quote for Cadillac Escalade 2024',
            'reserve_aria' => 'Reserve Cadillac Escalade 2024 now'
        ],
        [
            'type' => 'suv',
            'model' => 'Chevrolet Suburban 2024',
            'main_img' => '/uploads/fleets/photo_2024-08-26_17-08-31-qt6j163ntdu01mlyeiaz5sec5c8xshmo3njat8ikvg.jpg',
            'main_alt' => 'Chevrolet Suburban 2024',
            'inner_img' => '/uploads/fleets/sport-2in-qfk0rvq5tvik6ey737t614s9yxdk9qes0k0eu3zoqa.png',
            'inner_alt' => 'Chevrolet Suburban 2024 interior',
            'capacity' => 'Up to 6 people',
            'luggage' => '8 medium size suitcases',
            'quote_aria' => 'Get price quote for Chevrolet Suburban 2024',
            'reserve_aria' => 'Reserve Chevrolet Suburban 2024 now'
        ],
        [
            'type' => 'truck',
            'model' => 'Tesla Cybertruck',
            'main_img' => '/uploads/fleets/0-1715947929-avto11-post-material-qt1aigs4nhcj66oazf2iqw160t1mm7vyol9ynt88j0.jpg',
            'main_alt' => 'Tesla Cybertruck 2024',
            'inner_img' => '/uploads/fleets/tesla-cybertruck-qt1aky2o4q37yjmsickvl40lggxgfnonj7rfzgbjea.jpg',
            'inner_alt' => 'Tesla Cybertruck 2024 interior',
            'capacity' => 'Up to 4 people',
            'luggage' => '10 medium size suitcases',
            'quote_aria' => 'Get price quote for Tesla Cybertruck',
            'reserve_aria' => 'Reserve Tesla Cybertruck now'
        ]
    ],
    'icons' => [
        'capacity' => '/theme/images/icons/upto.png',
        'luggage' => '/theme/images/icons/case.png'
    ]
];

 require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/fleet.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';