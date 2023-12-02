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
        'message' => $users_report,
    ]);
    }
}
