@extends('layouts.app')
@section('title')
8 Pool Network Accueil
@endsection
@section('content')

    {{-- AJOUT D'UN TWEET :  --}}
    <main class="container card-header mt-3 mb-5 border border-5 rounded-circle w-50 pb-5"
        style="background:rgba(190, 176, 176, 0.5)">
        <h1 class="text-center p-5 mt-3 text-white">AJOUTER UN TWEET</h1>
        <div class="row">

            <form class="col-4 mx-auto" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="content">VOTRE TWEET</label>
                    <input required type="text" class="form-control" placeholder="J'adore la boule noire !"
                        name="content" id="content">
                </div>
                <div class="form-group mt-4">
                    <label for="tags">Vos Tags</label>
                    <input required type="text" class="form-control" placeholder="#BlackBall" name="tags"
                        id="tags">
                </div>
                <div class="mb-3 mt-3">
                    <label for="image" class="col-md-4 col-form-label">{{ __('Image') }}</label>

                    <div class="col-md-6">
                        <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" style="width:8.3rem"
                            name="image" value="{{ old('image') }}" required autocomplete="pseudo" autofocus>

                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" style="background-color:green" class="btn mt-3 mb-5 text-white">Ajouter</button>
            </form>

        </div>
    </main>


    {{-- LES POSTS --}}

    <div class="container-fluid mt-5">
        <h1 class="card-title text-center mb-3 text-white">TWEETS 8-POOLISTIQUES</h1>
        @if ($posts->count() > 0)
            @foreach ($posts as $post)
                <div class="card text-center mb-3 p-2 mb-5 w-75 mx-auto"
                    style=" background:rgba(236, 236, 236, 0.5); color:green">
                    <div class="row">
                        <div class="col-3">
                            <div class="card  mx-auto" style=" width:25vw ;background:rgba(55, 8, 226, 0.603)">
                                <a href='{{ route('users.show', $post->user) }}' class=" mt-2"
                                    style="font-size:25px; color:white">{{ $post->user->pseudo }}</a>
                                @if ($post->user->image)
                                    <img src="{{ asset('images/' . $post->user->image) }} " class="m-1 rounded-circle mx-auto"
                                        style="width: 6vw; height:6vw" alt="imageUtilisateur">
                                @else
                                    <img src="{{ asset('images/user.jpg') }} " class="m-1 rounded-circle"
                                        style="width: 6vw; height:6vw" alt="imageUtilisateur">
                                @endif
                            </div>
                        </div>
                        <div class="col-6 text-center mt-4">
                            @if ($post->image)
                                <img src="{{ asset("images/$post->image") }}" style="width: auto; height:10vw" alt="imageUtilisateur">
                            @endif
                        </div>
                        <div class="col-3">
                            <div class="col">
                                <div class="col-4">
                                    @can('update', $post)
                                        {{-- conditionne l'affichage (admin ou non) --}}
                                        <a href="{{ route('posts.edit', $post) }}"> {{--  ici on fait un lien qui est par défaut en méthode get et dc renvoi les données de post --}}
                                            <button style="background-color:green" class="btn mt-1 text-white">Modifier</button>
                                        </a>
                                    @endcan
                                </div>
                                <div class="col-4">

                                </div>
                                <div class="col-4">
                                    @can('delete', $post)
                                        <form action="{{ route('posts.destroy', $post) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" style="background-color:green"
                                                class="btn mt-1 text-white">Supprimer</button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-body ">

                            <p class="card-text mb-2 text-start" style="font-size:30px;font-weight:bold; color:white ">{{ $post->content }}
                            <div class="text-end me-5" style="font-size:30px;font-weight:800; color:white "> #
                                {{ $post->tags }}</div>
                            </p>



                            {{-- COMMENTAIRES :  --}}
                            <div class="card mx-auto mb-3 w-75 mt-3 text-white"
                                style="width: 18rem; background:rgba(190, 176, 176, 0.8)">
                                <h3 class="text-start mt-3 ">Commentaires : </h3>
                                @foreach ($post->comments as $comment)
                                    <div class="row">
                                        <div class="col-8">
                                            <p class="fs-5 ms-2 text-start"><a href=''
                                                    style="font-size:20px; color:rgba(55, 8, 226, 0.603)">{{ $comment->user->pseudo }}
                                                    : </a></p>
                                            <p class="ms-2">{{ $comment->content }}</p>
                                            <p class="fw-bold text-end me-2">#{{ $comment->tags }}</p>
                                        </div>
                                        <div class="col-4 text-center mt-4">
                                            @if ($comment->image)
                                                <img src="{{ asset("images/$comment->image") }}"
                                                    style="width: 10vw; height:10vw" alt="imageUtilisateur">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row m-3">
                                        <div class="col-3">
                                            @can('update', $comment)
                                                <a href="{{ route('comments.edit', $comment) }}"> {{--  ici on fait un lien qui est par défaut en méthode get et dc renvoi les données de comment --}}
                                                    <button class="btn btn-primary"
                                                        style="background-color:rgba(55, 8, 226, 0.603)">modifier</button>
                                                    {{-- bouton pour modifier un commentaire existant --}}
                                                </a>
                                            @endcan
                                        </div>
                                        <div class="col-3">
                                            {{-- bouton suppression de commentaire  --}}
                                            @can('delete', $comment)
                                                <form action="{{ route('comments.destroy', $comment) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-primary"
                                                        style="background-color:rgba(55, 8, 226, 0.603)">Supprimer</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Ajouter un commentaire via un formulaire --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" style="font-weight:bolder; font-size:25px"
                                    data-bs-toggle="dropdown" href="#" role="button"
                                    aria-expanded="false">Ajouter un commentaire</a>
                                <ul class="dropdown-menu">

                                    <form class="col-4 mx-auto" action="{{ route('comments.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $post->id }}" name="post_id">
                                        <div class="form-group">
                                            <label for="content">Votre commentaire</label>
                                            <input required type="text" class="form-control"
                                                placeholder="Saisir votre commentaire" name="content" id="content">
                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="tags">Tags</label>
                                            <input required type="text" class="form-control" placeholder="#tags"
                                                name="tags" id="content">
                                        </div>

                                        <div class="row mb-3 mt-3">
                                            <label for="image"
                                                class="col-md-4 col-form-label text-md-start w-100">{{ __('image') }}</label>

                                            <div>
                                                <input id="image" type="file"
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    name="image" value="{{ old('image') }}" required
                                                    autocomplete="pseudo" autofocus>

                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <button type="submit" style="background-color:green"
                                            class="btn mt-3 text-white">Ajouter</button> {{-- bouton d'ajout de commentaire  --}}
                                    </form>
                                </ul>
                            </li>
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
        <div class="w-25 ms-auto">
            {{ $posts->links() }} {{-- pour afficher les liens de pagination --}}
        </div>
    </div>
@endsection
