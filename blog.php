<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed'));

require_once $_SERVER['DOCUMENT_ROOT'] . '/core/blog_posts.php';
?>

<?php
$blog_config = [
    'section' => [
        'class' => 'wrap bg-light',
        'content_class' => 'content-wrap content-wrap--top'
    ],
    'header' => [
        'title' => 'Blog',
        'class' => 'header-short',
        'title_class' => 'header-short__text',
        'lines_class' => 'header-short__line'
    ],
    'items' => $items,
    'classes' => [
        'item_wrapper' => 'fleet-item',
        'image_wrapper' => 'fleet-item__figure',
        'image_class' => 'fleet-item__img',
        'content_wrapper' => 'fleet-item__body',
        'text_wrapper' => 'fleet-item__desc',
        'text_class' => 'fleet-item__desc-p',
        'button_group' => 'fleet-item__btn-group',
        'button_class' => 'btn-yellow btn-yellow--inv fleet-item__btn--db'
    ]
]; ?>
    <section>
        <div class="content-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="<?php echo $blog_config['header']['class'] ?>">
                            <h2 class="<?php echo $blog_config['header']['title_class'] ?>"><?php echo $blog_config['header']['title'] ?></h2>
                            <div class="<?php echo $blog_config['header']['lines_class'] ?>"></div>
                            <div class="<?php echo $blog_config['header']['lines_class'] ?>"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="<?php echo $blog_config['section']['class'] ?>">
            <div class="<?php echo $blog_config['section']['content_class'] ?>">
                <div class="container-fluid" id="fleet">
                    <div class="row">
                        <?php
                        $i = 1;
                        foreach ($blog_config['items'] as $item): ?>
                            <div class="<?php echo $blog_config['classes']['item_wrapper'] ?> <?php echo $i % 2 === 0 ? 'flex-reverse' : '' ?>">
                                <figure class="<?php echo $blog_config['classes']['image_wrapper'] ?>">
                                    <img class="<?php echo $blog_config['classes']['image_class'] ?>"
                                         src="<?php echo $item['image'] ?>"
                                         alt="<?php echo $item['title'] ?>">
                                </figure>
                                <div class="<?php echo $blog_config['classes']['content_wrapper'] ?>">
                                    <h2 class="fleet-item__title <?php echo $i % 2 === 0 ? 'right-skew' : ' left-skew'; ?>"><?php echo $item['title'] ?></h2>
                                    <div class="<?php echo $blog_config['classes']['text_wrapper'] ?>">
                                        <?php
                                        $text = strip_tags($item['content']);
                                        $words = preg_split('/\s+/', $text);
                                        $first20Words = implode(' ', array_slice($words, 0, 20));
                                        ?>
                                        <p class="<?php echo $blog_config['classes']['text_class'] ?>"><?php echo $first20Words ?></p>
                                    </div>
                                    <div class="<?php echo $blog_config['classes']['button_group'] ?>">
                                        <a href="<?php echo $item['link'] ?>"
                                           class="<?php echo $blog_config['classes']['button_class'] ?>">See More</a>
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
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';