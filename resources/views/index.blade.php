@extends('layouts.app')

@section('content')

    <div class="container">
        <a href="{{ route('register') }}">
            <button class="btn btn-primary">inscription
            </button>
        </a>

        <a href="{{ route('login') }}">
            <button class="btn btn-primary">connexion
            </button>
        </a>
    </div>

@endsection