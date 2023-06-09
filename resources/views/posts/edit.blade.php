@extends('layouts.app')

@section('content')

    {{-- AJOUT D'UN TWEET :  --}}
    <main class="container card-header mb-5">
        <h1 class="text-center">MODIFIER MON TWEET</h1>
        <div class="row">

            <form class="col-4 mx-auto" action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="content">TWEET</label>
                    <input required type="text" class="form-control" placeholder="J'adore la boule blanche !" name="content" value="{{ $post->content }}"
                        id="content">
                </div>
                <div class="form-group">
                    <label for="tags">Vos Tags</label>
                    <input required type="text" class="form-control" placeholder="#WhiteBall" name="tags" value="{{ $post->tags }}"
                        id="tags">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
            </form>

        </div>
    </main>

    
@endsection