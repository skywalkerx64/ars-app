@extends('administration.caisses.layout')

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
                        <li class="breadcrumb-item"><a href="/caisses" class="breadcrumb-link">Caisses</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transfert de fonds</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-12">
    <form action="/caisse/transfert" method="post">
        @csrf
    <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
        <h5 class="card-header">Formulaire de transfert</h5>
        <div class="card-body">

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="tag" class="col-form-label">{{ $caisse->intitule }}</label>
                <input id="tag" name="tag" type="text" class="form-control" value="{{ $caisse->tag }}">
            </div>
            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="montant" class="col-form-label">Montant</label>
                <input id="montant" name="montant" type="number" class="form-control" placeholder="" required>
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="motif" class="col-form-label">Motif</label>
                <input id="motif" name="motif" type="text" class="form-control" placeholder="Motif de transaction" required>
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="statut" class="col-form-label">statut</label>
                <select class="form-control" id="statut" name="statut" placeholder="statut">
                    <option>Depot</option>
                    <option>Retrait</option>
                </select>
            </div>
            <button class="btn btn-primary my-3" type="submit">Enregistrer</button>
        </div>
    </div>
</form>
</div>
@endsection