<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getUsersReport(){
        $users_report=User::Users()->get();

        return response()->json([
        'status' => 'success',
        'data' => $users_report,
    ]);
    }
    public function approveUser($userId){
        $user = User::find($userId);

        if(!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        $user->is_approved = 1;
        $user->save();

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
    public function addCertificateType($certificateType){
        $addCertificate = new Certificates;
        $addCertificate->name=$certificateType;
        $addCertificate->save();

        return response()->json([
            'status' => 'success',
            'data' => $addCertificate
        ]);
    }
    public function getCertificatesReport(){
        $certificateCounts = Certificates::withCount('userCertificates')->get();

        return response()->json([
            'status' => 'success',
            'data'=>$certificateCounts
        ]);
    }
}
