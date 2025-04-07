<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed'));
?>
    <section>

        <div class="content-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="header-short">
                            <h2 class="header-short__text">TITLE</h2>
                            <div class="header-short__line"></div>
                            <div class="header-short__line"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap bg-light">
            <div class="content-wrap content-wrap--top ">
                <div class="container-fluid">
                    <div class="row">
                        <div class="service-item service-item--fullwidth">
                            <figure class="service-item__figure">
                                <img class="service-item__img service-item__img--full" src="/wpp-media/bfi_thumb/image-38-qgbxhxjhxs06kbvw4m1kxrjrafj1i2c7s6xhwo7g5w.png" alt="">
                                <figcaption class="service-item__figcaption service-item__figcaption--full">
                                    <time class="btn btn-yellow service-item__btn--center" datetime="11.12.2023">11.12.2023</time>                            </figcaption>
                            </figure>
                        </div>

                        <div class="wpp-content">
                            CONTENT
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';