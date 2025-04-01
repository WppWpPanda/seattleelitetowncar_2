<?php
require_once 'templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed')); ?>

<?php
$config = [
    'home' => [
        'welcome' => 'Welcome to',
        'title' => 'Seattle Elite Towncar Limousine and Coach',
        'description' => 'Professional luxury transportation services with nobility, confidentiality and protocol.',
        'buttons' => [
            'reserve' => [
                'text' => 'Reserve now',
                'url' => 'reservation.php.html',
                'aria_label' => 'Make a reservation'
            ],
            'scroll_down' => [
                'text' => 'scroll down',
                'url' => 'index.html#services',
                'aria_label' => 'Scroll down to services section'
            ]
        ]
    ],
    'services' => [
        'title' => 'services',
        'items' => [
            [
                'title' => 'Airport',
                'subtitle' => 'services',
                'image' => 'uploads/services/img-01.jpg',
                'alt' => 'Airport car services',
                'url' => 'services.php.html',
                'button_text' => 'See more'
            ],
            [
                'title' => 'Corporate',
                'subtitle' => 'services',
                'image' => 'uploads/services/img-03.jpg',
                'alt' => 'Corporate car services',
                'url' => 'services.php.html',
                'button_text' => 'See more'
            ],
            [
                'title' => 'Weddings',
                'subtitle' => 'services',
                'image' => 'uploads/services/img-02.jpg',
                'alt' => 'Weddings car services',
                'url' => 'services.php.html',
                'button_text' => 'See more'
            ],
            [
                'title' => 'Proms',
                'subtitle' => 'services',
                'image' => 'uploads/services/img-04.png',
                'alt' => 'Proms car services',
                'url' => 'services.php.html',
                'button_text' => 'See more'
            ]
        ],
        'scroll_down' => [
            'text' => 'scroll down',
            'url' => 'index.html#fleet',
            'aria_label' => 'Scroll down to fleet section'
        ]
    ],
    'fleet' => [
        'title' => 'our fleet',
        'description' => 'TAKE A LOOK AT OUR VEHICLES',
        'tabs' => [
            [
                'id' => 'fleetbuses',
                'title' => 'Luxury Buses',
                'items' => [
                    [
                        'image' => 'uploads/fleetcategories/img2.png',
                        'alt' => 'Executive mini coach bus',
                        'description' => '<strong>EXECUTIVE MINI COACH BUS</strong> | 24 PASSENGER',
                        'url' => 'fleet-buses.php.html',
                        'button_text' => 'See All'
                    ]
                ]
            ],
            [
                'id' => 'fleetlimos',
                'title' => 'Luxury Limousines',
                'items' => [
                    [
                        'image' => 'uploads/fleetcategories/img1.png',
                        'alt' => 'Cadillac limousine',
                        'description' => '<strong>Cadillac</strong> Limousine',
                        'url' => 'fleet-limos.php.html',
                        'button_text' => 'See All'
                    ]
                ]
            ],
            [
                'id' => 'fleetsedans',
                'title' => 'Luxury Sedans',
                'items' => [
                    [
                        'image' => 'uploads/fleetcategories/img5.png',
                        'alt' => 'Lincoln MKT',
                        'description' => 'LINCOLN MKT',
                        'url' => 'fleet-sedans.php.html',
                        'button_text' => 'See All'
                    ]
                ]
            ],
            [
                'id' => 'fleetsuvs',
                'title' => 'Luxury Suvs',
                'items' => [
                    [
                        'image' => 'uploads/fleetcategories/img4.png',
                        'alt' => 'Cadillac escalade',
                        'description' => '<strong>cadillac</strong> escalade',
                        'url' => 'fleet-suvs.php.html',
                        'button_text' => 'See All'
                    ]
                ]
            ],
            [
                'id' => 'fleetvans',
                'title' => 'Luxury Van',
                'items' => [
                    [
                        'image' => 'uploads/fleetcategories/img3.png',
                        'alt' => 'Mercedes Sprinter',
                        'description' => '<strong>Mercedes</strong> Sprinter',
                        'url' => 'fleet-vans.php.html',
                        'button_text' => 'See All'
                    ]
                ]
            ]
        ],
        'scroll_down' => [
            'text' => 'scroll down',
            'url' => 'index.html#about',
            'aria_label' => 'Scroll down to about section'
        ]
    ],
    'about' => [
        'title' => 'ABOUT',
        'description' => 'SEATTLE ELITE TOWNCAR',
        'content' => [
            '<p class="about-content"><strong>Seattle&nbsp;ELITE Town Car and Limousine Service.</strong></p>',
            '<p class="about-content">There is a difference between shopping in Nordstrom as opposed to shopping in Marshall\'s. There is a difference between a cup of Starbucks coffee and a cup from the local diner.</p>
            <p class="about-content">There is a difference between Seattle ELITE Town Car and other Seattle Limousine Companies.</p>
            <p class="about-content">Our passion for what we do is what drives us to continually improve and excel. Our desire to be different is what inspires us to pay close attention to every detail.</p>
            <p class="about-content">Driving is only a part of what we do. From the moment you contact us, we work very hard to make your trip as smooth and efficient as possible. We train our operators to be courteous and knowledgeable. We make sure that our drivers are punctual and our cars are clean. We pay attention to your mood and we listen to your comments and suggestions, to make sure that our service meets your expectations.</p>
            <p class="about-content">We provide service for personal and business travel. We specialize in airport transportation and in corporate travel. Our diverse fleet allows us to offer a vast array of services to our clients and accommodate even the most complicated requests.</p>
            <p class="about-content">If you have any further questions, please call us at (206) 453-9128, and one of our operators will provide you with the information that you need. You may also e-mail us at info@seattleelitetowncar.com.</p>
            <p class="about-content">We value our clients and our relationship with them. Thank you for visiting our web site. We look forward to offering you our town car & limousine services.</p>
            <p class="about-content">Areas served include: Seattle, Bellevue, Redmond, Kirkland, Issaquah & Sammamish. For the lowest town car rental and limousine rates, contact us today!</p>',
        ],
        'buttons' => [
            'read_more' => [
                'text' => 'Read more',
                'url' => 'index.html#',
                'aria_label' => 'Read more about us'
            ]
        ],
        'links' => [
            [
                'text' => 'Articles',
                'url' => 'seattleelitetowncar.php?Action=1&k=seattle-limo-service.html'
            ],
            [
                'text' => 'News',
                'url' => 'seattleelitetowncar.php?Action=2&k=seattle-town-car-service.html'
            ]
        ],
        'scroll_down' => [
            'text' => 'scroll down',
            'url' => 'index.html#footer',
            'aria_label' => 'Scroll down to footer'
        ]
    ],
    'background' => [
        'images' => [
            'theme/images/bg.jpg'
        ]
    ]
];
?>

    <!-- Home Section -->
    <section id="home" aria-label="Home section">
        <div class="container-fluid">
            <div class="home__wrap">
                <div class="home">
                    <h2 class="home__top animated zoomIn"><?php echo htmlspecialchars($config['home']['welcome']); ?></h2>
                    <h1 class="home__title animated zoomIn"><?php echo htmlspecialchars($config['home']['title']); ?></h1>
                    <h3 class="home__text animated zoomIn"><?php echo htmlspecialchars($config['home']['description']); ?></h3>

                    <a href="<?php echo htmlspecialchars($config['home']['buttons']['scroll_down']['url']); ?>"
                       class="scroll-down"
                       aria-label="<?php echo htmlspecialchars($config['home']['buttons']['scroll_down']['aria_label']); ?>">
                        <?php echo htmlspecialchars($config['home']['buttons']['scroll_down']['text']); ?>
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </a>

                    <a class="svg-wrapper"
                       href="<?php echo htmlspecialchars($config['home']['buttons']['reserve']['url']); ?>"
                       aria-label="<?php echo htmlspecialchars($config['home']['buttons']['reserve']['aria_label']); ?>">
                        <svg height="60" width="280" xmlns="">
                            <rect class="shape"/>
                        </svg>
                        <div class="text"><?php echo htmlspecialchars($config['home']['buttons']['reserve']['text']); ?></div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services wrap" aria-label="Services section">
        <div class="container-fluid">
            <div class="home-header">
                <div class="home-header__wrap">
                    <div class="heading-line">
                        <hr aria-hidden="true">
                        <hr aria-hidden="true">
                    </div>
                    <h2 class="home-header__title"><a
                                href="index.html#"><?php echo htmlspecialchars($config['services']['title']); ?></a>
                    </h2>
                    <div class="heading-line">
                        <hr aria-hidden="true">
                        <hr aria-hidden="true">
                    </div>
                </div>
                <span class="home-header__text"></span>
            </div>
        </div>

        <div class="bg-dark">
            <div class="content-wrapper">
                <div class="service-slider-wrapper">
                    <button type="button" class="prev" aria-label="Previous service">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                    </button>

                    <div class="service-slider">
                        <?php foreach ($config['services']['items'] as $service): ?>
                            <div class="service-item">
                                <figure class="service-item__figure">
                                    <img class="service-item__img"
                                         src="<?php echo htmlspecialchars($service['image']); ?>"
                                         alt="<?php echo htmlspecialchars($service['alt']); ?>">
                                    <figcaption class="service-item__figcaption">
                                        <h2 class="service-item__title"><?php echo htmlspecialchars($service['title']); ?></h2>
                                        <p class="service-item__title-sm"><?php echo htmlspecialchars($service['subtitle']); ?></p>
                                        <a href="<?php echo htmlspecialchars($service['url']); ?>"
                                           class="btn btn-yellow service-item__btn"
                                           aria-label="Learn more about <?php echo htmlspecialchars($service['title']); ?> services">
                                            <?php echo htmlspecialchars($service['button_text']); ?>
                                        </a>
                                    </figcaption>
                                </figure>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="button" class="next" aria-label="Next service">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>

        <a href="<?php echo htmlspecialchars($config['services']['scroll_down']['url']); ?>"
           class="scroll-down"
           aria-label="<?php echo htmlspecialchars($config['services']['scroll_down']['aria_label']); ?>">
            <?php echo htmlspecialchars($config['services']['scroll_down']['text']); ?>
            <i class="fa fa-angle-down" aria-hidden="true"></i>
        </a>
    </section>

    <!-- Fleet Section -->
    <section id="fleet" class="fleet wrap" aria-label="Our fleet section">
        <div class="container-fluid content-wrapper">
            <div class="home-header">
                <div class="home-header__wrap">
                    <div class="heading-line">
                        <hr aria-hidden="true">
                        <hr aria-hidden="true">
                    </div>
                    <h2 class="home-header__title"><a
                                href="fleet-buses.php.html"><?php echo htmlspecialchars($config['fleet']['title']); ?></a>
                    </h2>
                    <div class="heading-line">
                        <hr aria-hidden="true">
                        <hr aria-hidden="true">
                    </div>
                </div>
                <span class="home-header__text"><?php echo htmlspecialchars($config['fleet']['description']); ?></span>
            </div>
        </div>
        <div id="preloader" class="preloader">
            <div class="preloader__load">
                <i class="fa fa-spinner fa-pulse fa-3x fa-fw" aria-hidden="true"></i>
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="">
            <ul id="tab-caption" class="nav nav-tabs nav-justified fleet-nav-tabs" role="tablist">
                <?php foreach ($config['fleet']['tabs'] as $tab): ?>
                    <li role="presentation" class="<?php echo ($tab['id'] === 'fleetbuses') ? 'active' : ''; ?>">
                        <a class="fleet-nav-tabs__link"
                           href="#<?php echo htmlspecialchars($tab['id']); ?>"
                           aria-controls="<?php echo htmlspecialchars($tab['id']); ?>"
                           role="tab"
                           data-toggle="tab"
                           aria-selected="<?php echo ($tab['id'] === 'fleetbuses') ? 'true' : 'false'; ?>">
                            <?php echo htmlspecialchars($tab['title']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="tab-content fleet-tab-content">
            <?php foreach ($config['fleet']['tabs'] as $index => $tab): ?>
                <div role="tabpanel"
                     class="tab-pane fade <?php echo ($tab['id'] === 'fleetbuses') ? 'in active' : ''; ?>"
                     id="<?php echo htmlspecialchars($tab['id']); ?>">
                    <div class="container">
                        <div class="fleet-tab-content__wrap">
                            <div class="slick-tab" id="<?php echo htmlspecialchars($tab['id']); ?>S">
                                <?php foreach ($tab['items'] as $item): ?>
                                    <div class="fleet-tab-content__item">
                                        <img class="fleet-tab-content__img img-responsive"
                                             src="<?php echo htmlspecialchars($item['image']); ?>"
                                             alt="<?php echo htmlspecialchars($item['alt']); ?>">
                                        <p class="fleet-tab-content__desc"><?php echo $item['description']; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="arrow-buttons">
                        <button type="button" class="prev" aria-label="Previous vehicle">
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="next" aria-label="Next vehicle">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </button>
                    </div>

                    <div class="fleet-tab-content__footer" id="d-0<?php echo $index; ?>">
                        <a href="<?php echo htmlspecialchars($item['url']); ?>" class="btn btn-grey"
                           aria-label="View all <?php echo htmlspecialchars($tab['title']); ?>">
                            <?php echo htmlspecialchars($item['button_text']); ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <a href="<?php echo htmlspecialchars($config['fleet']['scroll_down']['url']); ?>"
           class="scroll-down"
           aria-label="<?php echo htmlspecialchars($config['fleet']['scroll_down']['aria_label']); ?>">
            <?php echo htmlspecialchars($config['fleet']['scroll_down']['text']); ?>
            <i class="fa fa-angle-down" aria-hidden="true"></i>
        </a>
    </section>

    <!-- About Section -->
    <section id="about" class="about wrap" aria-label="About us section">
        <div class="home-header">
            <div class="home-header__wrap">
                <div class="heading-line">
                    <hr aria-hidden="true">
                    <hr aria-hidden="true">
                </div>
                <h2 class="home-header__title"><a
                            href="index.html#"><?php echo htmlspecialchars($config['about']['title']); ?></a></h2>
                <div class="heading-line">
                    <hr aria-hidden="true">
                    <hr aria-hidden="true">
                </div>
            </div>
            <span class="home-header__text"><?php echo htmlspecialchars($config['about']['description']); ?></span>
        </div>

        <div class="about-container">
            <?php foreach ($config['about']['content'] as $paragraph): ?>
                <?php echo $paragraph; ?>
            <?php endforeach; ?>

            <p><a class="btn btn-yellow-border"
                  href="<?php echo htmlspecialchars($config['about']['buttons']['read_more']['url']); ?>"
                  aria-label="<?php echo htmlspecialchars($config['about']['buttons']['read_more']['aria_label']); ?>">
                    <?php echo htmlspecialchars($config['about']['buttons']['read_more']['text']); ?>
                </a></p>

            <center>
                <?php foreach ($config['about']['links'] as $link): ?>
                    <a href="<?php echo htmlspecialchars($link['url']); ?>" style="color: #ffffff">
                        <?php echo htmlspecialchars($link['text']); ?>
                    </a>
                    <?php if ($link !== end($config['about']['links'])) echo ' | '; ?>
                <?php endforeach; ?>
            </center>
        </div>

        <a href="<?php echo htmlspecialchars($config['about']['scroll_down']['url']); ?>"
           class="scroll-down"
           aria-label="<?php echo htmlspecialchars($config['about']['scroll_down']['aria_label']); ?>">
            <?php echo htmlspecialchars($config['about']['scroll_down']['text']); ?>
            <i class="fa fa-angle-down" aria-hidden="true"></i>
        </a>
    </section>

    <!-- Background -->
    <div id="bg">
        <?php foreach ($config['background']['images'] as $image): ?>
            <div style="background-image: url(<?php echo htmlspecialchars($image); ?>); background-position: center center;"></div>
        <?php endforeach; ?>
    </div>
<?php require_once 'templates/footer.php';