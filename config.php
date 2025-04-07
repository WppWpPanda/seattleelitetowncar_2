<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


define('ABS_PATH', dirname(__FILE__) . '/');
require_once 'core/conditional.php';
require_once 'core/vendor/autoload.php';
require_once 'core/Database.php';
require_once 'core/Auth.php';

const SITE_URL = 'http://seattleelitetowncar.coms/';
const VER = '1.3.2';
const STR = 'dxMDdmjOlvx';
const PHP = '.php';
const INDEX = 'index.php';

const MAIL_DRIVER = 'smtp';
const MAIL_HOST = 'smtp.sendgrid.net';
const MAIL_PORT = '587';
const MAIL_USERNAME = 'apikey';

require_once 'core/.keys.php';
const MAIL_ENCRYPTION = 'tls';
const MAIL_FROM_NAME = 'SeattleEliteTownCar';
const MAIL_FROM_ADDRESS = 'no-reply@uppointment.com';
const MAIL_RECIPIENT_ADDRESS = 'panda@wp-panda.pro';


$db = [
    'db' => [
        'default' => [
            'host' => '127.0.0.1',
            'port' => 3306,
            'dbname' => 'wp_panda_seatle',
            'username' => 'wp_panda',
            'password' => '12345',
            'charset' => 'utf8mb4',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        ]
    ]
];
$GLOBALS['wpp_db'] = $db;
$config = [];

// Полная конфигурация всех текстов и ссылок
$config['header'] = [
    'meta' => [
        'description' => 'Welcome to Seattle elite towncar limousine and coach - Professional luxury transportation services with nobility, confidentiality and protocol.',
        'keywords' => 'limousine service, airport transportation, Seattle town car',
        'title' => 'Seattle Elite Town Car | Airport Transportation'
    ],
    'assets' => [
        'styles' => [
            '/assets/fonts/fontawesome/css/all.css',
            '/assets/css/slick.css',
            '/assets/css/bootstrap.min.css',
            '/assets/css/animate.min.css',

        ],
        'logo' => [
            'src' => '/assets/images/logo_n.png',
            'alt' => 'Seattle limo & town car service - Go to homepage'
        ]
    ],
    'navigation' => [
        'main' => [
            'title' => 'Main navigation',
            'toggle_label' => 'Toggle navigation menu'
        ],
        'logo' => [
            'title' => 'Seattle limo & town car service',
            'home_url' => '/' . PHP
        ],
        'phones' => [
            [
                'num' => '4253726570',
                'display' => '425-372-6570',
                'desc' => 'Toll free number',
                'type' => 'customer service',
                'label' => 'Call toll free number'
            ],
            [
                'num' => '2064539128',
                'display' => '206-453-9128',
                'desc' => 'Local office number',
                'type' => 'customer service',
                'label' => 'Call local office number'
            ],
            'section_label' => 'Contact phones'
        ],
        'menu' => [
            'items' => [
                [
                    'title' => 'Home',
                    'url' => '/' . PHP,
                    'current' => false
                ],
                [
                    'title' => 'Quote',
                    'url' => '/quote' . PHP,
                    'current' => false
                ],
                [
                    'title' => 'Reservation',
                    'url' => '/reservation' . PHP,
                    'current' => false
                ],
                [
                    'title' => 'Our fleet',
                    'url' => '/fleet' . PHP,
                    'current' => false,
                    'dropdown' => [
                        [
                            'title' => 'Luxury Sedans',
                            'url' => '/fleet/sedans' . PHP
                        ],
                        [
                            'title' => 'Luxury SUVs',
                            'url' => '/fleet/suvs' . PHP
                        ],
                        [
                            'title' => 'Luxury Van',
                            'url' => '/fleet/vans' . PHP
                        ],
                        [
                            'title' => 'Luxury Limousines',
                            'url' => '/fleet/limos' . PHP
                        ],
                        [
                            'title' => 'Luxury Buses',
                            'url' => '/fleet/buses' . PHP
                        ]
                    ]
                ],
                [
                    'title' => 'Services',
                    'url' => '/services' . PHP,
                    'current' => false
                ],
                [
                    'title' => 'Rates',
                    'url' => '/rates' . PHP,
                    'current' => false
                ],
                [
                    'title' => 'FAQ',
                    'url' => '/faq' . PHP,
                    'current' => false
                ],
                [
                    'title' => 'Reviews',
                    'url' => '/reviews' . PHP,
                    'current' => false
                ],
                [
                    'title' => 'Contact us',
                    'url' => '/contact' . PHP,
                    'current' => true
                ],
                'login' => [
                    'url' => '/login' . PHP,
                    'title' => 'Sign In',
                    'current' => false
                ],
                'register' => [
                    'url' => '/reg' . PHP,
                    'title' => 'Registration',
                    'current' => false
                ],
            ],
            'section_label' => 'Main menu'
        ]
    ],
    'scripts' => [
        'tracking' => [
            'enabled' => true,
            'id' => '151003884',
            'src' => '//bat.bing.com/bat.js',
            'var' => 'uetq'
        ],
        'main' => [
            '/assets/js/libs/jquery.min.js',
            '/assets/js/libs/bootstrap.min.js',
            '/assets/js/libs/jquery.viewportchecker.min.js',
            '/assets/js/libs/slick.min.js',
            '/assets/js/main.js',
            '/assets/js/slider.js',
            '/assets/js/bg.js'
        ]
    ]

];
$auth = new Auth();

