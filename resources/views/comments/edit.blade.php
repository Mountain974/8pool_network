@extends ('layouts.app')

@section('title')
    8 Pool Network - Modifier un commentaire
@endsection

@section('content')
    <main class="container text-white">

        <h1>Modifier mon commentaire</h1>

        <form class="col-5 " action="{{ route('comments.update' , $comment) }}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="content" class="fs-5 mt-5">Nouveau commentaire</label>
                <input required type="text" class="form-control" placeholder="Saisir votre commentaire" name="content"
                    value="{{ $comment->content }}" id="content">
            </div>

            <div class="form-group mt-3">
                <label for="tags" class="fs-5">Nouveaux tags</label>
                <input required type="text" class="form-control" placeholder="modifier" name="tags"
                    value="{{ $comment->tags }}" id="tags">
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

            <button type="submit" class="btn btn-primary mt-3" style="background-color: green">Valider mon commentaire</button>

        </form>

    </main>
@endsection