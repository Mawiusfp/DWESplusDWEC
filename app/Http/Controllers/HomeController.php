<?php
namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
class HomeController extends Controller
{
    public function index()
    {
        return view('nav.landing_page');
    }

}

