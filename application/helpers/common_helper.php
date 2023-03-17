<?php

function executeCurl($parameters) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $parameters['apiUrl'],
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "apikey: " . $parameters['apiKey']
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 300,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        return $result = array('error' => true, 'description' => $err, 'code' => 500);
    }
    return $result = array('error' => false, 'description' => $response, 'code' => 200);
}
