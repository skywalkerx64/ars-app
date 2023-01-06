@extends('administration.clients.layout')
@section('heading')
    
@endsection

@section('content')
@if ($user->admin)
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
    <div class="card col-xl-6 col-md-6 col-sm-12 col-12 py-3">
        {!! $chart_cv->container() !!}
    </div>
    <div class="card col-xl-6 col-md-6 col-sm-12 col-12 py-3">
        {!! $chart_s->container() !!}
    </div>
    <div class="card col-xl-6 col-md-6 col-sm-12 col-12 py-3">
        {!! $chart_ba->container() !!}
        <a href="/agents/meilleures" class="btn btn-dark">Voir tout</a>
    </div>
    <div class="card col-xl-6 col-md-6 col-sm-12 col-12 py-3">
        {!! $chart_bp->container() !!}
        <a href="/catalogue/best" class="btn btn-dark">Voir tout</a>
    </div>
    <div class="card col-xl-6 col-md-6 col-sm-12 col-12 py-3">
        {!! $chart_cp->container() !!}
        <a href="/catalogue/best/choices" class="btn btn-dark">Voir tout</a>
    </div>
    
</div>
<h2 class="m-3">Agences</h2>
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
    @endif
@endsection

@section('js')
{!! $mychart->renderChartJsLibrary() !!}
{!! $mychart->renderJs() !!}
{!! $cchart->renderJs() !!}
<script src="{{ $chart_cv->cdn() }}"></script>
{{ $chart_cv->script() }}
{{ $chart_s->script() }}
{{ $chart_ba->script() }}
{{ $chart_bp->script() }}
{{ $chart_cp->script() }}

@endsection