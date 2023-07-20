@extends ('layouts.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <main class="container text-white" style="background-image : url(images/15.jpg);background-repeat:no-repeat; background-attachment:fixed ; background-size:cover; height:100vh ; background-position: center">
        <h1 class="mx-auto" style="font-size:70px" >Mon compte</h1>

        <h3 class="pb-3 mt-5">Modifier mes informations </h3>
        <div class="row">

            <form class="w-50" action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="pseudo">Nouveau pseudo</label>
                    <input required type="text" class="form-control" placeholder="modifier" name="pseudo" value="{{ $user->pseudo }}" id="pseudo">
                </div>

                <div class="form-group mt-4">
                    <label for="image">Nouvelle image</label>
                    <input required type="file" class="form-control" placeholder="modifier" name="image" value="{{ $user->image }}" id="image">
                </div>

                <button type="submit" class="btn btn-primary mt-3 mb-5" style="background-color: green">Valider</button>
            </form>

            <form action="{{route('users.destroy', $user)}}" method="post">
                @csrf 
                @method("delete")
                <button type="submit" class="btn btn-danger mt-5">supprimer le compte</button>
            </form>
        </div>
    </main>
@endsection