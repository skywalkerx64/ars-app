@extends('administration.agents.layout')

@section('heading')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Agents</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                        <li class="breadcrumb-item"><a href="/administration" class="breadcrumb-link">Administration</a></li>
                        <li class="breadcrumb-item"><a href="/agences" class="breadcrumb-link">Agents</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modifier les informations de l'agent {{$agent->nom}} {{$agent->prenom}} </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="input-group mb-3 pt-0 col-12">
        <form action="/agents/rechercher" method="post" class="d-flex col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            @csrf
            <input class="form-control" type="text" placeholder="Rechercher" name="key">
            <div class="input-group-append">
                <input type="submit" class="btn btn-success" value="Rechercher">
            </div>
        </form>
        
    </div>
</div>
@endsection

@section('content')
<div class="col-12">
    <form action="/agent/{{$agent->id}}/editer" method="post">
        @csrf
    <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
        <h5 class="card-header">Formulaire d'édition</h5>
        <div class="card-body">

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="Nom" class="col-form-label">Nom</label>
                <input id="nom" name="nom" type="text" class="form-control" placeholder="Nom" value="{{$agent->nom}}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="prenom" class="col-form-label">Prenom</label>
                <input id="prenom" name="prenom" type="text" class="form-control" placeholder="Prenom" value="{{$agent->prenom}}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="adresse" class="col-form-label">Adresse</label>
                <input id="adresse" name="adresse" type="text" class="form-control" placeholder="Adresse" value="{{$agent->adresse}}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="age" class="col-form-label">Age</label>
                <input id="age" name="age" type="number" class="form-control" placeholder="ans" value="{{$agent->age}}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="sexe" class="col-form-label">Sexe</label>
                <input id="sexe" name="sexe" type="text" class="form-control" placeholder="M ou F" value="{{$agent->sexe}}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="contact" class="col-form-label">Contact</label>
                <input id="contact" name="contact" type="number" class="form-control" placeholder="+229" value="{{$agent->contact}}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="contact urgence" class="col-form-label">Contact d'urgence</label>
                <input id="contact urgence" name="urgence_contact" type="number" class="form-control" placeholder="+229" value="{{$agent->urgence_contact}}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="region" class="col-form-label">Diplome</label>
                <input id="diplome" name="diplome" type="text" class="form-control" placeholder="Diplome" value="{{$agent->diplome}}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="agence" class="col-form-label">Agence assignée</label>
                <select id="agence" name="agence_id" class="form-control" placeholder="agence" value="{{$agent->agence}}">
                    @foreach ($agences as $agence)
                    <option>{{ $agence->localisation }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success my-3" type="submit">Enregistrer</button>
        </div>
    </div>
</form>
</div>
@endsection