<?php

$domain = $url_params[0];

$body = '
    <div class="grid justify-items-stretch">
        <h1 class="mb-4 text-gray-500 font-semibold text-3xl justify-self-center">New DNS record for domain <span class="font-bold">' . $domain . '</span></h1>
        <form class="w-1/2 justify-self-center grid grid-cols-1 p-2 bg-white shadow rounded" method="POST" action="/domains/' . $domain . '/dns/create/save">
            <div class="p-1">
                <label for="type" class="text-lg block">Type</label>
                <select name="type" id="type" class="w-full border py-2 px-3 text-grey-darkest md:mr-2" onchange="adjustForm(this.value)" required>
                    <option value=""></option>
                    <option value="A">A</option>
                    <option value="AAAA">AAAA</option>
                    <option value="MX">MX</option>
                    <option value="ANAME">ANAME</option>
                    <option value="CNAME">CNAME</option>
                    <option value="NS">NS</option>
                    <option value="TXT">TXT</option>
                    <option value="SRV">SRV</option>
                </select>
            </div>
            <div class="p-1">
                <label for="name" class="text-lg">Name</label>
                <input type="text" id="name" name="name" class="w-full border py-2 px-3 text-grey-darkest md:mr-2" required>
            </div>
            <div class="p-1">
                <label for="content" class="text-lg">Content</label>
                <input type="text" id="content" name="content" class="w-full border py-2 px-3 text-grey-darkest md:mr-2" required>
            </div>
            <div id="priority_wrapper" class="p-1 hidden">
                <label for="priority" class="text-lg">Priority</label>
                <input type="number" id="priority" name="priority" class="w-full border py-2 px-3 text-grey-darkest md:mr-2">
            </div>
            <div id="port_wrapper" class="p-1 hidden">
                <label for="port" class="text-lg">Port</label>
                <input type="number" id="port" name="port" class="w-full border py-2 px-3 text-grey-darkest md:mr-2">
            </div>
            <div id="weight_wrapper" class="p-1 hidden">
                <label for="wight" class="text-lg">Weight</label>
                <input type="number" id="wight" name="wight" class="w-full border py-2 px-3 text-grey-darkest md:mr-2">
            </div>
            <div class="p-1">
                <label for="ttl" class="text-lg">TTL</label>
                <input type="number" id="ttl" name="ttl" class="w-full border py-2 px-3 text-grey-darkest md:mr-2" required>
            </div>
            <div class="w-1/7 justify-self-center mt-4">
                <button class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg">Save</button>
            </div>
        </form>
    </div>
';