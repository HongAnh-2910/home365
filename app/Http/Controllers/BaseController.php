<?php

namespace App\Http\Controllers;

use App\Helpers\HomeHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BaseController extends Controller
{
    public function callPostApiBase($token = '', $url_api, $arrayPrams)
    {
        if ($token) {
            return Http::withToken($token)->asForm()->post(HomeHelper::DOMAIN . $url_api,
                $arrayPrams);
        } else {
            return Http::asForm()->post(HomeHelper::DOMAIN . $url_api,
                $arrayPrams);
        }

    }

    public function callApiBaseCustomer($token = '',$domainUrl ,$arrayPrams)
    {
        if ($token) {
            return Http::withToken($token)->asForm()->post($domainUrl,
                $arrayPrams);
        } else {
            return Http::asForm()->post($domainUrl,
                $arrayPrams);
        }
    }



}
