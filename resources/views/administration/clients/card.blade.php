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
                        <li class="breadcrumb-item"><a href="/client/{{ $client->id }}" class="breadcrumb-link">{{ $client->nom }} {{ $client->prenom }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Carte n° {{ $carte->id }}</li>
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

@if($user->poste!='Comptable')
<div class="row">
    <a href="/client/{{ $client->id }}/carte/{{ $carte->id }}/verser" class="btn btn-success mx-3 my-3">Effectuer un versement</a>
</div>
@endif
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
        <div class="tab-outline">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" id="tab-outline-one" data-toggle="tab" href="#outline-one" role="tab" aria-controls="general" aria-selected="true"><i class="mdi mdi-package-variant text-success text-lg mx-2"></i> Général</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-outline-two" data-toggle="tab" href="#outline-two" role="tab" aria-controls="ventes" aria-selected="false"><i class="mdi mdi-cart text-success text-lg mx-2"></i> Ventes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-outline-three" data-toggle="tab" href="#outline-three" role="tab" aria-controls="paiement" aria-selected="false"><i class="fa fa-money-bill-alt text-success text-lg mx-2"></i> Paiements</a>
                </li>
                @if ($user->admin)
                <li class="nav-item">
                    <a class="nav-link" id="tab-outline-four" data-toggle="tab" href="#outline-four" role="tab" aria-controls="bilan" aria-selected="false"><i class="fas fa-calendar-alt text-success text-lg mx-2"></i> Bilan</a>
                </li>      
                @endif
                
            </ul>
            
            <div class="tab-content" id="myTabContent2">
    
                <!-- Général -->
                <div class="tab-pane fade active show" id="outline-one" role="tabpanel" aria-labelledby="tab-outline-one">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card influencer-profile-data mt-3">
                            <div class="card-body">
    
    
                                <div class="row">
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-12">
                                            <div class="user-avatar-info">
                                                <div class="row mx-1 mb-3">
                                                    <div class="user-avatar-name">
                                                        <h2 class="mb-1 text-lg"><span><i class="mdi mdi-package-variant text-success text-lg mx-2"></i></span> Carte n°{{ $carte->id }}</h2>
                                                    </div>
                                                </div>
                                                <div class="user-avatar-address">
                                                    <p class="border-bottom pb-3 d-flex flex-col gap-2">
                                                        <span class="mb-2 ml-xl-4 d-xl-inline-block d-block"><i class="fa fa-calendar mr-2 text-success "></i>Date d'attribution: {{ $carte->created_at }}  </span>
                                                        <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"><i class="fas fa-user mr-2 text-success "></i>Client propriétaire: {{ $client->nom }} {{ $client->prenom }}</span>
                                                        <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"><i class="fa fa-phone mr-2 text-success "></i>+229 {{ $client->contact}}</span>
                                                        <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"><i class="fa fa-money-bill-alt mr-2 text-success "></i>Tranches restantes: {{ $carte->tranches }} soit <span class="h5">{{100-(100*$carte->tranches/$carte->duree) }}%</span> déja payés</span>
                                                        <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"><i class="mdi mdi-stairs mr-2 text-success "></i>Evolution: {{ $evolution->mois }}/{{ $evolution->jour }}</span>
                                                        <div class="row col-12 d-flex gap-3 align-items-center ">
                                                            <h4>Progression:</h4>
                                                            <div class="progress my-3 w-75 h-10 ">
                                                                <div class="progress-bar bg-success px-3 text-black" role="progressbar" style="width: {{100-(100*$carte->tranches/$carte->duree) }}%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">{{100-(100*$carte->tranches/$carte->duree) }}%</div>
                                                            </div>
                                                        </div>
                                                            
                                                        
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="row px-3 py-3">
                                    <h3><i class="mdi mdi-contact-mail text-success mr-2"></i>Agent assigné: <a href="/agent/{{ $agent->id }}">{{ $agent->nom }} {{ $agent->prenom }}</a></h3>
                                </div>
                                <div class="row d-flex justify-end gap-5">
                                    @if ($user->admin)
                                    <div class="">
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
                                    </div>
                                    @endif
                                    
                                    <a href="/client/{{$client->id}}/carte/{{ $carte->id }}/changer" class="btn btn-outline-light mx-1" id="delete-btn"><i class="mdi mdi-swap-horizontal"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Ventes -->
                <div class="tab-pane fade" id="outline-two" role="tabpanel" aria-labelledby="tab-outline-two">
                    <h3 class="m-3">Produits de la carte</h3>
                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-6">
                        @php
                            $i=0;
                        @endphp
                        @foreach ($ventes as $vente)
                        @if ($produits[$i]==null)
                            <div class="card">
    
                                <h5 class="card-header"> Vente n° {{ $vente->id }} </h5>
    
                                <div class="card-body">
                                    <h3>Pas de vente</h3> 
                                </div>
                            </div>
                        @else
        
                            <div class="card">
                                <h3 class="card-header"> Vente n° {{ $vente->id }} </h3>
                                <div class="card-body">
                                    <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="product-thumbnail">
                                            <div class="product-img-head">
                                                <div class="product-img">
                                                    <img src="{{ Storage::url($produits[$i]->image) }}" alt="" class="img-fluid"></div>
                                            </div>
                
                                            <div class="product-content">
                                                <div class="product-content-head">
                                                    <h3 class="product-title">{{ $produits[$i]->intitule }}</h3>
                
                                                    <div class="product-price"> <b>{{ $produits[$i]->prix/$carte->duree }}/J</b></div>
                                                </div>
                                                <div class="product-btn d-flex">
                                                    <a href="/catalogue/produit/{{ $produits[$i]->id }}" class="btn btn-primary mx-1">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-end">
                                        <a href="/carte/{{$carte->id}}/vente/{{$vente->id}}/livrer" class="btn btn-dark">Livrer</a>
                                    </div>

                                    
                                </div>
                            </div>
    
        
                        @endif
                        @php
                            $i++;
                        @endphp
        
    
                        @endforeach
        
            
                    </div>
    
                </div>
                <!-- Paiements -->
                <div class="tab-pane fade" id="outline-three" role="tabpanel" aria-labelledby="tab-outline-three">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                
    
                            <div class="card">
                                <h5 class="card-header">Paiements</h5>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">id</th>
                                                <th scope="col">Client</th>
                                                <th scope="col">Agent</th>
                                                <th scope="col">Montant</th>
                                                <th scope="col">Tranches</th>
                                                <th scope="col">Date de transaction</th>
                        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($paiements as $paiement)
                                            
                                            <tr>
                        
                                                <td>{{ $paiement->id }}</td>
                                                <td>{{ $client->nom }} {{ $client->prenom }}</td>
                                                <td>{{ $agent->nom }} {{ $agent->prenom }}</td>
                                                <td>{{ $paiement->montant }}</td>
                                                <td>{{ $paiement->montant/$carte->cout }}</td> 
                                                <td>{{ $paiement->created_at }}</td> 
                                            </tr>
                                            
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    
                        </div>
                    </div>
    
                </div>
                @if ($user->admin)
                       <!-- Bilan -->
                <div class="tab-pane fade" id="outline-four" role="tabpanel" aria-labelledby="tab-outline-four">
                    @php
                        $month=$carte->duree/31;
                        $days=1;
                        $payed=$carte->duree-$carte->tranches;
                    @endphp
                    <div class="row overflow-hidden flex justify-center">
    
                        <div class="flex flex-column gap-y-10">
                
                            @for ($i = 0; $i < $month; $i++)
                                <div class="grid grid-cols-7 gap-1 ml-5 border border-3 p-3" style="border-color:black">
                                    @for ($j = 1; $j <= 31; $j++)
                                        
                                        <div class="border border-3 border-dark h-32 w-32 p-2 d-flex flex-column justify-content-between">
                                            {{$j}}
                                            @if ($payed>0)
                                                <div class="flex justify-content-end align-items-end">
                                                <!-- pour les cartes de type A -->
                                                    @if ($carte->duree==372)
                                                        @if ($days<=12)
                                                            <i class="fas fa-calendar-check text-success"></i>
                                                        @endif
                                                        @if ($days>=13 && $days<=18)
                                                            <i class="fas fa-calendar-check text-warning"></i>
                                                        @endif
                                                        @if ($days>18)
                                                            <i class="fas fa-calendar-check text-blue-500"></i>
                                                        @endif
                                                    @endif
                                                <!-- pour les cartes de type B -->
                                                    @if ($carte->duree==558)
                                                        @if ($days<=18)
                                                            <i class="fas fa-calendar-check text-success"></i>
                                                        @endif
                                                        @if ($days>=19 && $days<=27)
                                                            <i class="fas fa-calendar-check text-warning"></i>
                                                        @endif
                                                        @if ($days>27)
                                                            <i class="fas fa-calendar-check text-blue-500"></i>
                                                        @endif
                                                    @endif
                                                    <!-- pour les cartes de type C -->
                                                    @if ($carte->duree==186)
                                                        @if ($days<=6)
                                                            <i class="fas fa-calendar-check text-success"></i>
                                                        @endif
                                                        @if ($days>=7 && $days<=9)
                                                            <i class="fas fa-calendar-check text-warning"></i>
                                                        @endif
                                                        @if ($days>9)
                                                            <i class="fas fa-calendar-check text-blue-500"></i>
                                                        @endif
                                                    @endif
                                                    <!-- pour les cartes de type D -->
                                                    @if ($carte->duree==124)
                                                        @if ($days<=4)
                                                            <i class="fas fa-calendar-check text-success"></i>
                                                        @endif
                                                        @if ($days>=5 && $days<=6)
                                                            <i class="fas fa-calendar-check text-warning"></i>
                                                        @endif
                                                        @if ($days>6)
                                                            <i class="fas fa-calendar-check text-blue-500"></i>
                                                        @endif
                                                    @endif
                                                </div>
                                                @php
                                                    $days++;
                                                    $payed--;
                                                @endphp
                                            @endif
                                </div>
                                    @endfor
                    </div>
                            @endfor
                
                </div>              
                @endif
               
    
        </div>
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection