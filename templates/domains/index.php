<?php

$data = apiRequest('GET', '/v1/user/self/zone');
$data = json_decode($data, true);

$body = '
    <div class="flex justify-center mt-4">
        <div class="grid grid-cols-1 gap-2 w-2/4">
            <div class="flex justify-center p-2">
                <span class="text-gray-500 text-3xl font-semibold">List of all domains</span>
            </div>
';

foreach ($data['items'] as $item) {
    $body .= '
        <div class="flex justify-between p-2 bg-blue-300 rounded">
            <span class="self-center">' . $item['name'] . '</span>
            <a href="/domains/' . $item['name'] . '/dns" class="float-right focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-gray-500 hover:bg-gray-600 hover:shadow-lg">Manage DNS</a>
        </div>
    ';
}

$body .= '
        </div>
    </div>
';