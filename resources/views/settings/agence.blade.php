@extends('settings.layout')
@section('heading')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Agence</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Agence de {{$agence->localisation}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    
</div>
<div class="row">
    <a href="/agence/{{ $agence->id }}/utilisateur/ajouter" class="btn btn-success m-3">Ajouter un compte utilisateur</a>
    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-6">
        <div class="card">
            <h5 class="card-header">Comptes utitlisateurs</h5>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Mail</th>
                            <th scope="col">Poste</th>
                            <th scope="col">Administrateur</th>
                            <th scope="col">Plus</th>
    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($utilisateurs as $utilisateur)
                        
                        <tr>
                            <td>{{ $utilisateur->name }}</td>
                            <td>{{ $utilisateur->email }}</td>
                            <td>{{ $utilisateur->poste }}</td>
                            <td>
                                @if ($utilisateur->admin)
                                    <i class="fas fa-circle text-success"></i>
                                @endif
                                @if (!$utilisateur->admin)
                                <i class="fas fa-circle text-danger"></i>
                                @endif
                                
                            </td>
                            <td><a href="/utilisateur/{{ $utilisateur->id }}">Détails</a></td>
                            
                        </tr>
                        
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Agents</h5>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Diplome</th>
                            <th scope="col">Plus</th>
                            @if ($user->admin)
                            <th><i class="fas fa-ellipsis-h text-dark"></i></th>
                            @endif
                            
    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agents as $agent)
                        
                        <tr>
    
                            <td>{{ $agent->tag }}</td>
                            <td>{{ $agent->nom }}</td>
                            <td>{{ $agent->prenom }}</td>
                            <td>{{ $agent->adresse }}</td>
                            <td>{{ $agent->contact }}</td>
                            <td>{{ $agent->diplome }}</td>
                            <td><a href="/agent/{{ $agent->id }}">Détails</a></td>
                            @if ($user->admin)
                            <td><a href="/agent/{{ $agent->id }}/editer"><i class="far fa-edit"></i></a></td>
                            @endif
                            
                            
                        </tr>
                        
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection