<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
defined('ABS_PATH') or exit('No direct script access allowed');

require_once $_SERVER['DOCUMENT_ROOT'] . '/core/blog_posts.php';

// Создаем папку для изображений, если ее нет
$images_dir = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/blog-images/';
if (!file_exists($images_dir)) {
    mkdir($images_dir, 0755, true);
}

// Функция для скачивания и сохранения изображений
function download_image($url, $item_id) {
    $images_dir = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/blog-images/';
    $extension = pathinfo($url, PATHINFO_EXTENSION);
    $filename = 'blog-image-' . $item_id . '.' . $extension;
    $filepath = $images_dir . $filename;

    // Скачиваем изображение
    $image_data = file_get_contents($url);
    if ($image_data === false) {
        return false;
    }

    // Сохраняем на сервер
    file_put_contents($filepath, $image_data);

    return '/assets/images/blog-images/' . $filename;
}

// Функция для создания страниц
function generate_blog_pages($items) {
    foreach ($items as $item) {
        // Скачиваем и сохраняем изображение
        $local_image_path = download_image($item['image'], $item['ID']);
        if (!$local_image_path) {
            $local_image_path = '/assets/images/blog-images/default-image.jpg'; // Фолбек изображение
        }

        // Получаем имя файла из ссылки
        $filename = basename($item['link']) . '.php';
        $filepath = $_SERVER['DOCUMENT_ROOT'] . '/blog/' . $filename;

        // Формируем HTML-код страницы
        $html = <<<HTML
<?php
require_once \$_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once \$_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
defined('ABS_PATH') or exit('No direct script access allowed');
?>
    <section>
        <div class="content-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="header-short">
                            <h2 class="header-short__text">{$item['title']}</h2>
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
                                <img class="service-item__img service-item__img--full" src="{$local_image_path}" alt="{$item['title']}">
                                <figcaption class="service-item__figcaption service-item__figcaption--full">
                                    <time class="btn btn-yellow service-item__btn--center" datetime="{$item['date']}">{$item['date']}</time>
                                </figcaption>
                            </figure>
                        </div>

                        <div class="wpp-content">
                            {$item['content']}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
require_once \$_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
?>
HTML;

        // Сохраняем файл
        file_put_contents($filepath, $html);
        echo "Создана страница: /blog/{$filename} с изображением {$local_image_path}<br>";
    }
}

// Вызываем функцию генерации страниц
generate_blog_pages($items);
echo "Все страницы успешно созданы!";
?>