<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once 'templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed')); ?>
    <section id="reviews" class="">
        <div class="content-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="header-short">
                            <h2 class="header-short__text">Reviews</h2>
                            <div class="header-short__line"></div>
                            <div class="header-short__line"></div>
                            <a href="reservation<?php echo PHP ?>" class="btn-yellow header-short__btn">Reservation</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap bg-light">
            <div class="content-wrap">
                <div class="content-wrap content-wrap--top">
                    <div class="container-fluid">
                        <div class="row">
                            <script src="https://embed.broadly.com/include.js" defer
                                    data-url="/58A4A4B01971FE00650CBD22/reviews"></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';