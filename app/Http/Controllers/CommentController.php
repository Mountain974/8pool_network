<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

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

        Comment::create([
            'user_id'=> Auth::user()->id,       // la class Auth permet d'accéder au user connecté
            'content'=> $request -> content,
            'tags'=> $request -> tags,
            'post_id'=> $request ->post_id,
            'image' => isset($request['image']) ? uploadImage($request['image']) : null,
        ]);
        return redirect()->route('home')->with('message', 'Le commentaire a bien été ajouté');
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
    public function edit(Comment $comment)
    {
        $comment = Comment::findOrFail($comment ->id);
        return view('comments/edit', [
            'comment' => $comment     // 'comment' est le nom qu'aura $post ds la view que l'on va afficher
           ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Comment $comment)
    {
        $request->validate([                                // on check que les saisies de l'utilisateur sont au bon format, sinon msg d'erreur automatique
            'content'=> ['required', 'string', 'max:500'],
            'tags'=> ['required', 'string', 'max:40'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

         $comment->update([
             'content'=> $request -> content,
             'tags'=> $request -> tags,
             'image' => isset($request['image']) ? uploadImage($request['image']) : null,
            ]);
        return redirect()->route('home')->with('message', 'Le commentaire a bien été modifié'); // on redirige bien vers la route home pour que s'affiche bien tous les posts sur home.blade
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('home')->with('message', 'Le commentaire a bien été supprimé');
    }
}
