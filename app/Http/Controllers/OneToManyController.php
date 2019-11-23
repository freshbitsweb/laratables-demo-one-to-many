<?php

namespace App\Http\Controllers;

use App\User;
use Freshbitsweb\Laratables\Laratables;

class OneToManyController extends Controller
{
    /**
     * Show Table Header column
     *
     *
     * @return Illuminate\Http\Response
     **/
    public function index()
    {
        return view('oneToManyLaraTable');
    }

    /**
     * return data of the Many To Many Relationship datatables.
     *
     *
     * @return Jason
     **/
    public function oneToManyData()
    {
        return Laratables::recordsOf(User::class);
    }


}
