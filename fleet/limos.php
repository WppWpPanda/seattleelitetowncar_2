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
        'title' => 'Luxury Limousines'
    ],
    'vehicles' => [
        [
            'type' => 'limousine',
            'model' => '10 PASSENGER CHRYSLER 300',
            'main_img' => '/uploads/fleets/limo-1-qfk0xirfe3w1os735ans8d17a3gvy5uly4exriuy3w.png',
            'main_alt' => '10 Passenger Chrysler 300 limousine exterior',
            'inner_img' => '/uploads/fleets/limo-1in-qfk0xs5oqfld2admmrmuon6g80ailbu45rg5an8po2.png',
            'inner_alt' => '10 Passenger Chrysler 300 limousine interior',
            'capacity' => 'Up to 10 people',
            'luggage' => '3 medium size suitcases',
            'quote_aria' => 'Get price quote for 10 Passenger Chrysler 300 limousine',
            'reserve_aria' => 'Reserve 10 Passenger Chrysler 300 limousine now'
        ],
        [
            'type' => 'limousine',
            'model' => '20 PASSENGER HUMMER',
            'main_img' => '/uploads/fleets/limo-3-qfk0yvn19hqygi837vsdu0p664rz2f8nguc6pwuh4c.png',
            'main_alt' => '20 Passenger Hummer limousine exterior',
            'inner_img' => '/uploads/fleets/limo-3in-qfk0zck04hqkew3phg0gu8y3v4kjf620dila38x3aq.png',
            'inner_alt' => '20 Passenger Hummer limousine interior',
            'capacity' => 'Up to 20 people',
            'luggage' => 'Not specified',
            'quote_aria' => 'Get price quote for 20 Passenger Hummer limousine',
            'reserve_aria' => 'Reserve 20 Passenger Hummer limousine now'
        ]
    ],
    'icons' => [
        'capacity' => '/theme/images/icons/upto.png',
        'luggage' => '/theme/images/icons/case.png'
    ]
];
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/fleet.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';