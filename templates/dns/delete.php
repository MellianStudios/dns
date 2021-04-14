<?php

$domain = $url_params[0];
$dns_record_id = $url_params[1];

apiRequest('DELETE', '/v1/user/self/zone/' . $domain . '/record/' . $dns_record_id);

redirect('/domains/' . $domain . '/dns');