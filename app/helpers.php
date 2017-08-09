<?php
function isUrl($str){
    $pattern = '/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/';
    return preg_match($pattern, $str);
} 

function checkOnline($domain) {
    $domain = parse_url($domain, PHP_URL_HOST);
    $curlInit = curl_init($domain);
    curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
    curl_setopt($curlInit,CURLOPT_HEADER,true);
    curl_setopt($curlInit,CURLOPT_NOBODY,true);
    curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($curlInit);
    curl_close($curlInit);
    if ($response) return true;
    return false;
}

function checkPort($domain, $port){
    if($fs = @fsockopen($domain, $port, $err, $err_string, 1)){
        fclose($fs);
        return true;
    }
    else return false;
}

function checkPortArray($domain, $portArray){
    $domain = parse_url($domain, PHP_URL_HOST);
    $openPort = array();
    foreach ($portArray as $port){
        if (checkPort($domain, $port))
            array_push($openPort, $port);
    }
    if (count($openPort) == 0)
        return null;
    else
        return join(', ', $openPort);
}