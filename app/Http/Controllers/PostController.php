<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([                                // on check que les saisies de l'utilisateur sont au bon format, sinon msg d'erreur automatique
            'content'=> ['required', 'string', 'max:500'],
            'tags'=> ['required', 'string', 'max:40'],
        ]);

        Post::create([
            'user_id'=> Auth::user()->id,       // la class Auth permet d'accéder au user connecté
            'content'=> $request -> content,
            'tags'=> $request -> tags,
        ]);
        return redirect()->route('home')->with('message', 'Le message a bien été ajouté');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $post = Post::findOrFail($post ->id);
        return view('posts/edit', [
            'post' => $post     // 'post' est le nom qu'aura $post ds la view que l'on va afficher
           ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Post $post)   // on utilise le request que avec la méthode post !
    {
        $request->validate([                                // on check que les saisies de l'utilisateur sont au bon format, sinon msg d'erreur automatique
            'content'=> ['required', 'string', 'max:500'],
            'tags'=> ['required', 'string', 'max:40'],
        ]);

         $post->update([
             'content'=> $request -> content,
             'tags'=> $request -> tags,
         ]);
        return redirect()->route('home')->with('message', 'Le message a bien été modifié'); // on redirige bien vers la route home pour que s'affiche bien tous les posts sur home.blade
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('home')->with('message', 'Le message a bien été supprimé');
    }
}
