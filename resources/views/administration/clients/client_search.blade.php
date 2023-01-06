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
                        <li class="breadcrumb-item active" aria-current="page">Clients</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="input-group mb-3 pt-0 col-12">
        <form action="/clients/rechercher" method="post" class="d-flex col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            @csrf
            <input class="form-control" type="text" placeholder="Rechercher" name="key" value="{{$key}}">
            <div class="input-group-append">
                <input type="submit" class="btn btn-success" value="Rechercher">
            </div>
        </form>
        
    </div>
</div>
@endsection

@section('content')
@if($user->poste!='Comptable')
<div class="row my-3 mx-3">
    <form action="/paiement/csv_import" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="import" class=""> Importer des paiements avec un csv</label>
        <input type="file" name="file" id="csv" class="mx-2">

        <input type="submit" name="" id="" class="btn btn-success mx-3">
    </form>
</div class="row">
    <a href="/clients/exporter" class="btn btn-success m-3">Exporter les contacts</a>
<div>
@endif
</div>

<div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-6">
    <div class="card">
        <h5 class="card-header">Clients</h5>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Région</th>
                        <th scope="col">Plus</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                    
                    <tr>

                        <td>{{ $client->id }}</td>
                        <td>{{ $client->nom }}</td>
                        <td>{{ $client->prenom }}</td>
                        <td>{{ $client->adresse }}</td>
                        <td>{{ $client->contact }}</td>
                        <td>{{ $client->region }}</td>
                        <td><a href="/client/{{ $client->id }}">Détails</a></td>
                        
                    </tr>
                    
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection