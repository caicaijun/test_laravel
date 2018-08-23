<?php
namespace App\Http\Controllers\Home;

use App\User;
use Validator;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('home/index');
    }
}
