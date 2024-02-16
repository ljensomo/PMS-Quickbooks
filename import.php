<?php

function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

$data = array('data' => array(
    'particular_description' => '405 · Base Rent',
    'type' => 'Deposit',
    'date' => '10/03/2022',
    'number' => '',
    'tenant_name' => 'Test Tenant',
    'memo' => 'OCT Payment CK#',
    'class' => '1416-1417 Kelland Drive',
    'clr' => '',
    'split' => '100b · 1st Century Bank - xxxxxx8052',
    'debit' => '',
    'credit' => '2,869.92',
    'balance' => '2,869.92'

));

$response = CallAPI('GET', 'https://hrpropertynetwork.com/testImport', $data);
var_dump($response);