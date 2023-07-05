<?php

namespace App\Http\Controllers;

use App\Models\DriversProfile;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class mainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function requestIndex($id)
    {
        $profile = DriversProfile::find($id);
        if ($profile != null) {
            $profile->code = null;
        }
        return view('createrequest', ['profile' => $profile]);
    }
}
