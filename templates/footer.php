<?php
defined('ABS_PATH') or exit('No direct script access allowed');
$config = $wpp_config['footer'];
?>

<footer id="footer" class="footer" aria-label="Site footer">
    <div class="view-list">
        <div class="container">
            <div class="row">
                <?php foreach ($config['navItems'] as $item): ?>
                    <div class="col-xs-6 col-sm-3">
                        <div class="view-list__container">
                            <a class="view-list__link" href="<?php echo htmlspecialchars($item['href']) ?>"
                               title="<?php echo htmlspecialchars($item['title']) ?>"
                               aria-label="<?php echo htmlspecialchars($item['title']) ?>">
                                <div class="view-list__icon">
                                    <img class="view-list__img" src="<?php echo htmlspecialchars($item['icon']) ?>"
                                         alt="<?php echo htmlspecialchars($item['alt']) ?>" loading="lazy">
                                </div>
                                <span class="view-list__desc"><?php echo htmlspecialchars($item['title']) ?></span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="wrap">
        <div class="contacts">
            <div class="container content-wrapper">
                <div class="row">
                    <!-- Address Block -->
                    <div class="col-sm-4">
                        <h3 class="contacts__title"><?php echo htmlspecialchars($config['addressBlock']['title']) ?></h3>
                        <hr class="contacts__line" aria-hidden="true">
                        <address><?php echo $config['addressBlock']['content'] ?></address>
                    </div>

                    <!-- Contacts Block -->
                    <div class="col-sm-5">
                        <h3 class="contacts__title"><?php echo htmlspecialchars($config['contactsBlock']['title']) ?></h3>
                        <hr class="contacts__line" aria-hidden="true">
                        <address><?php echo $config['contactsBlock']['content'] ?></address>
                    </div>

                    <!-- Social Block -->
                    <div class="col-sm-3">
                        <h3 class="contacts__title">Follow Us</h3>
                        <hr class="contacts__line" aria-hidden="true">
                        <div class="social-icons" role="list">
                            <?php foreach ($config['socialLinks'] as $social): ?>
                                <div class="icons" role="listitem">
                                    <a href="<?php echo htmlspecialchars($social['href']) ?>" target="_blank"
                                       rel="noopener noreferrer" aria-label="<?php echo htmlspecialchars($social['label']) ?>">
                                        <i class="<?php echo htmlspecialchars($social['class']) ?>" aria-hidden="true"></i>
                                    </a>
                                </div>
                            <?php endforeach; ?>

                            <div style="margin-top:8px;" id="<?php echo $config['yelpBadge']['id'] ?>">
                                <a href="<?php echo $config['yelpBadge']['link'] ?>" target="_blank" rel="noopener noreferrer">
                                    <?php echo $config['yelpBadge']['text'] ?>
                                </a>
                            </div>
                        </div>

                        <a href="<?php echo $config['quoteButton']['href'] ?>" class="<?php echo $config['quoteButton']['class'] ?>" role="button">
                            <?php echo $config['quoteButton']['text'] ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="copyright">
            <div class="container content-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="text-center">
                            <a target="_blank" href="<?php echo $config['copyright']['link'] ?>" rel="noopener noreferrer">
                                <?php echo $config['copyright']['text'] ?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<?php foreach ($config['scripts'] as $script): ?>
    <script src="<?php echo htmlspecialchars($script) ?>" defer></script>
<?php endforeach; ?>

<!-- Yelp Script -->
<script>
    (function (d, t) {
        var g = d.createElement(t);
        var s = d.getElementsByTagName(t)[0];
        g.id = "<?php echo $config['yelpScript']['id'] ?>";
        g.src = "<?php echo $config['yelpScript']['src'] ?>";
        g.async = true;
        s.parentNode.insertBefore(g, s);
        g.onload = function () {
            var yelpLink = document.querySelector('#<?php echo $config['yelpBadge']['id'] ?> a');
            yelpLink.setAttribute('target', '_blank');
            yelpLink.setAttribute('rel', 'noopener noreferrer');
            yelpLink.setAttribute('aria-label', 'Yelp reviews');
        }
    }(document, 'script'));
</script>

</body>
</html>