<?php

namespace App\Http\Controllers;

use Mews\Captcha\Captcha;
use Illuminate\Http\Response;

class CaptchaController extends Controller
{
    public function getCaptcha(Captcha $captcha)
    {
        return $captcha->create('default');
    }
}
