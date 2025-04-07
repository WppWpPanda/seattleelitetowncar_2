<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once 'templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed'));

$servicesConfig = [
    'section' => [
        'id' => 'services',
        'class' => 'services-section',
        'title' => 'Services'
    ],
    'items' => [
        [
            'type' => 'airport',
            'title' => 'Airport',
            'subtitle' => 'service',
            'logo_img' => 'uploads/services/airport.png',
            'logo_alt' => 'Airport transportation icon',
            'main_img' => 'uploads/services/serv-airport_1.png',
            'main_alt' => 'Luxury car for airport transportation',
            'main_title' => 'AIRPORT TRANSPORTATION',
            'button_text' => 'Reserve now',
            'button_aria_label' => 'Reserve now airport transportation service',
            'paragraphs' => [
                'Seattle Airport transportation is our specialty. Our town car service is more enjoyable and more reliable than airport shuttles and taxis.',
                'Our SeaTac airport rates are unbeatable and our airport transportation service is second to none. You do not have to worry about finding someone to drive you, loading your bags, driving in traffic and looking for parking.',
                'Our chauffeur will arrive at your location, load your bags, safely transport you in the speedy HOV lanes, while you relax and prepare for your trip. Upon arriving at SeaTac airport, your chauffeur will unload your bags. When you return, you can count on us to be waiting to greet you in the baggage claim.'
            ]
        ],
        [
            'type' => 'corporate',
            'title' => 'Corporate',
            'subtitle' => 'service',
            'logo_img' => 'uploads/services/corp.png',
            'logo_alt' => 'Corporate transportation icon',
            'main_img' => 'uploads/services/serv-corp.png',
            'main_alt' => 'Professional corporate car service',
            'main_title' => 'Corporate Accounts & Business Ground Transportation',
            'button_text' => 'Reserve now',
            'button_aria_label' => 'Reserve now corporate transportation service',
            'paragraphs' => [
                'Our diverse limousine fleet and years of experience in the field allow to provide a vide variety of ground transportation solutions for your company.',
                'Airport transfers, corporate meeting, events, trade shows, business travel and parties are just some of the limo services that we provide. Our chauffeurs are available 24-hours, 7 days a week.',
                'Enjoy the ease of monthly invoicing, special limousine and town car rates and the simplicity of online reservations.',
                'You can count on us to be your ground transportation partner.'
            ]
        ],
        [
            'type' => 'weddings',
            'title' => 'Weddings',
            'subtitle' => 'service',
            'logo_img' => 'uploads/services/wedding.png',
            'logo_alt' => 'Wedding transportation icon',
            'main_img' => 'uploads/services/serv-wedding.png',
            'main_alt' => 'Luxury wedding limousine service',
            'main_title' => 'Weddings',
            'button_text' => 'Reserve now',
            'button_aria_label' => 'Reserve now wedding transportation service',
            'paragraphs' => [
                'This day is about you! This is your special day and we truly understand that.',
                'We will work closely with you to accommodate all your requests, creating the experience and memories that you will cherish for the rest of your life.'
            ]
        ],
        [
            'type' => 'proms',
            'title' => 'Proms',
            'subtitle' => 'service',
            'logo_img' => 'uploads/services/proms.png',
            'logo_alt' => 'Special events transportation icon',
            'main_img' => 'uploads/services/serv-proms.png',
            'main_alt' => 'Luxury transportation for special events',
            'main_title' => 'Special Events / Bar & Bat Mitzvahs / Bachelor & Bachelorette Parties / Parties',
            'button_text' => 'Reserve now',
            'button_aria_label' => 'Reserve now special event transportation',
            'paragraphs' => [
                'Relax and have fun! Let us deal with the traffic and the parking, while you and your family or friends concentrate on the special time together.',
                'And if you consumed alcoholic beverages you do not have to worry about the way back, as we will safely transport you and your party to your final destination.'
            ]
        ]
    ]
];
?>

<section id="<?php echo htmlspecialchars($servicesConfig['section']['id']); ?>"
             class="<?php echo htmlspecialchars($servicesConfig['section']['class']); ?>"
             aria-label="<?php echo htmlspecialchars($servicesConfig['section']['title']); ?>">

        <div class="content-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="header-short" role="heading" aria-level="2">
                            <h2 class="header-short__text"><?php echo htmlspecialchars($servicesConfig['section']['title']); ?></h2>
                            <div class="header-short__line" aria-hidden="true"></div>
                            <div class="header-short__line" aria-hidden="true"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <?php foreach ($servicesConfig['items'] as $service): ?>
                <div class="row">
                    <div class="service-bg">
                        <div class="content-wrap">
                            <div class="service-item__wrap">

                                <!-- Service Logo Block -->
                                <div class="service-logo">
                                    <img class="service-logo__img"
                                         src="<?php echo htmlspecialchars($service['logo_img']); ?>"
                                         alt="<?php echo htmlspecialchars($service['logo_alt']); ?>"
                                         aria-hidden="false">
                                    <h2 class="service-logo__title"><?php echo htmlspecialchars($service['title']); ?></h2>
                                    <h3 class="service-logo__title-sm"><?php echo htmlspecialchars($service['subtitle']); ?></h3>
                                </div>

                                <!-- Main Service Image -->
                                <div class="service-item service-item--fullwidth">
                                    <figure class="service-item__figure">
                                        <img class="service-item__img service-item__img--full"
                                             src="<?php echo htmlspecialchars($service['main_img']); ?>"
                                             alt="<?php echo htmlspecialchars($service['main_alt']); ?>"
                                             aria-describedby="desc-<?php echo htmlspecialchars($service['type']); ?>">
                                        <figcaption class="service-item__figcaption service-item__figcaption--full">
                                            <a href="reservation<?php echo PHP; ?>"
                                               class="btn btn-yellow service-item__btn--center"
                                               aria-label="<?php echo htmlspecialchars($service['button_aria_label']); ?>">
                                                <?php echo htmlspecialchars($service['button_text']); ?>
                                            </a>
                                        </figcaption>
                                    </figure>
                                </div>

                                <!-- Service Description -->
                                <div id="desc-<?php echo htmlspecialchars($service['type']); ?>">
                                    <h3 class="service-item__top">
                                        <?php echo htmlspecialchars($service['main_title']); ?>
                                    </h3>

                                    <?php foreach ($service['paragraphs'] as $paragraph): ?>
                                        <p class="service-item__body"><?php echo htmlspecialchars($paragraph); ?></p>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php require_once 'templates/footer.php';