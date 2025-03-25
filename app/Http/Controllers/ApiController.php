<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function index()
    {
        $client = new Client([
            'verify' => false, // Desativa a verificação SSL
            // ou
            // 'verify' => '/caminho/para/conjunto/de/ca', // Especifica um conjunto de certificados de autoridade de certificação personalizado
        ]);

        $token = env('API_TOKEN');
        $response = $client->request('GET', 'https://brapi.dev/api/quote/list?token='.$token);
        $data = json_decode($response->getBody()->getContents());
        echo response()->json($data);
    }
}
