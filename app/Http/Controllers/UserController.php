<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('posts');
        return view('user/show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user/edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'pseudo' => 'required|max:40',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // on modifie les infos de l'utilisateur
        $user->pseudo = $request->input('pseudo');
        $user->image = isset($request['image']) ? uploadImage($request['image']) : null;

        // on sauvegarde les changements en bdd
        $user->save();

        // on redirige sur la page précédente
        return redirect()->route('home')->with('message','Le compte a bien été modifié');
    }

    /**
     * DESTROY : pour supprimer l'utilisateur
     */
    public function destroy(User $user)
    {
        if (Auth::user()->id == $user->id) {
            $user->delete();
            return redirect()->route('index')->with('message','Le compte a bien été supprimé');
        } else {
            return redirect()->back()->withErrors(['erreur' => 'suppression du compte impossible']);
        }
    }
}

?>