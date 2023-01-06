@extends('settings.layout')

@section('heading')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Caisses</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                        <li class="breadcrumb-item"><a href="/administration" class="breadcrumb-link">Administration</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Caisses</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">

    @if ($user->admin)
    <div class="col-xl-4 col-lg-4 col-md-8 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted"><a href="" class="">Chiffre d'affaires</a></h5>
                <div class="metric-value d-inline-block">
                    <h1 class="text-2xl my-3">{{$caf }} XOF</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-8 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted"><a href="/caisse/{{$caisse_bf->tag}}">Bénéfices</a></h5>
                <div class="metric-value d-inline-block">
                    <h1 class="text-2xl my-3">{{$caisse_bf->solde}} XOF</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-8 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted"><a href="/caisse/{{$caisse_fa->tag}}">Paiements jaunes/ 6 prochains</a></h5>
                <div class="metric-value d-inline-block">
                    <h1 class="text-2xl my-3">{{$caisse_fa->solde}} XOF</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-8 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted"><a href="/caisse/{{$caisse_c1->tag}}">Paiements verts / 12 premiers</a></h5>
                <div class="metric-value d-inline-block">
                    <h1 class="text-2xl my-3">{{$caisse_c1->solde}} XOF</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-8 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted"><a href="/caisse/{{$caisse_c3->tag}}">Fonds d'achat des produits/ Reste</a></h5>
                <div class="metric-value d-inline-block">
                    <h1 class="text-2xl my-3">{{$caisse_c3->solde}} XOF</h1>
                </div>
            </div>
        </div>
    </div>
    @endif

</div> 
@endsection