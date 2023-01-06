@extends('settings.layout')
@section('heading')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Agences</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Parametres</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row my-3">
    <div class="input-group mb-3 pt-0 col-12">
        <form action="/agence/rechercher" method="post" class="d-flex col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            @csrf
            <input class="form-control" type="text" placeholder="Rechercher" name="key" value="{{ $key }}">
            <div class="input-group-append">
                <input type="submit" class="btn btn-success" value="Rechercher">
            </div>
        </form>
        
    </div>
</div>
    <div class="row grid px-3">
        <div class="card">
            <div class="card-body flex justify-between items-center">
                <div class="">
                    <span>Agence de l'utilisateur actuelle:</span> {{$agence->localisation}} | Tag: {{$agence->tag}}
                </div>
                <div class="">
                    <a href="/user/agence/changer" class="btn btn-dark">Changer</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="card col-xl-6 col-md-6 col-sm-12 col-12">
            <div class="card-header">
                Evolution du chiffre d'affaires
            </div>
            <div class="card-body">
                {!! $mychart->renderHtml() !!}
            </div>
        </div>
        <div class="card col-xl-6 col-md-6 col-sm-12 col-12">
            <div class="card-header">
                Evolution de contract de clients
            </div>
            <div class="card-body">
                {!! $cchart->renderHtml() !!}
            </div>
        </div>
        <div class="card col-xl-6 col-md-6 col-sm-12 col-12 py-3 ">
            {!! $chart_cv->container() !!}
        </div>
        <div class="card col-xl-6 col-md-6 col-sm-12 col-12 py-3 ">
            {!! $chart_s->container() !!}
        </div>
        <div class="card col-xl-6 col-md-6 col-sm-12 col-12 py-3">
            {!! $chart_ba->container() !!}
            <a href="" class="btn btn-dark">Voir tout</a>
        </div>
        <div class="card col-xl-6 col-md-6 col-sm-12 col-12 py-3">
            {!! $chart_bp->container() !!}
            <a href="" class="btn btn-dark">Voir tout</a>
        </div>
    </div>
    <div class=" grid gap-3">
        @foreach ($agences as $agence)
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-xl">
                        Agence de {{$agence->localisation}}
                    </div>
                    <div class="card-text my-3">
                        Tag: {{$agence->tag}}

                           <div class="flex justify-content-end">
                            <a href="/agence/{{$agence->id}}" class="btn btn-success mx-3">Détails</a>
                               </div> 
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('js')
{!! $mychart->renderChartJsLibrary() !!}
{!! $mychart->renderJs() !!}
{!! $cchart->renderJs() !!}
<script src="{{ $chart_cv->cdn() }}"></script>
{{ $chart_cv->script() }}
<script src="{{ $chart_s->cdn() }}"></script>
{{ $chart_s->script() }}
{{ $chart_ba->script() }}
{{ $chart_bp->script() }}
@endsection