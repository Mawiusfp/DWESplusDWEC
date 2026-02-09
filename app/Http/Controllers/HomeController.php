<?php
namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
class HomeController extends Controller
{
    public function index()
    {
        return "<h1>Has iniciado sesion</h1><h2>Creo, no se</h2><h3>Deberia vamos</h3><p>BAstante seguro</p>";
    }

}
