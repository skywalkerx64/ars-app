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
                        <li class="breadcrumb-item active" aria-current="page">Enregistrer un paiement</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row my-3">
    <form action="/client/paiement/csv_import" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="import" class="mx-2 "> Importer avec un csv</label>
        <input type="file" name="file" id="csv">

        <input type="submit" name="" id="" class="btn btn-success mx-3">
    </form>
</div>

<div class="col-12">
    <form action="/client/paiement/ajouter" method="post">
        @csrf
    <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
        <h5 class="card-header">Formulaire d'ajout</h5>
        <div class="card-body">

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="Agent" class="col-form-label">Agent</label>
                <input id="Agent" name="agent" type="text" class="form-control">
            </div>
            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="client" class="col-form-label">Client</label>
                <input id="client" name="client" type="text" class="form-control">
            </div>
            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="carte" class="col-form-label">carte</label>
                <input id="carte" name="carte" type="text" class="form-control">
            </div>
            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="montant" class="col-form-label" id="price_label">Montant</label>
                <input id="montant" name="montant" type="number" class="form-control" placeholder="">
            </div>
            <input type="hidden" id="count" value="">

            <button class="btn btn-success my-3" type="submit">Enregistrer</button>
        </div>
    </div>
</form>
</div>
@endsection
@section('js')

@endsection