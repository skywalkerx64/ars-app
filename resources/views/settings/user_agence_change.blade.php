@extends('settings.layout')
@section('heading')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Agence</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Charger les informations d'une autre agence</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="row grid px-3">
        <div class="card">
            <div class="card-body flex justify-between items-center">
                <div class="">
                    <span>Agence de l'utilisateur actuelle:</span> {{$agence->localisation}} | Tag: {{$agence->tag}}
                </div>
            </div>
        </div>
    </div>
    <div class="row grid gap-3">
        @foreach ($agences as $agence)
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-xl">
                        Agence de {{$agence->localisation}}
                    </div>
                    <div class="card-text my-3">
                        Tag:{{$agence->tag}}

                           <div class="flex justify-content-end">
                            <a href="/user/agence/changer/{{$agence->id}}" class="btn btn-success mx-3">charger</a>
                               </div> 
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
@endsection