if (  $auth->isLoggedIn()) {
    $config['header'][ 'navigation' ]['menu']['items']['login'] = [
        'url' => '/profile' . PHP,
        'title' => 'My Account',
        'current' => false
    ];
   unset( $config['header'][ 'navigation' ]['menu']['items']['register']);
}



if (is_quote_page() || is_reserv_page() ) :
    $config['header']['assets']['styles'][] = 'assets/css/jquery.periodpicker.css';
    $config['header']['assets']['styles'][] = 'assets/css/jquery.timepicker.css';
    $config['header']['assets']['styles'][] = 'assets/js/sweetalert/sweetalert2.min.css';
endif;

$config['header']['assets']['styles'][] = '/assets/css/style.css?' . VER;

// config/footer_config.php

$config['footer'] = [
    'navItems' => [
        [
            'title' => 'Our Vehicles',
            'href' => 'fleet/buses' . PHP,
            'icon' => 'assets/images/icons/info-01.png',
            'alt' => 'Vehicle icon'
        ],
        [
            'title' => 'Our Services',
            'href' => 'services' . PHP,
            'icon' => 'assets/images/icons/info-02.png',
            'alt' => 'Services icon'
        ],
        [
            'title' => 'Our Rates',
            'href' => 'rates' . PHP,
            'icon' => 'assets/images/icons/info-03.png',
            'alt' => 'Rates icon'
        ],
        [
            'title' => 'Fast Reservation',
            'href' => 'reservation' . PHP,
            'icon' => 'assets/images/icons/info-04.png',
            'alt' => 'Reservation icon'
        ]
    ],

    'addressBlock' => [
        'title' => 'Address',
        'content' => '<strong>Limousine Service</strong><br>
                      <span aria-hidden="true"><img src="assets/images/pin-icon.png" alt=""></span>
                      <span class="sr-only">Address: </span>16220 NE 12TH CT,<br> BELLEVUE WA 98008'
    ],

    'contactsBlock' => [
        'title' => 'Contact Us',
        'content' => '<strong>Reservations</strong><br>
                      <span aria-hidden="true"><img src="assets/images/phone-icon.png" alt=""></span>
                      <span class="sr-only">Phone: </span><a href="tel:4253726570">425-372-6570</a><br>
                      <span aria-hidden="true"><img src="assets/images/phone-icon.png" alt=""></span>
                      <a href="tel:206-453-9128">206-453-9128</a><br>
                      <span aria-hidden="true"><img src="assets/images/mail-icon.png" alt=""></span>
                      <span class="sr-only">Email: </span><a href="mailto:INFO@SEATTLEELITETOWNCAR.COM">INFO@SEATTLEELITETOWNCAR.COM</a>'
    ],

    'socialLinks' => [
        [
            'href' => 'https://www.facebook.com/elitetowncar/',
            'class' => 'fab fa-facebook-f',
            'label' => 'Facebook'
        ]
    ],

    'yelpBadge' => [
        'id' => 'yelp-biz-badge-plain-i8xK490z_vPddqxtXhx5vQ',
        'link' => 'http://yelp.com/biz/seattle-elite-town-car-bellevue-5?utm_medium=badge_button&amp;utm_source=biz_review_badge',
        'text' => 'Check out Seattle Elite Town Car on Yelp'
    ],

    'quoteButton' => [
        'href' => 'quote' . PHP,
        'text' => 'Get a quote',
        'class' => 'btn btn-yellow'
    ],

    'copyright' => [
        'text' => '&copy; ' . date('Y') . ' Limousine services. All rights reserved.<br>Powered by webandad',
        'link' => 'https://webandad.com/'
    ],

    'scripts' => [
        '/assets/js/libs/jquery.min.js',
        '/assets/js/libs/bootstrap.min.js',
        '/assets/js/libs/jquery.viewportchecker.min.js',
        '/assets/js/libs/slick.min.js?' . VER,
        '/assets/js/main.js?' . VER
    ],

    'yelpScript' => [
        'id' => 'yelp-biz-badge-script-plain-i8xK490z_vPddqxtXhx5vQ',
        'src' => '//yelp.com/biz_badge_js/en_US/plain/i8xK490z_vPddqxtXhx5vQ.js'
    ]
];

if (is_home_page()) {
    $config['footer']['scripts'][] = '/assets/js/bg.js';
}

if (!is_ratese_page()) {
    $config['footer']['scripts'][] = '/assets/js/slider.js?' . VER;
}

if (is_quote_page() || is_reserv_page() ) {
    $config['footer']['scripts'][] = '/assets/js/jquery.validate.min.js';
    $config['footer']['scripts'][] = '/assets/js/jquery.periodpicker.full.min.js';
    $config['footer']['scripts'][] = '/assets/js/jquery.datetimepicker.js';
}

$config['footer']['scripts'][] = '/assets/js/sweetalert/sweetalert2.min.js';


$GLOBALS['wpp_config'] = $config;