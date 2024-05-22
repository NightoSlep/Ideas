<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $users = [
            [
                'name' => 'Vu',
                'age' => '22',
            ],
            [
                'name' => 'Vuu',
                'age' => '22',
            ],
            [
                'name' => 'Vinh',
                'age' => '2',
            ]
        ];
        return view('dashboard', ['userList' => $users]);
    }
}
