<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Client\Pool;

use GuzzleHttp\Promise\Utils;

class TestController extends Controller
{
    public function ebay_GetSessionIDRequest()
    {
        $url = 'https://api.ebay.com/ws/api.dll';

        $xml = '<?xml version="1.0" encoding="utf-8"?>
        <GetSessionIDRequest xmlns="urn:ebay:apis:eBLBaseComponents">
            <RuName>Retro_Led-RetroLed-RetroF-losqmvs</RuName>
        </GetSessionIDRequest>';

        $response = Http::withHeaders([
            'Content-Type' => 'text/xml; charset=UTF8',
            'X-EBAY-API-APP-NAME' => 'RetroLed-RetroFir-PRD-c7cb04767-5bd78867',
            'X-EBAY-API-DEV-NAME' => 'babf63a9-a96a-4ff7-a1a6-b5f16cddd2cd',
            'X-EBAY-API-CERT-NAME' => 'PRD-7cb047673ed3-f653-4fe6-9ea7-d4cb',
            'X-EBAY-API-CALL-NAME' => 'GetSessionID',
            'X-EBAY-API-SITEID' => 3,
            'X-EBAY-API-COMPATIBILITY-LEVEL' => 1227,
        ])->send("GET", $url, [
            "body" => $xml
        ]);

        $response_xml = simplexml_load_string($response->getBody(),'SimpleXMLElement', LIBXML_NOCDATA);
        $response_json = json_encode($response_xml);
        return $response_json;
    }

    public function ebay_FetchTokenRequest(Request $request)
    {
        $url = 'https://api.ebay.com/ws/api.dll';

        $xml = '<?xml version="1.0" encoding="utf-8"?>
        <FetchTokenRequest xmlns="urn:ebay:apis:eBLBaseComponents">
        <SessionID>'.$request->session_id.'</SessionID>
        </FetchTokenRequest>';

        $response = Http::withHeaders([
            'Content-Type' => 'text/xml; charset=UTF8',
            'X-EBAY-API-APP-NAME' => 'RetroLed-RetroFir-PRD-c7cb04767-5bd78867',
            'X-EBAY-API-DEV-NAME' => 'babf63a9-a96a-4ff7-a1a6-b5f16cddd2cd',
            'X-EBAY-API-CERT-NAME' => 'PRD-7cb047673ed3-f653-4fe6-9ea7-d4cb',
            'X-EBAY-API-CALL-NAME' => 'FetchToken',
            'X-EBAY-API-SITEID' => 3,
            'X-EBAY-API-COMPATIBILITY-LEVEL' => 1227,
        ])->send("GET", $url, [
            "body" => $xml
        ]);

        $response_xml = simplexml_load_string($response->getBody(),'SimpleXMLElement', LIBXML_NOCDATA);
        $response_json = json_encode($response_xml);
        return $response_json;
    }

    public function ebay_GetTokenStatus(Request $request)
    {
        // v^1.1#i^1#p^3#r^1#I^3#f^0#t^Ul4xMF83OkIyOENCOTYxQ0MzOERFRkI2Rjk2Qzc4MzVEOTZGRTVDXzJfMSNFXjI2MA==

        $url = 'https://api.ebay.com/ws/api.dll';

        $xml = '<?xml version="1.0" encoding="utf-8"?>
        <GetTokenStatusRequest xmlns="urn:ebay:apis:eBLBaseComponents">
            <RequesterCredentials>
                <eBayAuthToken>'.$request->auth_token.'</eBayAuthToken>
            </RequesterCredentials>
        </GetTokenStatusRequest>';

        $response = Http::withHeaders([
            'Content-Type' => 'text/xml; charset=UTF8',
            'X-EBAY-API-APP-NAME' => 'RetroLed-RetroFir-PRD-c7cb04767-5bd78867',
            'X-EBAY-API-DEV-NAME' => 'babf63a9-a96a-4ff7-a1a6-b5f16cddd2cd',
            'X-EBAY-API-CERT-NAME' => 'PRD-7cb047673ed3-f653-4fe6-9ea7-d4cb',
            'X-EBAY-API-CALL-NAME' => 'GetTokenStatus',
            'X-EBAY-API-SITEID' => 3,
            'X-EBAY-API-COMPATIBILITY-LEVEL' => 1227,
        ])->send("GET", $url, [
            "body" => $xml
        ]);

        $response_xml = simplexml_load_string($response->getBody(),'SimpleXMLElement', LIBXML_NOCDATA);
        $response_json = json_encode($response_xml);
        return $response_json;
    }

    public function ebay_GetOrders()
    {
        // $url = 'https://reqres.in/api/users/';
        // $nbPages = 30;
        // $promises = [];

        // for ($page=0 ; $page < $nbPages ; $page++) {
        //     // $promises[] = Http::async()->get($url . "?page={$page}");
        //     $promises[] = Http::async()->send("GET", $url . "?page={$page}" , []);
        // }

        // // Wait for the responses to be received
        // $responses = Utils::unwrap($promises);
        // return $responses;

        // $response = Http::send("GET", $url . "?page=1" , []);
        // return $response;

        // $url = 'https://reqres.in/api/users/';
        // $responses = Http::pool(fn (Pool $pool) => [
        //     $pool->get($url.'1'),
        //     $pool->get($url.'2'),
        // ]);
        // return $responses[1];

        $url = 'https://reqres.in/api/users/';
        $nbPages = 11;
        $promises = [];

        for ($page=1 ; $page < $nbPages ; $page++) {
            $promises[] = Http::async()->get($url . "{$page}");
        }

        // Wait for the responses to be received
        $responses_array = Utils::unwrap($promises);
        return $responses_array;
    }
}
