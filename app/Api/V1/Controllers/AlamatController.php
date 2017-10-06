<?php

namespace App\Api\V1\Controllers;

use App\Alamat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlamatController extends Controller
{

    public function getAlamat()
    {
        $alamat = (new Alamat())->getAlamat();

        return response()->json([
                  'status' => 'OK',
                  'message' => 'Alamat successfully retrieved',
                  'result' => $alamat
              ], 200);
    }

}
