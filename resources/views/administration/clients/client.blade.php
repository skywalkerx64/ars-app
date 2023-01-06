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
                        <li class="breadcrumb-item active" aria-current="page">{{ $client->nom }} {{ $client->prenom }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="input-group mb-3 pt-0 col-12">
        <form action="/clients/rechercher" method="post" class="d-flex col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
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
                                        <h2 class="mb-1 text-lg"><span><i class="fas fa-user mr-2"></i></span>{{ $client->nom }} {{ $client->prenom }}</h2>
                                    </div>
                                </div>
                                <div class="user-avatar-address">
                                    <p class="border-bottom pb-3">
                                        <span class="d-xl-inline-block d-block mb-2"><i class="fa fa-map-marker-alt mr-2 text-success "></i>{{ $client->adresse }}</span>
                                        <span class="d-xl-inline-block d-block mb-2"><i class=" mr-2 text-success "></i>Code: {{ $client->tag }}</span>
                                        <span class="mb-2 ml-xl-4 d-xl-inline-block d-block"><i class="fa fa-calendar mr-2 text-success "></i>Date d'enregistrement: {{ $client->created_at }}  </span>
                                        <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"><i class="fas fa-user mr-2 text-success "></i>{{ $client->age }} ans</span>
                                        <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"><i class="fa fa-phone mr-2 text-success "></i>+229 {{ $client->contact}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row px-3 py-3 flex justify-between">
                    <h3><i class="mdi mdi-contact-mail text-success mr-2"></i>Agent assigné: <a href="/agent/{{ $agent->id }}">{{ $agent->nom }} {{ $agent->prenom }}</a></h3>
                    @if($user->poste!='Comptable')
                                <div>
                                    <a href="/client/{{ $client->id }}/editer"><i class="far fa-edit"></i></a>
                                </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted text-succes">Total Cartes</h5>
                        <h2 class="mb-0 text-2xl"> {{ $cartes->count() }}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                                        <i class="mdi mdi-package-variant-closed fa-fw fa-sm text-info"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted text-succes">Cartes validées</h5>
                        <h2 class="mb-0 text-2xl"> {{ $cartes_c->count() }}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-success-light mt-1">
                                        <i class="mdi mdi-package-variant fa-fw fa-sm text-success"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted text-succes">Cartes en cours</h5>
                        <h2 class="mb-0 text-2xl"> {{ $cartes_nc->count() }}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                                        <i class="fas fa-sync-alt fa-fw fa-sm text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    @if($user->poste!='Comptable')
    <div class="row">
        <a href="/client/{{ $client->id }}/cartes/ajouter" class="btn btn-success mx-3 my-3">Assigner une carte</a>
        <a href="/client/{{ $client->id }}/exporter" class="btn btn-success mx-3 my-3">Exporter le contact</a>
        <a href="/client/{{$client->id}}/migrate" class="btn btn-success mx-3 my-3">Migrer</a>
    </div>
    @endif
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Cartes de {{ $client->nom }} {{ $client->prenom }} </h5>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Duree</th>
                                <th scope="col">Cout</th>
                                <th scope="col">Ajoutée le</th>
                                <th scope="col">Derniere modification</th>
                                <th scope="col">Détails</th>
                                @if ($user->admin)
                                <th scope="col">Opérations</th>   
                                @endif
                                
        
                            </tr>
                        </thead>
                        <tbody>
                @foreach ($cartes as $carte )
                            @if (!$carte->completed)
                            <tr>
        
                                <td>carte {{ $carte->tag }}</td>
                                <td>{{ $carte->duree }} Jours</td>
                                <td>{{ $carte->cout}} XOF/Jours</td>
                                <td>{{ $carte->created_at }}</td>
                                <td>{{ $carte->updated_at }}</td>
                                <td><a href="/client/carte/{{ $carte->id }}">Détails</a></td>
                                <td class="flex justify-center items-center gap-3"><div class="">
                                    @if($user->poste!='Comptable')
                                    <a href="/client/{{$client->id}}/carte/{{$carte->id}}/verser" class="mx-3">Payer</a>
                                    @endif
                                @if($user->poste=='Administrateur' && $user->admin)

                                    
                                    <!-- Button trigger modal -->
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fas fa-trash" ></i>
                                            </a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </a>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes vous sûre de vouloir supprimer la carte n° {{ $carte->id }}?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" class="btn btn-success" data-dismiss="modal">Fermer</a>
                                                    <a href="/client/{{$client->id}}/carte/{{ $carte->id }}/supprimer" class="btn btn-danger">Mettre à la corbeille</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                </td>
                                @endif
        
                            </tr>
                            @endif
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
                <h5 class="card-header">Cartes soldées de {{ $client->nom }} {{ $client->prenom }} </h5>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Duree</th>
                                <th scope="col">Ajoutée le</th>
                                <th scope="col">Derniere modification</th>
                                <th scope="col">Détails</th>
                                @if ($user->admin)
                                <th scope="col">Opérations</th>   
                                @endif
                                
        
                            </tr>
                        </thead>
                        <tbody>
                @foreach ($cartes as $carte )
                            @if ($carte->completed)
                            <tr>
        
                                <td>carte {{ $carte->tag }}</td>
                                <td>{{ $carte->duree }} Jours</td>
                                <td>{{ $carte->created_at }}</td>
                                <td>{{ $carte->updated_at }}</td>
                                <td><a href="/client/carte/{{ $carte->id }}">Détails</a></td>
                                
                                @if($user->poste=='Administrateur' && $user->admin)
                                <td><div class="">
                                    <!-- Button trigger modal -->
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fas fa-trash" ></i>
                                            </a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </a>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes vous sûre de vouloir supprimer la carte n° {{ $carte->id }}?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" class="btn btn-success" data-dismiss="modal">Fermer</a>
                                                    <a href="/client/{{$client->id}}/carte/{{ $carte->id }}/supprimer" class="btn btn-danger">Supprimer</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div></td>
                                @endif
        
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
@endsection