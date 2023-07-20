@extends('layouts.app')

@section('content')

    {{-- AJOUT D'UN TWEET :  --}}
    <main class="container card-header mb-5">
        <h1 class="text-center">MODIFIER MON TWEET</h1>
        <div class="row">

            <form class="col-4 mx-auto" action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
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
                <div class="row mb-3 mt-3">
                    <label for="image" class="col-md-4 col-form-label text-md-end fs-5 w-50">{{ __('Modifier mon image') }}</label>
    
                    <div class="col-md-6">
                        <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="pseudo" autofocus>
    
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3"  style="background-color: green">Ajouter</button>
            </form>

        </div>
    </main>

    
@endsection