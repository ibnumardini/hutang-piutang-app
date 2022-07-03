<?php

spl_autoload_register(function ($class) {
    $dir_target = dir_target();

    foreach ($dir_target as $dir) {
        $class_target = sprintf("%s/%s/%s.php", __DIR__, $dir, $class);

        if (file_exists($class_target)) {
            require_once $class_target;
        }
    }
});

function dir_target(): array
{
    $banned = [".", ".."];

    $dir_target = [];

    $app = scandir(__DIR__, 1);
    foreach ($app as $content) {
        if (in_array($content, $banned) || is_file(sprintf("%s/%s", __DIR__, $content))) {
            continue;
        }

        $dir_target[] = $content;
    }

    return $dir_target;
}
