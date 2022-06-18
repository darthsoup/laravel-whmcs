<?php

namespace App\Http\Controllers;

use DarthSoup\Whmcs\WhmcsManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WhmcsController extends Controller
{
    private WhmcsManager $whmcsManager;

    public function __construct(WhmcsManager $whmcsManager)
    {
        $this->whmcsManager = $whmcsManager;
    }

    public function index(Request $request): JsonResponse
    {
        $result = $this->whmcsManager->client()->getClients();

        return response()->json($result);
    }

    public function createClient(Request $request): JsonResponse
    {
        $result = $this->whmcsManager->client()->addClient([
            'firstname' => 'Foo',
            'lastname' => 'Bar',
            'email' => 'foo@bar.com',
            'address1' => 'Street No. 1234',
            'city' => 'Berlin',
            'postcode' => '12345',
            'country' => 'DE',
            'state' => 'Berlin',
            'password2' => 'Abc1234$',
            'phonenumber' => '+49.1512 3456789',
            'clientip' => '192.168.0.1',
        ]);

        return response()->json($result);
    }
}
