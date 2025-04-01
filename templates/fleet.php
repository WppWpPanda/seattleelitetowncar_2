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
                <div class="row">
                    <h2 class="fleet__top"><?php echo htmlspecialchars($fleetConfig['category']['title']); ?></h2>
                </div>
                <div class="row">
                    <?php $i = 1;
                    foreach ($fleetConfig['vehicles'] as $vehicle): ?>
                        <div class="fleet-item<?php echo $i%2 === 0 ? ' flex-reverse' : ''; ?>">
                            <figure class="fleet-item__figure">
                                <img class="fleet-item__img"
                                     src="<?php echo htmlspecialchars($vehicle['main_img']); ?>"
                                     alt="<?php echo htmlspecialchars($vehicle['main_alt']); ?>"
                                     aria-hidden="false">
                                <img class="fleet-item__imgin"
                                     src="<?php echo htmlspecialchars($vehicle['inner_img']); ?>"
                                     alt="<?php echo htmlspecialchars($vehicle['inner_alt']); ?>"
                                     aria-hidden="false">
                            </figure>
                            <div class="fleet-item__body">
                                <h2 class="fleet-item__title <?php echo $i%2 === 0 ? 'right-skew' : 'left-skew'; ?>"><?php echo htmlspecialchars($vehicle['model']); ?></h2>
                                <div class="fleet-item__desc">
                                    <img class="fleet-item__icon"
                                         src="<?php echo htmlspecialchars($fleetConfig['icons']['capacity']); ?>"
                                         alt="" aria-hidden="true">
                                    <div class="fleet-item__desc-val"><?php echo htmlspecialchars($vehicle['capacity']); ?></div>
                                    <img class="fleet-item__icon"
                                         src="<?php echo htmlspecialchars($fleetConfig['icons']['luggage']); ?>"
                                         alt="" aria-hidden="true">
                                    <div class="fleet-item__desc-val"><?php echo htmlspecialchars($vehicle['luggage']); ?></div>
                                </div>
                                <div class="fleet-item__btn-group">
                                    <a href="quote<?php echo PHP ?>"
                                       class="btn-yellow btn-yellow--inv fleet-item__btn--db"
                                       aria-label="<?php echo htmlspecialchars($vehicle['quote_aria']); ?>">
                                        Get a quote
                                    </a>
                                    <a href="reservation<?php echo PHP ?>"
                                       class="btn-yellow btn-yellow--inv fleet-item__btn--db"
                                       aria-label="<?php echo htmlspecialchars($vehicle['reserve_aria']); ?>">
                                        Reserve now
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i++;
                    endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>