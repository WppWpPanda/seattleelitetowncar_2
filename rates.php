<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed'));
$rates_settings = array(
    'page_title' => 'Rates',
    'reservation_link' => 'reservation.php.html',
    'tabs' => array(
        'airport' => array(
            'title' => 'Airport Transportation',
            'icon' => 'fa-plane',
            'active' => true
        ),
        'hourly' => array(
            'title' => 'Hourly rates',
            'icon' => 'fa-clock-o',
            'active' => false
        )
    ),
    'airport_rates' => array(
        array('location' => 'Algona', 'price' => '$85.00'),
        array('location' => 'Aberdeen WA', 'price' => '$395.00'),
        array('location' => 'Anacortes', 'price' => '$350.00'),
        array('location' => 'Arlington', 'price' => '$200 - $230'),
        array('location' => 'Auburn', 'price' => '$80-$100'),
        array('location' => 'Aurora Village', 'price' => '$85.00'),
        array('location' => 'Ballard', 'price' => '$85 - $90'),
        array('location' => 'Bangor', 'price' => '$210.00'),
        array('location' => 'Bellevue', 'price' => '$75-$80'),
        array('location' => 'Bellingham', 'price' => '$400.00'),
        array('location' => 'Bitter Lake', 'price' => '$80.00'),
        array('location' => 'Black Diamond', 'price' => '$100.00'),
        array('location' => 'Blaine', 'price' => '$445.00'),
        array('location' => 'Cle Elum', 'price' => '$300.00'),
        array('location' => 'Bonney Lake', 'price' => '$125.00'),
        array('location' => 'Bothell', 'price' => '$100 - $120'),
        array('location' => 'Bow', 'price' => '$245.00'),
        array('location' => 'Bremerton', 'price' => '$215 - $235'),
        array('location' => 'Buckley', 'price' => '$110.00'),
        array('location' => 'Burlington', 'price' => '$275.00'),
        array('location' => 'Camano Island', 'price' => '$275.00'),
        array('location' => 'Carnation', 'price' => '$110 - $125'),
        array('location' => 'Chehalls', 'price' => '$245.00'),
        array('location' => 'Clyde Hill', 'price' => '$75.00'),
        array('location' => 'Coal Creek', 'price' => '$75.00'),
        array('location' => 'Covington', 'price' => '$85-$95'),
        array('location' => 'DuPont', 'price' => '$140.00'),
        array('location' => 'Duvall', 'price' => '$125.00'),
        array('location' => 'Edmonds', 'price' => '$100-$120'),
        array('location' => 'Enumclaw', 'price' => '$135- $145'),
        array('location' => 'Everett', 'price' => '$135-$150'),
        array('location' => 'Fairwood', 'price' => '$75.00'),
        array('location' => 'Fall City', 'price' => '$100 - $120'),
        array('location' => 'Federal Way', 'price' => '$75-$85'),
        array('location' => 'Ferndale', 'price' => '$400.00'),
        array('location' => 'Fife', 'price' => '$90-$100'),
        array('location' => 'Fircrest', 'price' => '$100.00'),
        array('location' => 'Fort Lewis', 'price' => '$100.00'),
        array('location' => 'Fremont', 'price' => '$75.00'),
        array('location' => 'Gig Harbor', 'price' => '$125 - $150'),
        array('location' => 'Gorst', 'price' => '$170.00'),
        array('location' => 'Graham', 'price' => '$120-$150'),
        array('location' => 'Green Lake', 'price' => '$85.00'),
        array('location' => 'Greeenwood', 'price' => '$85.00'),
        array('location' => 'Inglewood', 'price' => '$90.00'),
        array('location' => 'Issaquah', 'price' => '$90-$100'),
        array('location' => 'Juanita', 'price' => '$85.00'),
        array('location' => 'Kenmore', 'price' => '$100.00'),
        array('location' => 'Kent', 'price' => '$75-$85'),
        array('location' => 'Kirkland', 'price' => '$80 - $95'),
        array('location' => 'Lacey', 'price' => '$175 - $200'),
        array('location' => 'Lake Chelan', 'price' => '$545.00'),
        array('location' => 'Lake City', 'price' => '$85.00'),
        array('location' => 'Lake Forest Park', 'price' => '$95.00'),
        array('location' => 'Lake Stevens', 'price' => '$165 - $190'),
        array('location' => 'Lake Tapp', 'price' => '$120.00'),
        array('location' => 'Lake Union', 'price' => '$75.00'),
        array('location' => 'Lake View', 'price' => '$75.00'),
        array('location' => 'Lakewood', 'price' => '$125.00'),
        array('location' => 'Laurelhurst', 'price' => '$75.00'),
        array('location' => 'Leachi', 'price' => '$75.00'),
        array('location' => 'Longview', 'price' => '$225.00'),
        array('location' => 'Lynnwood', 'price' => '$110 - $125'),
        array('location' => 'Madigan', 'price' => '$85.00'),
        array('location' => 'Madison Park', 'price' => '$75.00'),
        array('location' => 'Magnolia', 'price' => '$80.00'),
        array('location' => 'Maple Valley', 'price' => '$90.00'),
        array('location' => 'Maplewood', 'price' => '$125.00'),
        array('location' => 'Medina', 'price' => '$75.00'),
        array('location' => 'Mercer Island', 'price' => '$75.00'),
        array('location' => 'Marysville', 'price' => '$190.00'),
        array('location' => 'Mill Creek', 'price' => '$115-$125'),
        array('location' => 'Milton', 'price' => '$90.00'),
        array('location' => 'Monroe', 'price' => '$135-$150'),
        array('location' => 'Mount Vernon', 'price' => '$275.00'),
        array('location' => 'Montlake', 'price' => '$75.00'),
        array('location' => 'Mountlake Terrace', 'price' => '$95.00'),
        array('location' => 'Mukilteo', 'price' => '$135.00'),
        array('location' => 'Newcastle', 'price' => '$75.00'),
        array('location' => 'Newport Hills', 'price' => '$80.00'),
        array('location' => 'North Beach', 'price' => '$75.00'),
        array('location' => 'North Bend', 'price' => '$135.00'),
        array('location' => 'Northgate', 'price' => '$85.00'),
        array('location' => 'Oak Harbor', 'price' => '$345.00'),
        array('location' => 'Olympia', 'price' => '$195-225'),
        array('location' => 'Orting', 'price' => '$120.00'),
        array('location' => 'Pac. Lut. Unit', 'price' => '$85.00'),
        array('location' => 'Pacific', 'price' => '$85.00'),
        array('location' => 'Parkland', 'price' => '$115.00'),
        array('location' => 'Pasco', 'price' => '$550.00'),
        array('location' => 'Port Angeles', 'price' => '$500.00'),
        array('location' => 'Port Ludlow', 'price' => '$300.00'),
        array('location' => 'Port Orchard', 'price' => '$200.00'),
        array('location' => 'Port Townsend', 'price' => '$400.00'),
        array('location' => 'Portage Bay', 'price' => '$75.00'),
        array('location' => 'Portland OR', 'price' => '$500.00'),
        array('location' => 'Poulsbo', 'price' => '$235.00'),
        array('location' => 'Pug. Snd. Nvl. Syd.', 'price' => '$100.00'),
        array('location' => 'Pullman', 'price' => '$900.00'),
        array('location' => 'Purdy', 'price' => '$135.00'),
        array('location' => 'Puyallup', 'price' => '$120.00'),
        array('location' => 'Queen Ann', 'price' => '$75.00'),
        array('location' => 'Rainier', 'price' => '$275.00'),
        array('location' => 'Ravenna', 'price' => '$75.00'),
        array('location' => 'Redmond', 'price' => '$80-$100'),
        array('location' => 'Renton', 'price' => '$70 - $75'),
        array('location' => 'Richmond Beach', 'price' => '$95.00'),
        array('location' => 'Richmond Highlands', 'price' => '$85.00'),
        array('location' => 'Sahalee', 'price' => '$85.00'),
        array('location' => 'Salish Lodge', 'price' => '$100.00'),
        array('location' => 'Sammamish', 'price' => '$100-$110'),
        array('location' => 'Sand Point', 'price' => '$80 - $85'),
        array('location' => 'Seattle Down Town', 'price' => '$75.00'),
        array('location' => 'Sequim', 'price' => '$400.00'),
        array('location' => 'Shelton', 'price' => '$275 - $300'),
        array('location' => 'Shilshole Bay', 'price' => '$75.00'),
        array('location' => 'Shoreline', 'price' => '$95.00'),
        array('location' => 'Silverdale', 'price' => '$215 - $235'),
        array('location' => 'Snohomish', 'price' => '$135-$150'),
        array('location' => 'Snoqualmie', 'price' => '$125.00'),
        array('location' => 'Snoqualmie Pass', 'price' => '$200.00'),
        array('location' => 'Somerset', 'price' => '$75.00'),
        array('location' => 'South Bend', 'price' => '$225.00'),
        array('location' => 'Spanaway', 'price' => '$130.00'),
        array('location' => 'Spokane', 'price' => '$995.00'),
        array('location' => 'Stanwood', 'price' => '$225.00'),
        array('location' => 'Steilcoom', 'price' => '$135.00'),
        array('location' => 'Suncadia Resort', 'price' => '$300.00'),
        array('location' => 'Sumner', 'price' => '$120 - $135'),
        array('location' => 'Tacoma', 'price' => '$95-$115'),
        array('location' => 'Totem Lake', 'price' => '$85.00'),
        array('location' => 'Tulalip', 'price' => '$200.00'),
        array('location' => 'Tumwater', 'price' => '$200.00'),
        array('location' => 'Univ. District', 'price' => '$80.00'),
        array('location' => 'Univ. Place', 'price' => '$110 - $125'),
        array('location' => 'Univ. Pudget Snd.', 'price' => '$80.00'),
        array('location' => 'Vancouver BC', 'price' => '$625.00'),
        array('location' => 'Vancouver, WA', 'price' => '$575.00'),
        array('location' => 'Woodinville', 'price' => '$100-$110'),
        array('location' => 'Walla Walla', 'price' => '$725.00'),
        array('location' => 'Wallingford', 'price' => '$80.00'),
        array('location' => 'Wedgewood', 'price' => '$80.00')
    ),
    'hourly_rates' => array(
        array('vehicle' => '3 Passenger Sedan - 3 hrs minimum', 'price' => '$75.00 hr'),
        array('vehicle' => '6 Passenger SUV - 3 hrs minimum', 'price' => '$110.00 hr'),
        array('vehicle' => '10 Passenger Limo - 4 hrs minimum', 'price' => '$155.00 hr'),
        array('vehicle' => '16 Passenger Limo - 4 hrs minimum', 'price' => '$235.00 hr'),
        array('vehicle' => '20 Passenger Limo - 4 hrs minimum', 'price' => '$255.00 hr'),
        array('vehicle' => '36 Passenger Coach Bus - 5 hours minimum', 'price' => '$295.00 hr'),
        array('vehicle' => '55 Passenger Coach Bus - 5 hours minimum', 'price' => '$325.00 hr')
    ),
    'accessibility' => array(
        'skip_link_text' => 'Skip to main content',
        'reserve_btn_text' => 'Reserve',
        'price_label' => 'Price:',
        'sr_only_class' => 'sr-only'
    )
);
?>
?>

    <section id="rates" class="rates-section" aria-labelledby="rates-heading">
        <a href="#main-content" class="skip-link"><?php echo $rates_settings['accessibility']['skip_link_text']; ?></a>

        <div class="content-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="header-short">
                            <h2 id="rates-heading" class="header-short__text"><?php echo $rates_settings['page_title']; ?></h2>
                            <div class="header-short__line" aria-hidden="true"></div>
                            <div class="header-short__line" aria-hidden="true"></div>
                            <a href="reservation.php.html" class="btn-yellow header-short__btn">
                                <?php echo $rates_settings['accessibility']['reserve_btn_text']; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrap bg-light">
            <div id="main-content" class="content-wrap content-wrap--top">
                <div class="container-fluid">
                    <div class="row">
                        <ul class="nav nav-tabs rate-nav-tabs" role="tablist">
                            <?php foreach ($rates_settings['tabs'] as $tab_id => $tab): ?>
                                <li role="presentation" class="<?php echo $tab['active'] ? 'active active-tab-left' : ''; ?> rate-nav-tabs__item">
                                    <a class="rate-nav-tabs__link"
                                       href="rates<?php echo PHP; ?>#<?php echo $tab_id; ?>"
                                       aria-controls="<?php echo $tab_id; ?>"
                                       role="tab"
                                       data-toggle="tab"
                                       id="tab-<?php echo $tab_id; ?>">
                                        <i class="fa <?php echo $tab['icon']; ?>" aria-hidden="true"></i>
                                        <?php echo $tab['title']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="tab-content">
                            <!-- Airport Transportation Tab -->
                            <div role="tabpanel"
                                 class="tab-pane fade <?php echo $rates_settings['tabs']['airport']['active'] ? 'in active' : ''; ?>"
                                 id="airport"
                                 aria-labelledby="tab-airport">
                                <div class="rate-table" id="rate-airport">
                                    <?php foreach ($rates_settings['airport_rates'] as $rate): ?>
                                        <div class="rate-table__row">
                                            <div class="rate-table__cell">
                                                <span><?php echo $rate['location']; ?></span>
                                            </div>
                                            <div class="rate-table__cell">
                                                <a class="btn-reserve visible-xs"
                                                   href="reservation"<?php echo PHP; ?>
                                                   aria-label="Reserve for <?php echo $rate['location']; ?>">
                                                    <span>Reserve</span>
                                                </a>
                                                <span class="btn-price">
                                            <span class="sr-only"><?php echo $rates_settings['accessibility']['price_label']; ?></span>
                                            <?php echo $rate['price']; ?>
                                        </span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Hourly Rates Tab -->
                            <div role="tabpanel"
                                 class="tab-pane fade <?php echo $rates_settings['tabs']['hourly']['active'] ? 'in active' : ''; ?>"
                                 id="hourly"
                                 aria-labelledby="tab-hourly">
                                <div class="rate-table" id="rate-hourly">
                                    <?php foreach ($rates_settings['hourly_rates'] as $rate): ?>
                                        <div class="rate-table__row">
                                            <div class="rate-table__cell">
                                                <span><?php echo $rate['vehicle']; ?></span>
                                            </div>
                                            <div class="rate-table__cell">
                                                <a class="btn-reserve visible-xs"
                                                   href="reservation"<?php echo PHP; ?>
                                                   aria-label="Reserve <?php echo $rate['vehicle']; ?>">
                                                    <span>Reserve</span>
                                                </a>
                                                <span class="btn-price">
                                            <span class="sr-only"><?php echo $rates_settings['accessibility']['price_label']; ?></span>
                                            <?php echo $rate['price']; ?>
                                        </span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';