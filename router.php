<?php

$available_urls = [
    '/' => [
        'method' => 'GET',
        'source' => 'templates/index.php',
    ],
    '/domains' => [
        'method' => 'GET',
        'source' => 'templates/domains/index.php',
    ],
    '/domains/%/dns' => [
        'method' => 'GET',
        'source' => 'templates/dns/index.php',
    ],
    '/domains/%/dns/create' => [
        'method' => 'GET',
        'source' => 'templates/dns/create.php',
    ],
    '/domains/%/dns/create/save' => [
        'method' => 'POST',
        'source' => 'templates/dns/create_save.php',
    ],
    '/domains/%/dns/%/edit' => [
        'method' => 'GET',
        'source' => 'templates/dns/edit.php',
    ],
    '/domains/%/dns/%/edit/save' => [
        'method' => 'POST',
        'source' => 'templates/dns/edit_save.php',
    ],
    '/domains/%/dns/%/delete' => [
        'method' => 'POST',
        'source' => 'templates/dns/delete.php',
    ],
];

if (isset($available_urls[$_SERVER['REQUEST_URI']])) {
    if ($available_urls[$_SERVER['REQUEST_URI']]['method'] === $_SERVER['REQUEST_METHOD']) {
        require_once 'helpers.php';
        require_once $available_urls[$_SERVER['REQUEST_URI']]['source'];
    } else {
        require_once 'templates/errors/405.php';
    }
} else {
    $requested_url_segments = explode('/', $_SERVER['REQUEST_URI']);
    $requested_url_segment_count = count($requested_url_segments);

    $url_found = false;

    foreach ($available_urls as $available_url => $available_url_settings) {
        if (str_contains($available_url, '%')) {
            $url_matches = 0;
            $url_params = [];

            $current_url_segments = explode('/', $available_url);

            if ($requested_url_segment_count === count($current_url_segments)) {
                foreach ($current_url_segments as $index => $current_url_segment) {
                    if ($current_url_segment !== '%' && $current_url_segment !== $requested_url_segments[$index]) {
                        break;
                    }

                    if ($current_url_segment === '%') {
                        $url_params[] = $requested_url_segments[$index];
                    }

                    $url_matches++;
                }
            }

            if ($url_matches === $requested_url_segment_count) {
                $url_found = true;

                if ($available_url_settings['method'] === $_SERVER['REQUEST_METHOD']) {
                    require_once 'helpers.php';
                    require_once $available_url_settings['source'];

                    break;
                }

                require_once 'templates/errors/405.php';

                break;
            }
        }
    }

    if (!$url_found) {
        require_once 'templates/errors/404.php';
    }
}

require_once 'templates/html_structure.php';