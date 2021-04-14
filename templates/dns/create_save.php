<?php

$domain = $url_params[0];

$data = [
    'type' => $_POST['type'],
    'name' => $_POST['name'],
    'content' => $_POST['content'],
    'ttl' => (int)$_POST['ttl'],
];

if ($_POST['type'] === 'MX') {
    $data['prio'] = (int)$_POST['priority'];
}

if ($_POST['type'] === 'SRV') {
    $data['prio'] = (int)$_POST['priority'];
    $data['port'] = (int)$_POST['port'];
    $data['weight'] = (int)$_POST['weight'];
}

apiRequest('POST', '/v1/user/self/zone/' . $domain . '/record', $data);

redirect('/domains/' . $domain . '/dns');