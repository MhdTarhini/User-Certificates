<?php

namespace App\Http\Controllers;

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
}
