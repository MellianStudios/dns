<?php

$domain = $url_params[0];

$data = apiRequest('GET', '/v1/user/self/zone/' . $domain . '/record');
$data = json_decode($data, true);
$data['items'] = array_reverse($data['items']);

$body = '
    <div class="flex justify-center mt-4">
        <div class="grid grid-cols-1 gap-2 w-2/4">
            <div class="flex justify-center p-2">
                <span class="text-gray-500 text-3xl font-semibold">List of all DNS records for domain <span class="font-bold">' . $domain . '</span></span>
            </div>
            <div class="py-2">
                <a href="/domains/' . $domain . '/dns/create" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-gray-500 hover:bg-gray-600 hover:shadow-lg">Create new</a>
            </div>
';

foreach ($data['items'] as $item) {
    $body .= '
        <div class="flex justify-between p-2 bg-blue-300 rounded">
            <span class="self-center">' . $item['name'] . '</span>
            <div>
                <a href="/domains/' . $domain . '/dns/' . $item['id'] . '/edit" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-gray-500 hover:bg-gray-600 hover:shadow-lg">Edit</a>
                <button type="button" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg" onclick="deleteRecord(' . $item['id'] . ')">Delete</button>
            </div>
        </div>
    ';
}

$body .= '
        </div>
    </div>
    <div id="delete_form_overlay" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="hideOverlay(\'delete_form_overlay\')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Deleting DNS record <span id="dns_record" class="font-bold"></span> for domain <span
                                    class="font-bold">' . $domain . '</span>
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to delete this record ? It will be permanently removed. This
                                    action cannot be undone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <div class="ml-2">
                        <form id="delete_form" class="inline" method="POST" action="/domains/' . $domain . '/dns/dns_record_id/delete">
                            <input type="submit" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg" value="Delete">
                        </form>
                    </div>
                    <button type="button" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-purple-500 hover:bg-purple-600 hover:shadow-lg" onclick="hideOverlay(\'delete_form_overlay\')">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
';