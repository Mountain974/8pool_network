@extends ('layouts.app')

@section('title')
    Modifier un commentaire
@endsection

@section('content')
    <main class="container">

        <h1>Mon commentaire</h1>

        <h3 class="pb-3 text-center">Modifier un commentaire</h3>

        <form class="col-4 mx-auto" action="{{ route('comments.update' , $comment) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="content">Nouveau commentaire</label>
                <input required type="text" class="form-control" placeholder="Saisir votre commentaire" name="content"
                    value="{{ $comment->content }}" id="content">
            </div>

            <div class="form-group mt-3">
                <label for="tags">Nouveaux tags</label>
                <input required type="text" class="form-control" placeholder="modifier" name="tags"
                    value="{{ $comment->tags }}" id="tags">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Valider mon commentaire</button>

        </form>

    </main>
@endsection