@extends('administration.clients.layout')

@section('heading')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Clients</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                        <li class="breadcrumb-item"><a href="/administration" class="breadcrumb-link">Administration</a></li>
                        <li class="breadcrumb-item"><a href="/clients" class="breadcrumb-link">Clients</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Enregistrer un client</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-12">
    <form action="/clients/editer" method="post">
        @csrf
    <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
        <h5 class="card-header">Formulaire d'ajout</h5>
        <div class="card-body">

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="Nom" class="col-form-label">Nom</label>
                <input id="nom" name="nom" type="text" class="form-control" placeholder="Nom" value="{{ $client->nom }}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="prenom" class="col-form-label">Prenom</label>
                <input id="prenom" name="prenom" type="text" class="form-control" placeholder="Prenom" value="{{ $client->prenom }}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="adresse" class="col-form-label">Adresse</label>
                <input id="adresse" name="adresse" type="text" class="form-control" placeholder="Adresse" value="{{ $client->adresse }}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="age" class="col-form-label">Age</label>
                <input id="age" name="age" type="number" class="form-control" placeholder="ans" value="{{ $client->age }}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="contact" class="col-form-label">Contact</label>
                <input id="contact" name="contact" type="number" class="form-control" placeholder="+229" value="{{ $client->contact }}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="region" class="col-form-label">Region</label>
                <input id="region" name="region" type="text" class="form-control" placeholder="region" value="{{ $client->region }}">
            </div>

            <input id="id" name="id" type="hidden" value="{{ $client->id }}">

            <button class="btn btn-primary my-3" type="submit">Enregistrer</button>
        </div>
    </div>
</form>
</div>
@endsection