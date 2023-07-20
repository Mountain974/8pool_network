@extends('layouts.app')

@section('content')

    <div class="container">
        
        <div class="col-6 text-white fs-5 mt-"><p style="font-size:110px; ">8 P<span class="cool">O</span>OL NETW<span class="cool">O</span>RK</p></div>
        <div class="row mt-5 pt-5">
            <div class="col-8"></div>   
            <div class="col-2 mt-5 pt-5">
                <a href="{{ route('register') }}">
                    <button class="btn btn-primary btn-lg me-0" style="background-color: green">inscription
                    </button>
                </a>
            </div>
            <div class="col-2 mt-5 pt-5">
                <a href="{{ route('login') }}">
                    <button class="btn btn-primary btn-lg" style="background-color: green">connexion
                    </button>
                </a>
            </div>
        </div>
    </div>

@endsection