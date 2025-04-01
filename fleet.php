<?php
require_once 'templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed'));
$fleetConfig = [
    'section' => [
        'id' => 'fleet',
        'class' => 'fleet-section',
        'title' => 'Our fleet',
        'reservation_btn' => [
            'text' => 'Reservation',
            'url' => 'reservation' . PHP,
            'aria_label' => 'Make a reservation'
        ]
    ],
    'items' => [
        [
            'type' => 'sedans',
            'title' => 'Luxury Sedans',
            'image' => 'uploads/fleets/kandinsky-download-1724423545133-qt1btnahp3xnxk54hb9dehf3g2hvza6xi44cut9u7g.png',
            'image_alt' => 'Lincoln MKT luxury sedan',
            'description' => 'Lincoln TOWN CAR / Chrysler 300 / Lincoln MK / Cadillac ATS / Mersedes S550',
            'see_all_url' => 'fleet-sedans'  . PHP,
            'see_all_aria' => 'View all luxury sedan options',
            'reserve_aria' => 'Reserve a luxury sedan'
        ],
        [
            'type' => 'suvs',
            'title' => 'Luxury Suvs',
            'image' => 'uploads/fleets/kandinsky-download-1724426082515-qt1dqbe0zdxs40e9hzu6k5ldrg18b8szlzvd0jgfn0.png',
            'image_alt' => 'Cadillac Escalade SUV',
            'description' => 'Cadillac Escalade / GMC Denali',
            'see_all_url' => 'fleet-suvs.php.html',
            'see_all_aria' => 'View all luxury SUV options',
            'reserve_aria' => 'Reserve a luxury SUV'
        ],
        [
            'type' => 'vans',
            'title' => 'Luxury Van',
            'image' => 'uploads/fleets/kandinsky-download-1724425009453-qt1d3t55c74m4536x9lruu21payu05gd6litc0tsmk.png',
            'image_alt' => 'Mercedes Sprinter van',
            'description' => 'Mercedes VAN',
            'see_all_url' => 'fleet-vans.php.html',
            'see_all_aria' => 'View all luxury van options',
            'reserve_aria' => 'Reserve a luxury van'
        ],
        [
            'type' => 'limousines',
            'title' => 'Luxury Limousines',
            'image' => 'uploads/fleets/limo-1-qfk0xirfe3w1os735ans8d17a3gvy5uly4exriuy3w.png',
            'image_alt' => 'Cadillac stretch limousine',
            'description' => 'Chrysler 300 / Cadillac Stretch Limousine / HUMMER',
            'see_all_url' => 'fleet-limos.php.html',
            'see_all_aria' => 'View all limousine options',
            'reserve_aria' => 'Reserve a limousine'
        ],
        [
            'type' => 'buses',
            'title' => 'Luxury Buses',
            'image' => 'uploads/fleets/bus-2-qfk15gid3qr7q8o0sq6dacxbv8cgy5d0deqjnn39kc.png',
            'image_alt' => 'Executive mini coach bus',
            'description' => 'Limo Buses / Luxury Coach Bus / Executive Mini Coach Bus / Limo Bus',
            'see_all_url' => 'fleet-buses.php.html',
            'see_all_aria' => 'View all luxury bus options',
            'reserve_aria' => 'Reserve a luxury bus'
        ]
    ]
];
?>

    <section id="<?php echo htmlspecialchars($fleetConfig['section']['id']); ?>"
             class="<?php echo htmlspecialchars($fleetConfig['section']['class']); ?>"
             aria-label="<?php echo htmlspecialchars($fleetConfig['section']['title']); ?>">

        <div class="content-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="header-short" role="heading" aria-level="2">
                            <h2 class="header-short__text"><?php echo htmlspecialchars($fleetConfig['section']['title']); ?></h2>
                            <div class="header-short__line" aria-hidden="true"></div>
                            <div class="header-short__line" aria-hidden="true"></div>
                            <a href="<?php echo htmlspecialchars($fleetConfig['section']['reservation_btn']['url']); ?>"
                               class="btn-yellow header-short__btn"
                               aria-label="<?php echo htmlspecialchars($fleetConfig['section']['reservation_btn']['aria_label']); ?>">
                                <?php echo htmlspecialchars($fleetConfig['section']['reservation_btn']['text']); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrap bg-light">
            <div class="content-wrap content-wrap--top">
                <div class="container-fluid">
                    <div class="row"></div>
                    <div class="row">
                        <?php foreach ($fleetConfig['items'] as $item): ?>
                            <div class="fleet-item">
                                <figure class="fleet-item__figure">
                                    <img class="fleet-item__img"
                                         src="<?php echo htmlspecialchars($item['image']); ?>"
                                         alt="<?php echo htmlspecialchars($item['image_alt']); ?>"
                                         aria-hidden="false">
                                </figure>
                                <div class="fleet-item__body">
                                    <h2 class="fleet-item__title"><?php echo htmlspecialchars($item['title']); ?></h2>
                                    <div class="fleet-item__desc">
                                        <p class="fleet-item__desc-p"><?php echo htmlspecialchars($item['description']); ?></p>
                                    </div>
                                    <div class="fleet-item__btn-group">
                                        <a href="<?php echo htmlspecialchars($item['see_all_url']); ?>"
                                           class="btn-yellow btn-yellow--inv fleet-item__btn--db"
                                           aria-label="<?php echo htmlspecialchars($item['see_all_aria']); ?>">
                                            See All
                                        </a>
                                        <a href="reservation<?php echo PHP; ?>"
                                           class="btn-yellow btn-yellow--inv fleet-item__btn--db"
                                           aria-label="<?php echo htmlspecialchars($item['reserve_aria']); ?>">
                                            Reserve now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php require_once 'templates/footer.php';