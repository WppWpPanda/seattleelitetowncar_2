<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed'));
$fleetConfig = [
    'section' => [
        'id' => 'limos',
        'class' => 'fleet-section',
        'title' => 'Our Fleet',
        'reservation_btn' => [
            'text' => 'Reservation',
            'url' => 'reservation' . PHP,
            'aria_label' => 'Make a reservation'
        ]
    ],
    'category' => [
        'title' => 'Luxury Sedans'
    ],
    'vehicles' => [
        [
            'type' => 'sedan',
            'model' => 'Chrysler 300c',
            'main_img' => '/uploads/fleets/kandinsky-download-1724423545133-qt1btnahp3xnxk54hb9dehf3g2hvza6xi44cut9u7g.png',
            'main_alt' => 'Black Chrysler 300c luxury sedan',
            'inner_img' => '/uploads/fleets/limo-4in-qfk0htuaqnr60jjusddsv63t9kx8y9i4asuh2kw99u.png',
            'inner_alt' => 'Chrysler 300c leather interior',
            'capacity' => 'Up to 3 people',
            'luggage' => '4 medium size suitcases',
            'quote_aria' => 'Get quote for Chrysler 300c sedan',
            'reserve_aria' => 'Reserve Chrysler 300c sedan'
        ]
    ],
    'icons' => [
        'capacity' => '/theme/images/icons/upto.png',
        'luggage' => '/theme/images/icons/case.png'
    ]
];
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/fleet.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';