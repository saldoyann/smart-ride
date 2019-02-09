<?php

    include_once('./includes/layout.php');

    $explodedURL = explode('/', $_SERVER['REQUEST_URI']);
    $page = explode('?', $explodedURL[sizeof($explodedURL)-1])[0];

    switch ($page) {
        case '':
            $path = 'home';
            break;
        case 'comparateur':
            $path = 'comparator';
            break;
        case 'newsletter':
            $path = 'newsletter';
            break;
        case 'mentions-legales':
            $path = 'mentions-legales';
            break;
        default:
            $path = '404';
            break;
    }

    layout::show($path);