<?php

namespace App\Http\Controllers;

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
        $this->middleware('guest')->only('index');   // sécurité pr que ce soit que les utilisateurs guest qui accède à l'index 
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
       
        $posts->load('user','comments.user'); // eager loading -> permet d'ajouter à chaque post une propriété 
                                              // user, comments et le user associé au comment (dc pas besoin de l'injecter ds le return view), c'est grâce aux cardinalités ds le model Post et Comment (pr le user de chaques comment)

       return view('home', [
        'posts' => $posts,
       ]);
    }
}
