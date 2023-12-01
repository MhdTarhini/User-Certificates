<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use Illuminate\Http\Request;

class CertificatesController extends Controller
{
    function getCertificateTypes (){
        $certificate_types=Certificates::all();
        return response()->json([
            'status' => 'success',
            'data' => $certificate_types
        ]);
    }
}
