<?php

$config = include("config.php");

define('SRC_FOLDER', '_articles/');
define('DST_FOLDER', 'docs/');

function create_dir_if_not($dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

function gen_page($src, $dst, $args) {
    ob_start();
    extract($args);
    include('_general/header.php');
    include($src);
    include('_general/footer.php');
    $content = ob_get_contents();
    ob_end_clean();
    file_put_contents($dst, $content);
}

function copy_public($src_path, $dest_path) {
    $public_assets = array_diff(scandir($src_path), array('..', '.'));
    foreach ($public_assets as $asset) {
        copy($src_path.$asset, $dest_path.$asset);
    }
}

function gen_articles($articles) {
    foreach ($articles as $a) {
        $src_folder = SRC_FOLDER . $a['folder'] . '/';
        $dst_folder = DST_FOLDER . $a['folder'] . '/';
        
        create_dir_if_not($dst_folder);

        if (is_dir($src_folder . 'public/')) {
            copy_public($src_folder.'public/', $dst_folder);
        }
    
        gen_page($src_folder . 'index.php',
                 $dst_folder . 'index.html',
                 [
                     'title' => $a['title'],
                 ]
        );
    }
}

create_dir_if_not(DST_FOLDER);
copy_public('_general/public/', DST_FOLDER);

gen_page('_general/index.php',
         DST_FOLDER.'/index.html',
         [
            'title' => $config['title'],
            'articles' => $config['articles']
         ]
);

gen_page('_general/404.php',
         DST_FOLDER.'/404.html',
         [
            'title' => '404 Page Not Found'
         ]
);

gen_articles($config['articles']);

