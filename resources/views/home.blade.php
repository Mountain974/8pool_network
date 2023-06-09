@extends('layouts.app')

@section('content')

    {{-- AJOUT D'UN TWEET :  --}}
    <main class="container card-header mb-5">
        <h1 class="text-center">AJOUTER UN TWEET</h1>
        <div class="row">

            <form class="col-4 mx-auto" action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="content">VOTRE TWEET</label>
                    <input required type="text" class="form-control" placeholder="J'adore la boule noire !" name="content"
                        id="content">
                </div>
                <div class="form-group">
                    <label for="tags">Vos Tags</label>
                    <input required type="text" class="form-control" placeholder="#BlackBall" name="tags"
                        id="tags">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
            </form>

        </div>
    </main>


    {{-- LES POSTS --}}

    <div class="container mt-5">
        <h1 class="card-title text-center mb-3">TWEETS 8-POOLISTIQUES</h1>
        @if ($posts->count() > 0)
            @foreach ($posts as $post)
                <div class="card mx-auto mb-3 w-50" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body ">
                        <p class="card-text mb-2">{{ $post->content }}</p>
                        <p class="card-text">{{ $post->tags }}</p>

                        <a href="{{ route('posts.edit', $post) }}">       {{--  ici on fait un lien qui est par défaut en méthode get et dc renvoi les données de post --}}
                            <button class="btn btn-info">modifier</button>
                        </a>  

                        <form action="{{ route('posts.create', $post) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-primary">ommentez</button>
                        </form>                        
                        <form action="{{ route('posts.destroy', $post) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-primary">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <span>Aucun message en base de données</span>
        @endif
    </div>
    <div class="container ">

        <div class ="w-25 ms-auto">
            {{ $posts->links() }} {{-- pour afficher les liens de pagination --}}
        </div>

    </div>
@endsection
