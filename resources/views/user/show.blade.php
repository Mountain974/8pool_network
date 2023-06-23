@extends ('layouts.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <main class="container">
       
        <p class="fs-5 text-color-green">{{ $user->pseudo }}</p>

        @foreach ($user->posts as $post)
                <div class="card mx-auto mb-3 w-50" style="width: 18rem;">
                    <p><a href='{{ route('users.show', $post->user) }}'>{{ $post->user->pseudo }}</a></p>
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body ">
                        <p class="card-text mb-2">{{ $post->content }}</p>
                        <p class="card-text">{{ $post->tags }}</p>

                       <div class="row"> 
                            <div class="col-4">
                                <a href="{{ route('posts.edit', $post) }}">       {{--  ici on fait un lien qui est par défaut en méthode get et dc renvoi les données de post --}}
                                    <button style="background-color:green" class="btn mt-3 text-white">modifier</button>
                                </a> 
                            </div>
                            <div class="col-4">
                                <form action="{{ route('posts.store', $post) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" style="background-color:green" class="btn mt-3 text-white">Commentez</button>
                                </form> 
                            </div>
                            <div class="col-4">                       
                                <form action="{{ route('posts.destroy', $post) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" style="background-color:green" class="btn mt-3 text-white">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

    </main>
@endsection