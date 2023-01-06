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
                        <li class="breadcrumb-item"><a href="/agents" class="breadcrumb-link">Agents</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Agent {{ $agent->nom }} {{ $agent->prenom }}</li>
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
 
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card influencer-profile-data mt-3">
            <div class="card-body">
                <div class="row">
                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-12">
                            <div class="user-avatar-info">
                                <div class="row mx-1 mb-3">
                                    <div class="user-avatar-name">
                                        <h2 class="mb-1 text-lg"><span><i class="fas fa-user mr-2"></i></span>{{ $agent->nom }} {{ $agent->prenom }}</h2>
                                    </div>
                                </div>
                                <div class="user-avatar-address">
                                    <p class="border-bottom pb-3">
                                        <span class="d-xl-inline-block d-block mb-2"><i class="fa fa-map-marker-alt mr-2 text-success "></i>{{ $agent->adresse }}</span>
                                        <span class="d-xl-inline-block d-block mb-2"><i class="mr-2 text-success "></i>Code : {{ $agent->tag }}</span>
                                        <span class="mb-2 ml-xl-4 d-xl-inline-block d-block"><i class="fa fa-calendar mr-2 text-success "></i>Date d'enregistrement: {{ $agent->created_at }}  </span>
                                        <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"><i class="fas fa-user mr-2 text-success "></i>{{ $agent->age }} ans</span>
                                        <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"><i class="mdi mdi-gender-transgender mr-2 text-success "></i>{{ $agent->sexe}}</span>
                                        <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"><i class="fa fa-phone mr-2 text-success "></i>+229 {{ $agent->contact}}</span>
                                        <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"><i class="fa fa-phone mr-2 text-danger "></i>+229 {{ $agent->urgence_contact}}</span>
                                        <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"><i class="mdi mdi-school mr-2 text-success"></i>{{ $agent->diplome}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                </div>
                @if($user->admin)
                <div class="row px-3 py-3">
                    <h3>Agence assignée: <a href="/agence/{{ $agent->agence_id }}"><i class="mdi mdi-home-modern text-success"></i></a></h3>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                    <h5 class="text-muted text-succes">Total Clients</h5>
                    <h2 class="mb-0 text-2xl"> {{ $clients->count() }}</h2>
                </div>
                <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                                    <i class="fas fa-user fa-fw fa-sm text-info"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                    <h5 class="text-muted text-succes">Total Cartes</h5>
                    <h2 class="mb-0 text-2xl"> {{ count($cartes_a) }}</h2>
                </div>
                <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                                    <i class="mdi mdi-package-variant-closed fa-fw fa-sm text-info"></i>
                </div>
            </div>
        </div>
    </div>
</div> 

<div class="">
    <a href="/client/ajouter/{{ $agent->id }}" class="btn btn-success mx-3 my-3">Assigner client</a>
    <a href="/client/ajouter/carte/{{ $agent->id }}" class="btn btn-success mx-3 my-3">Assigner client et nouvelle carte</a>
    <a href="/agent/{{ $agent->id }}/supervision" class="btn btn-success mx-3 my-3">Génerer fiche de supervision</a>
    <a href="/agent/{{ $agent->id }}/terrain" class="btn btn-success mx-3 my-3">Génerer fiche de terrain</a>
    <a href="/agent/{{ $agent->id }}/migrate/clients" class="btn btn-success mx-3 my-3">Migrer les clients</a>
    <div class="col-3">
    <form action="/fiche/controle" method="post" class="flex items-center">
            @csrf
                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <input id="date" name="date" type="date" class="form-control" placeholder="Diplome">
                </div>
                <input type="hidden" value="{{ $agent->id }}" name="agent_id">
    
                <button class="btn btn-success my-3" type="submit">Generer fiche de controle</button>
        </form>
        </div>
        
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
        <div class="tab-outline">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" id="tab-outline-one" data-toggle="tab" href="#outline-one" role="tab" aria-controls="general" aria-selected="true"><i class="fas fa-user text-success text-lg mx-2"></i> Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-outline-two" data-toggle="tab" href="#outline-two" role="tab" aria-controls="ventes" aria-selected="false"><i class="fa fa-money-bill-alt text-success text-lg mx-2"></i> Transactions</a>
                </li>
            </ul>
            
            <div class="tab-content" id="myTabContent2">
    
                <!-- Clients-->
                <div class="tab-pane fade active show" id="outline-one" role="tabpanel" aria-labelledby="tab-outline-one">
                    <div class="row">
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
                                                <th scope="col">Opérations</th>                                                 
                        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clients as $client)
                                            
                                            <tr>
                        
                                                <td>{{ $client->tag }}</td>
                                                <td>{{ $client->nom }}</td>
                                                <td>{{ $client->prenom }}</td>
                                                <td>{{ $client->adresse }}</td>
                                                <td>{{ $client->contact }}</td>
                                                <td>{{ $client->region }}</td>
                                                <td><a href="/client/{{ $client->id }}">Détails</a></td>
                                                
                                                @if($user->poste!='Comptable')
                                                <td>
                                                    <div>
                                                        <a href="/client/{{ $client->id }}/editer"><i class="far fa-edit"></i></a>
                                                    </div>
                                                </td>
                                                @endif
                                            </tr>
                                            
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                     </div>
                    
                    
                </div>
    
                <!-- Transactions -->
                <div class="tab-pane fade" id="outline-two" role="tabpanel" aria-labelledby="tab-outline-two">
                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-6">
                            
                
                        <div class="card">
                            <h5 class="card-header">Transactions</h5>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">id</th>
                                            <th scope="col">Client</th>
                                            <th scope="col">Montant</th>
                                            <th scope="col">Tranches</th>
                                            <th scope="col">Date de transaction</th>
                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            use App\Models\Carte;
                                        @endphp
                                        @foreach ($paiements as $paiement)
                                        @if($paiement!=null)
                                        <tr>
                    
                                            <td>{{ $paiement->id }}</td>
                                            
                                            <td>{{ $paiement->montant }}</td>
                                            <td>{{ $paiement->montant/Carte::find($paiement->carte_id)->cout }}</td> 
                                            <td>{{ $paiement->created_at }}</td> 
                                        </tr>
                                        @endif
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection