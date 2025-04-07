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
        'title' => 'Luxury Buses'
    ],
    'vehicles' => [
        [
            'type' => 'luxury_bus',
            'model' => '55 PASSENGER LUXURY COACH BUS',
            'main_img' => '/uploads/fleets/bus-2-qfk15gid3qr7q8o0sq6dacxbv8cgy5d0deqjnn39kc.png',
            'main_alt' => '55 Passenger Luxury Coach Bus exterior',
            'inner_img' => '/uploads/fleets/bus-2in-qfk158zj11tdarj50zu5hrca47hhqrhciq10js648i.png',
            'inner_alt' => '55 Passenger Luxury Coach Bus interior',
            'capacity' => 'Up to 55 people',
            'luggage' => '55 medium size suitcases',
            'quote_aria' => 'Get price quote for 55 Passenger Luxury Coach Bus',
            'reserve_aria' => 'Reserve 55 Passenger Luxury Coach Bus now'
        ],
        [
            'type' => 'executive_bus',
            'model' => '30-36 PASSENGER EXECUTIVE MID-SIZE COACH BUS',
            'main_img' => '/uploads/fleets/bus-6-qfk18n6o9j472o1g73quqjzkc8n91809h6bs7ed8h8.png',
            'main_alt' => '30-36 Passenger Executive Mid-Size Coach Bus exterior',
            'inner_img' => '/uploads/fleets/bus-6in-qfk18vn3f0s84k9cu2bamcdcorligow1copi98se7m.png',
            'inner_alt' => '30-36 Passenger Executive Mid-Size Coach Bus interior',
            'capacity' => 'Up to 30-36 people',
            'luggage' => '30 medium size suitcases',
            'quote_aria' => 'Get price quote for 30-36 Passenger Executive Mid-Size Coach Bus',
            'reserve_aria' => 'Reserve 30-36 Passenger Executive Mid-Size Coach Bus now'
        ],
        [
            'type' => 'mini_coach',
            'model' => '24 PASSENGER EXECUTIVE MINI COACH BUS',
            'main_img' => '/uploads/fleets/bus-3-qfk16i3wp46omn5ep6fg23frmn75i1i9uktyupjing.png',
            'main_alt' => '24 Passenger Executive Mini Coach Bus exterior',
            'inner_img' => '/uploads/fleets/bus-3in-qfk16tduf3yknd97vo7rnd3xrbriklp8qh65cduhv6.png',
            'inner_alt' => '24 Passenger Executive Mini Coach Bus interior',
            'capacity' => 'Up to 24 people',
            'luggage' => '24 medium size suitcases',
            'quote_aria' => 'Get price quote for 24 Passenger Executive Mini Coach Bus',
            'reserve_aria' => 'Reserve 24 Passenger Executive Mini Coach Bus now'
        ]
    ],
    'icons' => [
        'capacity' => '/assets/images/icons/upto.png',
        'luggage' => '/assets/images/icons/case.png'
    ]
];
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/fleet.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';