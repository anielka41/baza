<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class FileManagerController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */

    public function index(Request $request): Application|Factory|View
    {
        return view('components.filemanager');
    }

}