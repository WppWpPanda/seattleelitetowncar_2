<?php
global $wpp_config;
$config = $wpp_config['header'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo htmlspecialchars($config['meta']['description']); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($config['meta']['keywords']); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($config['meta']['title']); ?></title>
    <link rel="icon" href="/uploads/icons/cropped-logo_n-32x32.png" sizes="32x32">
    <link rel="icon" href="/uploads/icons/cropped-logo_n-192x192.png" sizes="192x192">
    <link rel="apple-touch-icon" href="/uploads/icons/cropped-logo_n-180x180.png">
    <meta name="msapplication-TileImage" content="/uploads/icons/cropped-logo_n-270x270.png">

    <?php foreach ($config['assets']['styles'] as $style): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($style); ?>">
    <?php endforeach; ?>

    <?php if ($config['scripts']['tracking']['enabled']): ?>
        <script>
            (function (w, d, t, r, u) {
                var f, n, i;
                w[u] = w[u] || [], f = function () {
                    var o = {ti: "<?php echo $config['scripts']['tracking']['id']; ?>", enableAutoSpaTracking: true};
                    o.q = w[u], w[u] = new UET(o), w[u].push("pageLoad")
                },
                    n = d.createElement(t), n.src = r, n.async = 1, n.onload = n.onreadystatechange = function () {
                    var s = this.readyState;
                    s && s !== "loaded" && s !== "complete" || (f(), n.onload = n.onreadystatechange = null)
                },
                    i = d.getElementsByTagName(t)[0], i.parentNode.insertBefore(n, i)
            })(window, document, "script", "<?php echo $config['scripts']['tracking']['src']; ?>", "<?php echo $config['scripts']['tracking']['var']; ?>");
        </script>
    <?php endif; ?>
</head>

<body class="your-class <?php echo is_mobile_device() ? 'wpp-mobile' : ''; ?>">
<nav class="navbar navbar-default my-navbar"
     aria-label="<?php echo htmlspecialchars($config['navigation']['main']['title']); ?>">
    <div class="content-wrap">
        <div class="navbar-header my-navbar__header">
            <a class="navbar-brand brand"
               href="<?php echo htmlspecialchars($config['navigation']['logo']['home_url']); ?>"
               title="<?php echo htmlspecialchars($config['navigation']['logo']['title']); ?>">
                <img class="brand__img" src="<?php echo  ! is_mobile_device() ? htmlspecialchars($config['assets']['logo']['src']) : '/uploads/icons/mobile.logo.png'; ?>"
                     alt="<?php echo htmlspecialchars($config['assets']['logo']['alt']); ?>"
                     aria-hidden="false">
            </a>


            <a href="" class="class="visible-xs">Reserv</a>
            <ul class="phones visible-xs"
                aria-label="<?php echo htmlspecialchars($config['navigation']['phones']['section_label']); ?>">
                <?php foreach ($config['navigation']['phones'] as $key => $phone): ?>
                    <?php if (is_array($phone)): ?>
                        <li class="phones__item">
                            <span class="sr-only"><?php echo htmlspecialchars($phone['desc']); ?></span>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <a class="phones__link" href="tel:<?php echo htmlspecialchars($phone['num']); ?>"
                               aria-label="<?php echo htmlspecialchars($phone['label']); ?>">
                                <span><?php echo htmlspecialchars($phone['display']); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

            <button type="button" class="navbar-toggle collapsed my-toggle"
                    data-toggle="collapse"
                    data-target="#navbar-limousine"
                    aria-expanded="false"
                    aria-controls="navbar-limousine"
                    aria-label="<?php echo htmlspecialchars($config['navigation']['main']['toggle_label']); ?>">
                <span class="sr-only">Open main menu</span>
                <span class="icon-bar" aria-hidden="true"></span>
                <span class="icon-bar" aria-hidden="true"></span>
                <span class="icon-bar" aria-hidden="true"></span>
            </button>

        </div>

        <div class="collapse navbar-collapse my-collapse" id="navbar-limousine">
            <ul class="nav navbar-nav menu" role="menubar"
                aria-label="<?php echo htmlspecialchars($config['navigation']['menu']['section_label']); ?>">
                <?php foreach ($config['navigation']['menu']['items'] as $item): ?>
                    <li class="menu__item <?php echo !empty($item['dropdown']) ? 'dropdown' : '' ?>"
                        role="none">
                        <a class="menu__link <?php echo !empty($item['dropdown']) ? 'dropdown-toggle' : '' ?>"
                           href="<?php echo htmlspecialchars($item['url']); ?>"
                           role="menuitem"
                            <?php echo $item['current'] ? 'aria-current="page"' : '' ?>
                            <?php echo !empty($item['dropdown']) ? 'aria-haspopup="true" aria-expanded="false"' : '' ?>>
                            <?php echo htmlspecialchars($item['title']); ?>
                        </a>

                        <?php if (!empty($item['dropdown'])): ?>
                            <ul class="dropdown-menu my-dropdown" role="menu">
                                <?php foreach ($item['dropdown'] as $subitem): ?>
                                    <li role="none">
                                        <a class="my-dropdown__item"
                                           href="<?php echo htmlspecialchars($subitem['url']); ?>"
                                           role="menuitem">
                                            <?php echo htmlspecialchars($subitem['title']); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <ul class="phones hidden-xs"
                aria-label="<?php echo htmlspecialchars($config['navigation']['phones']['section_label']); ?>">
                <?php foreach ($config['navigation']['phones'] as $key => $phone): ?>
                    <?php if (is_array($phone)): ?>
                        <li class="phones__item">
                            <span class="sr-only"><?php echo htmlspecialchars($phone['desc']); ?></span>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <a class="phones__link" href="tel:<?php echo htmlspecialchars($phone['num']); ?>"
                               aria-label="<?php echo htmlspecialchars($phone['label']); ?>">
                                <span><?php echo htmlspecialchars($phone['display']); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>
</nav>