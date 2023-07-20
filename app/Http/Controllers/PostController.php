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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        Post::create([
            'user_id'=> Auth::user()->id,       // la class Auth permet d'accéder au user connecté
            'content'=> $request -> content,
            'tags'=> $request -> tags,
            'image' => isset($request['image']) ? uploadImage($request['image']) : null,
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
        $this->authorize('update',$post);  // double sécurité pr vérifier que seul un admin ou l'auteur du post accède à cette page
        //$post = Post::findOrFail($post ->id);
        return view('posts/edit', [
            'post' => $post     // 'post' est le nom qu'aura $post ds la view que l'on va afficher
           ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Post $post)   // on utilise le request que avec la méthode post !
    {
        $this->authorize('update',$post);  // double sécurité pr vérifier que seul un admin ou l'auteur du post accède à cette page

        $request->validate([                                // on check que les saisies de l'utilisateur sont au bon format, sinon msg d'erreur automatique
            'content'=> ['required', 'string', 'max:500'],
            'tags'=> ['required', 'string', 'max:40'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

         $post->update([
             'content'=> $request -> content,
             'tags'=> $request -> tags,
             'image' => isset($request['image']) ? uploadImage($request['image']) : null,
            ]);
        return redirect()->route('home')->with('message', 'Le message a bien été modifié'); // on redirige bien vers la route home pour que s'affiche bien tous les posts sur home.blade
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);  // double sécurité pr vérifier que seul un admin ou l'auteur du post accède à cette page

        $post->delete();

        return redirect()->route('home')->with('message', 'Le message a bien été supprimé');
    }

/**
     * fonction qui permet la recherche, on réutilise la view home en lui injectnt seulement les posts répondant à la recherche
     */
    public function search(Request $request)
    {
        $request->validate([
        'search' => ['required', 'string', 'min:3', 'max:20'],
    ]);

    $posts = Post::where('content', 'LIKE', '%' . $request->search . '%')
                 ->orWhere('tags', 'LIKE', '%' . $request->search . '%')
                 ->latest()->paginate();

        return view('home', compact('posts'));
    }

}



