<?php

function apiRequest($method, $path, $data = null)
{
    $datetime = new DateTime('Z');
    $signature = hash_hmac('sha1', $method . ' ' . $path . ' ' . $datetime->getTimestamp(), 'e500e0ef5f8533670176aaa3088f0b6a5bad3e56');

    $headers = [
        'Date: ' . $datetime->format('Ymd\THis\Z'),
    ];

    $curl = curl_init('https://rest.websupport.sk' . $path);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    if ($method === 'POST') {
        $headers[] = 'Content-Type: application/json';

        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
    } else if ($method === 'PUT') {
        $headers[] = 'Content-Type: application/json';

        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
    } else if ($method === 'DELETE') {
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
    }

    curl_setopt($curl, CURLOPT_USERPWD, '547c2939-270d-4698-8eb6-8a3d6e95cdfb:' . $signature);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}

function redirect($path)
{
    if (!str_contains($_SERVER['HTTP_HOST'], 'http://')) {
        $host = 'http://' . $_SERVER['HTTP_HOST'];
    }

    if (!str_contains($_SERVER['HTTP_HOST'], 'https://')) {
        $host = 'https://' . $_SERVER['HTTP_HOST'];
    }

    header('Location:' . $host . $path);

    die;
}