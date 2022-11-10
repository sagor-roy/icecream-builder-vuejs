<?php

namespace App\Http\Controllers;

use App\Traits\ResponseTraits;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResponseTraits;
    public function login()
    {
        try {
            return $this->responseError('Sorry!! You are unauthorized user');
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }
}
