<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/blog_posts.php';

// Создаем папку для миниатюр, если ее нет
$thumb_dir = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/blog-images/thumb/';
if (!file_exists($thumb_dir)) {
    mkdir($thumb_dir, 0755, true);
}

// Функция для скачивания и сохранения изображений
function download_and_replace_images(&$items, $thumb_dir) {
    foreach ($items as &$item) {
        // Получаем URL оригинального изображения
        $image_url = $item['image'];

        // Генерируем новое имя файла
        $file_extension = pathinfo($image_url, PATHINFO_EXTENSION);
        $new_filename = 'thumb-' . $item['ID'] . '.' . $file_extension;
        $local_path = $thumb_dir . $new_filename;

        // Скачиваем изображение
        try {
            $image_data = file_get_contents($image_url);
            if ($image_data !== false) {
                file_put_contents($local_path, $image_data);

                // Обновляем путь в массиве
                $item['image'] = '/assets/images/blog-images/thumb/' . $new_filename;
                echo "Изображение для {$item['title']} успешно скачано и заменено.\n";
            } else {
                echo "Ошибка при скачивании изображения: {$image_url}\n";
            }
        } catch (Exception $e) {
            echo "Ошибка при обработке изображения: " . $e->getMessage() . "\n";
        }
    }
}

// Вызываем функцию для обработки изображений
download_and_replace_images($items, $thumb_dir);

// Обновляем исходный файл с новыми путями
$file_content = "<?php\n\$items = " . var_export($items, true) . ";\n?>";
file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/core/blog_posts.php', $file_content);

echo "Все изображения успешно обработаны и пути обновлены в файле blog_posts.php\n";
?>