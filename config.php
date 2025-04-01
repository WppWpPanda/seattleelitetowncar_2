<?php
define('ABS_PATH', dirname(__FILE__) . '/');
require_once 'core/conditional.php';
const SITE_URL = 'http://seattleelitetowncar.coms/';
const PHP = '.php';
const INDEX = 'index.php';


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
            'theme/fonts/fontawesome/css/all.css',
            'theme/css/slick.css',
            'theme/css/bootstrap.min.css',
            'theme/css/animate.min.css',
            'theme/css/style.css'
        ],
        'logo' => [
            'src' => 'theme/images/logo_n.png',
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
            'home_url' => 'index' . PHP
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
                    'url' => 'index' . PHP,
                    'current' => false
                ],
                [
                    'title' => 'Quote',
                    'url' => 'quote.php.html',
                    'current' => false
                ],
                [
                    'title' => 'Reservation',
                    'url' => 'reservation.php.html',
                    'current' => false
                ],
                [
                    'title' => 'Our fleet',
                    'url' => 'fleet.php.html',
                    'current' => false,
                    'dropdown' => [
                        [
                            'title' => 'Luxury Sedans',
                            'url' => 'fleet-sedans.php.html'
                        ],
                        [
                            'title' => 'Luxury SUVs',
                            'url' => 'fleet-suvs.php.html'
                        ],
                        [
                            'title' => 'Luxury Van',
                            'url' => 'fleet-vans.php.html'
                        ],
                        [
                            'title' => 'Luxury Limousines',
                            'url' => 'fleet-limos.php.html'
                        ],
                        [
                            'title' => 'Luxury Buses',
                            'url' => 'fleet-buses.php.html'
                        ]
                    ]
                ],
                [
                    'title' => 'Services',
                    'url' => 'services' . PHP,
                    'current' => false
                ],
                [
                    'title' => 'Rates',
                    'url' => 'rates.php.html',
                    'current' => false
                ],
                [
                    'title' => 'FAQ',
                    'url' => 'faq.php.html',
                    'current' => false
                ],
                [
                    'title' => 'Reviews',
                    'url' => 'reviews.php.html',
                    'current' => false
                ],
                [
                    'title' => 'Contact us',
                    'url' => 'contact.php.html',
                    'current' => true
                ]
            ],
            'section_label' => 'Main menu'
        ],
        'user' => [
            'login' => [
                'url' => 'login.html',
                'text' => 'Sign In'
            ],
            'register' => [
                'url' => 'reg.php.html',
                'text' => 'Registration'
            ],
            'section_label' => 'User login'
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
            'theme/js/libs/jquery.min.js',
            'theme/js/libs/bootstrap.min.js',
            'theme/js/libs/jquery.viewportchecker.min.js',
            'theme/js/libs/slick.min.js',
            'theme/js/main.js',
            'theme/js/slider.js',
            'theme/js/bg.js'
        ]
    ]
];


// config/footer_config.php

$config['footer'] = [
    'navItems' => [
        [
            'title' => 'Our Vehicles',
            'href' => 'fleet-buses.php.html',
            'icon' => 'theme/images/icons/info-01.png',
            'alt' => 'Vehicle icon'
        ],
        [
            'title' => 'Our Services',
            'href' => 'services' . PHP,
            'icon' => 'theme/images/icons/info-02.png',
            'alt' => 'Services icon'
        ],
        [
            'title' => 'Our Rates',
            'href' => 'rates.php.html',
            'icon' => 'theme/images/icons/info-03.png',
            'alt' => 'Rates icon'
        ],
        [
            'title' => 'Fast Reservation',
            'href' => 'reservation.php.html',
            'icon' => 'theme/images/icons/info-04.png',
            'alt' => 'Reservation icon'
        ]
    ],

    'addressBlock' => [
        'title' => 'Address',
        'content' => '<strong>Limousine Service</strong><br>
                      <span aria-hidden="true"><img src="theme/images/pin-icon.png" alt=""></span>
                      <span class="sr-only">Address: </span>16220 NE 12TH CT,<br> BELLEVUE WA 98008'
    ],

    'contactsBlock' => [
        'title' => 'Contact Us',
        'content' => '<strong>Reservations</strong><br>
                      <span aria-hidden="true"><img src="theme/images/phone-icon.png" alt=""></span>
                      <span class="sr-only">Phone: </span><a href="tel:4253726570">425-372-6570</a><br>
                      <span aria-hidden="true"><img src="theme/images/phone-icon.png" alt=""></span>
                      <a href="tel:206-453-9128">206-453-9128</a><br>
                      <span aria-hidden="true"><img src="theme/images/mail-icon.png" alt=""></span>
                      <span class="sr-only">Email: </span><a href="mailto:INFO@SEATTLEELITETOWNCAR.COM">INFO@SEATTLEELITETOWNCAR.COM</a>'
    ],

    'socialLinks' => [
        [
            'href' => 'https://www.facebook.com/elitetowncar/',
            'class' => 'fa fa-facebook',
            'label' => 'Facebook'
        ],
        [
            'href' => 'https://plus.google.com/+Seattleelitetowncar',
            'class' => 'fa fa-google-plus',
            'label' => 'Google+'
        ]
    ],

    'yelpBadge' => [
        'id' => 'yelp-biz-badge-plain-i8xK490z_vPddqxtXhx5vQ',
        'link' => 'http://yelp.com/biz/seattle-elite-town-car-bellevue-5?utm_medium=badge_button&amp;utm_source=biz_review_badge',
        'text' => 'Check out Seattle Elite Town Car on Yelp'
    ],

    'quoteButton' => [
        'href' => 'quote.php.html',
        'text' => 'Get a quote',
        'class' => 'btn btn-yellow'
    ],

    'copyright' => [
        'text' => '&copy; ' . date('Y') . ' Limousine services. All rights reserved.<br>Powered by webandad',
        'link' => 'http://webandad.com/'
    ],

    'scripts' => [
        'theme/js/libs/jquery.min.js',
        'theme/js/libs/bootstrap.min.js',
        'theme/js/libs/jquery.viewportchecker.min.js',
        'theme/js/libs/slick.min.js',
        'theme/js/main.js',
        'theme/js/slider.js',
        //  'theme/js/bg.js'
    ],

    'yelpScript' => [
        'id' => 'yelp-biz-badge-script-plain-i8xK490z_vPddqxtXhx5vQ',
        'src' => '//yelp.com/biz_badge_js/en_US/plain/i8xK490z_vPddqxtXhx5vQ.js'
    ]
];

if (is_home_page()) {
    $config['footer']['scripts'][] = 'theme/js/bg.js';
}

$GLOBALS['wpp_config'] = $config;