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
                        <li class="breadcrumb-item active" aria-current="page">Ajouter un quartier</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="col-12">
    <form action="/quartiers/ajouter" method="post">
        @csrf
    <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
        <h5 class="card-header">Formulaire d'ajout</h5>
        <div class="card-body">
            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="Nom" class="col-form-label">Nom</label>
                <input id="nom" name="nom" type="text" class="form-control" placeholder="Nom">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="tag" class="col-form-label">Tag</label>
                <input id="tag" name="tag" type="text" class="form-control" placeholder="tag">
            </div>
            <button class="btn btn-success my-3" type="submit">Enregistrer</button>
        </div>
    </div>
</form>
</div>
@endsection