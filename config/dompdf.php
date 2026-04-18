<?php

return [
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => [
        'font_dir' => storage_path('fonts/'),
        'font_cache' => storage_path('fonts/'),
        'temp_dir' => storage_path('app/'),
        'chroot' => realpath(base_path()),
        'allow_remote' => true,
        'enable_css_float' => true,
    ]
];