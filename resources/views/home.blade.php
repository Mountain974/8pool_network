@extends('layouts.app')

@section('content')

    {{-- AJOUT D'UN TWEET :  --}}
    <main class="container card-header mb-5 pt-5 border border-5 rounded-circle w-50" style="background:rgba(190, 176, 176, 0.5)">
        <h1 class="text-center p-5 mt-5 text-white">AJOUTER UN TWEET</h1>
        <div class="row">

            <form class="col-4 mx-auto" action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="content">VOTRE TWEET</label>
                    <input required type="text" class="form-control" placeholder="J'adore la boule noire !" name="content"
                        id="content">
                </div>
                <div class="form-group mt-4">
                    <label for="tags">Vos Tags</label>
                    <input required type="text" class="form-control" placeholder="#BlackBall" name="tags"
                        id="tags">
                </div>

                <button type="submit" style="background-color:green" class="btn mt-3 text-white">Ajouter</button>
            </form>

        </div>
    </main>


    {{-- LES POSTS --}}

    <div class="container-fluid mt-5">
        <h1 class="card-title text-center mb-3 text-white">TWEETS 8-POOLISTIQUES</h1>
        @if ($posts->count() > 0)
            @foreach ($posts as $post)
                <div class="card mx-auto mb-3 p-2 ms-5 me-5 mb-5 text-white" style=" background:rgba(236, 236, 236, 0.5)">
                    <p class="fs-5"><a href='{{ route('users.show', $post->user) }}'>{{ $post->user->pseudo }}</a></p>
                    <img src="..." class="card-img-top" alt="...">
                    
                    <div class="row">
                            <div class="card-body ">
                                
                                <p class="card-text mb-2 text">{{ $post->content }} <div class="fs-5"> # {{ $post->tags }}</div></p>

                                <div class="row">
                                    <div class="col-4">
                                        @can('update', $post) {{-- conditionne l'affichage (admin ou non) --}}
                                            <a href="{{ route('posts.edit', $post) }}">       {{--  ici on fait un lien qui est par défaut en méthode get et dc renvoi les données de post --}}
                                                <button style="background-color:green" class="btn mt-3 text-white">modifier</button>
                                            </a>  
                                        @endcan
                                    </div>
                                    <div class="col-4">
                                            <form action="{{ route('posts.store', $post) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" style="background-color:green" class="btn mt-3 text-white">Commentez</button>
                                            </form>
                                    </div>
                                    <div class="col-4"> 
                                        @can('delete', $post)                       
                                            <form action="{{ route('posts.destroy', $post) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" style="background-color:green" class="btn mt-3 text-white">Supprimer</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>

                        {{-- COMMENTAIRES :  --}}
                        <div class="card mx-auto mb-3 w-50 mt-3 text-white" style="width: 18rem; background:rgba(190, 176, 176, 0.8)">
                            <h3 class="mx-auto mt-3 ";>Commentaires : </h3>
                            @foreach ($post->comments as $comment)
                                <p class="ms-2"><a href=''>{{ $comment->user->pseudo }} : </a></p>
                                <p class="ms-2">{{ $comment->content}}</p>
                                <p class="fw-bold text-end me-2">#{{ $comment->tags}}</p>
                            
                            @can('update', $comment)
                                <a href="{{ route('comments.edit' , $comment) }}">       {{--  ici on fait un lien qui est par défaut en méthode get et dc renvoi les données de comment --}}
                                    <button class="btn btn-primary mt-3 w-50 mx-auto mb-2">modifier</button> {{-- bouton pour modifier un commentaire existant --}}
                                </a>
                            @endcan
                            {{-- bouton suppression de commentaire  --}}
                            @can('delete', $comment)
                                <form action="{{ route('comments.destroy', $comment) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-primary">Supprimer</button>
                                </form>
                            @endcan
                            @endforeach
                        </div>

                        <form class="col-4 mx-auto" action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$post->id}}" name="post_id">
                            <div class="form-group">
                                <label for="content">Votre commentaire</label>
                                <input required type="text" class="form-control" placeholder="Saisir votre commentaire"
                                    name="content" id="content">
                            </div>
        
                            <div class="form-group mt-3">
                                <label for="tags">Tags</label>
                                <input required type="text" class="form-control" placeholder="#tags" name="tags"
                                    id="content">
                            </div>

                            <button type="submit" style="background-color:green" class="btn mt-3 text-white">Ajouter</button>  {{--bouton d'ajout de commentaire  --}}
                        </form>
                    </div>
                </div>
                </div>
            @endforeach
        @else
            <span>Aucun message ne correspond à votre recherche</span>
        @endif

        @if (Route::has('search'))
            
        @endif

    </div>

    <div class="container ">
        <div class ="w-25 ms-auto">
            {{ $posts->links() }} {{-- pour afficher les liens de pagination --}}
        </div>
    </div>
@endsection
