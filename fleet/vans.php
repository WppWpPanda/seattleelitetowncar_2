<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed'));
$fleetConfig = [
    'section' => [
        'id' => 'limos',
        'class' => 'fleet-section',
        'title' => 'Our Fleet',
        'reservation_btn' => [
            'text' => 'Reservation',
            'url' => '/reservation' . PHP,
            'aria_label' => 'Make a reservation'
        ]
    ],
    'category' => [
        'title' => 'Luxury Vans'
    ],
    'vehicles' => [
        [
            'type' => 'van',
            'model' => 'Sprinter VAN 10 & 14 passengers',
            'main_img' => '/uploads/fleets/kandinsky-download-1724425009453-qt1d3t55c74m4536x9lruu21payu05gd6litc0tsmk.png',
            'main_alt' => 'Sprinter VAN exterior',
            'inner_img' => '/uploads/fleets/photo_2024-08-23_14-18-50-qt1d217zvg1kc288auvxwmpcb5ttyxct45o5fk89o2.jpg',
            'inner_alt' => 'Sprinter VAN interior',
            'capacity' => '10 & 14 Passengers',
            'luggage' => '20+ medium size suitcases',
            'quote_aria' => 'Get price quote for Sprinter VAN',
            'reserve_aria' => 'Reserve Sprinter VAN now'
        ]
    ],
    'icons' => [
        'capacity' => '/assets/images/icons/upto.png',
        'luggage' => '/assets/images/icons/case.png'
    ]
];
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/fleet.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';