<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('home');    // sécurité pr que ce soit que les utilisateurs connectés qui accède à la home 
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function home()
    {
        $posts = Post::latest()->paginate(10);
       // récupérer les msg, les injecter ds la home et ds la home, on boucle avec un foreach pr les afficher. puis ajouter le formulaire de création pr ajouter un msg
       //  $posts = Post ::orderBy('created_at','desc')->take(10)->get(); (c'est une autre syntaxe)
        
       return view('home', [
        'posts' => $posts
       ]);
    }
}
