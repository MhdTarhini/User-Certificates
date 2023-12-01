<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use App\Models\UserCertificateDetails;
use App\Models\UserCertificates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificatesController extends Controller
{
    function getCertificateTypes (){
        $certificate_types=Certificates::all();
        return response()->json([
            'status' => 'success',
            'data' => $certificate_types
        ]);
    }
    public function addCertificate(Request $request) {

    $request->validate([
        'name' => 'required|string|max:255',
        'certificateType' => 'required',
        'university' => 'required|string|max:255',
        'archievedDate' => 'required|date',
    ]);

    $user = Auth::user();

    $newUserCertificate = UserCertificates::create([
        'user_id' => $user->id,
        'certificate_id' => $request->certificateType,
    ]);

    $newUserCertificateDetails = UserCertificateDetails::create([
        'user_certificate_id' => $newUserCertificate->id,
        'name' => $request->name,
        'university' => $request->university,
        'date_achieved' => $request->archievedDate,
    ]);

    return response()->json([
        'status' => 'success',
    ]);

    }

    function getUserCertificate(){

        $userCertificatesAndDetails= UserCertificates::UserCertificates()->get();

        return response()->json([
        'status' => 'success',
        'data'=>$userCertificatesAndDetails
    ]);

    }
   function deleteUserCertificate($user_certificate_id)
   {
    $userCertificates = UserCertificates::find($user_certificate_id);

    if (!$userCertificates) {
        return response()->json([
            'status' => 'error',
            'message' => 'User certificate not found',
        ]);
    }

    $userCertificates->userCertificateDetails()->delete();

    $userCertificates->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'User certificate and details deleted successfully',
    ]);

    }

}
