<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\Session;
use App\User;

class helperController extends Controller
{
    public $api;
    public $shop;


    public function getShopify()
    {
        // Create options for the API
// $options = new Options();
// $options->setVersion('2020-04');

// // Create the client and session
// $api = new BasicShopifyAPI($options);
// $api->setSession(new Session('theme-development1122.myshopify.com', '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'));

        $shop = User::where('email','shop@theme-development1122.myshopify.com')->first();
        $this->api = $shop->api();
       // dd($this->api);

// Now run your requests...

return $this->api;
//$result = $api->rest(...);
        // $this->api = new BasicShopifyAPI();
        // $this->api->setVersion('2019-04');
        // $this->api->setShop('brandit-co.myshopify.com');
        // $this->api->setApiKey('2f5de97c356e53567261e11b7afac465');
        // $this->api->setApiSecret('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');
        // $this->api->setApiPassword('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');
        // return $this->api;
    }

    public function getShopDomain($domain){
        $this->shop = User::where('name',$domain)->first();
        return $this->shop;
    }

}
