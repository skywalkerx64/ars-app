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
                        <li class="breadcrumb-item"><a href="/parametres" class="breadcrumb-link">Parametres</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Créer une nouvelle agence</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-12">
    <form action="/agence/ajouter" method="post">
        @csrf
    <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
        <h5 class="card-header">Formulaire de création</h5>
        <div class="card-body">
            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  ">
                <label for="departement" class="col-form-label">Département</label>
                <select class="form-control" id="departement" name="departement">
                    @foreach ($departements as $departement)
                    <option>{{ $departement->nom }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  ">
                <label for="ville" class="col-form-label">Ville</label>
                <select class="form-control" id="ville" name="ville">
                    @foreach ($villes as $ville)
                    <option>{{ $ville->nom }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  ">
                <label for="quartier" class="col-form-label">Quartier</label>
                <select class="form-control" id="quartier" name="quartier">
                    @foreach ($quartiers as $quartier)
                    <option>{{ $quartier->nom }}</option>
                    @endforeach

                </select>
            </div>
            <button class="btn btn-success my-3" type="submit">Enregistrer</button>
        </div>
    </div>
</form>
</div>
@endsection