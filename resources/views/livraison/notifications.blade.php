@extends('livraison.layout')

@section('heading')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Livraison</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                        <li class="breadcrumb-item"><a href="/administration" class="breadcrumb-link">Administration</a></li>
                        <li class="breadcrumb-item"><a href="/clients" class="breadcrumb-link">Livraison</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
@php
    use App\Models\Carte;
@endphp
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
        <div class="tab-outline">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" id="tab-outline-one" data-toggle="tab" href="#outline-one" role="tab" aria-controls="general" aria-selected="true"><i class="mdi mdi-cart text-success text-lg mx-2"></i>Toutes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-outline-two" data-toggle="tab" href="#outline-two" role="tab" aria-controls="ventes" aria-selected="false"><i class="fas fa-motorcycle text-success text-lg mx-2"></i> Motocyclettes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-outline-three" data-toggle="tab" href="#outline-three" role="tab" aria-controls="paiement" aria-selected="false"><i class="mdi mdi-file-multiple text-success text-lg mx-2"></i> Cartes combinées</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-outline-four" data-toggle="tab" href="#outline-four" role="tab" aria-controls="bilan" aria-selected="false"><i class="mdi mdi-file-multiple text-success text-lg mx-2"></i> Cartes non combinées</a>
                </li>      
                
            </ul>
            
            <div class="tab-content" id="myTabContent2">
    
                <!-- Toutes -->
                <div class="tab-pane fade active show" id="outline-one" role="tabpanel" aria-labelledby="tab-outline-one">
                    <div class="row grid">
                    @foreach ($notifs as $notif)
                        @php
                            $carte=Carte::findorFail($notif->carte_id);
                            $ventes=$carte->ventes;
                            $vente=$ventes->min();
                        @endphp
                        <div class="card">
                            <div class="card-body flex justify-between">
                                
                                <div class="flex gap-3">
                                    <div>
                                        @if ($notif->statut=='L')
                                        <span class="badge-dot badge-success"></span>
                                        @endif
                                        @if ($notif->statut=='LP')
                                        <span class="badge-dot badge-warning"></span>
                                        @endif
                                        @if ($notif->statut=='NL')
                                        <span class="badge-dot badge-danger"></span>
                                        @endif
                                    </div>


                                    @if ($notif->categorie=='C')
                                    <span>Carte {{$carte->tag}}. Livraison du produit {{$vente->produit->tag}} apres {{ $notif->echeance }} mises encore.</span> 
                                    @endif
                                    @if ($notif->categorie=='NC')
                                    <span>Carte {{$carte->tag}}. Livraison des produits de la carte apres {{ $notif->echeance }} mises encore.</span> 
                                    @endif
                                    
                                </div>
                                <div>
                                    {{$notif->created_at->format('d.m.y')}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                </div>
    
                <!-- Motos -->
                <div class="tab-pane fade" id="outline-two" role="tabpanel" aria-labelledby="tab-outline-two">
                    @foreach ($notifs_m as $notif)
                        @php
                            $carte=Carte::findorFail($notif->carte_id);
                            $ventes=$carte->ventes;
                            $vente=$ventes->min('cout');
                        @endphp
                        <div class="card">
                            <div class="card-body flex justify-between">
                                
                                <div class="flex gap-3">
                                    <div>
                                        @if ($notif->statut=='L')
                                        <span class="badge-dot badge-success"></span>
                                        @endif
                                        @if ($notif->statut=='LP')
                                        <span class="badge-dot badge-warning"></span>
                                        @endif
                                        @if ($notif->statut=='NL')
                                        <span class="badge-dot badge-danger"></span>
                                        @endif
                                    </div>
                                        @if ($notif->statut=='LP')
                                            <span>Carte {{$carte->tag}}. {{$notif->intitule}} {{ $notif->echeance }} mises encore.</span>   
                                        @endif
                                        @if ($notif->statut=='NL')
                                            <span>Carte {{$carte->tag}}. {{$notif->intitule}} {{$vente->produit->intitule}} après mises encore.</span>   
                                        @endif
                                        @if ($notif->statut=='L')
                                            <span>Carte {{$carte->tag}}. {{$notif->intitule}}.</span>   
                                        @endif  
                                </div>
                                <div>
                                    {{$notif->created_at->format('d.m.y')}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                <!-- Combines -->
                <div class="tab-pane fade" id="outline-three" role="tabpanel" aria-labelledby="tab-outline-three">
                    @foreach ($notifs_c as $notif)
                        @php
                            $carte=Carte::findorFail($notif->carte_id);
                            $ventes=$carte->ventes;
                            $vente=$ventes->min();
                        @endphp
                        <div class="card">
                            <div class="card-body flex justify-between">
                                
                                <div class="flex gap-3">
                                    <div>
                                        @if ($notif->statut=='L')
                                        <span class="badge-dot badge-success"></span>
                                        @endif
                                        @if ($notif->statut=='LP')
                                        <span class="badge-dot badge-warning"></span>
                                        @endif
                                        @if ($notif->statut=='NL')
                                        <span class="badge-dot badge-danger"></span>
                                        @endif
                                    </div>
                                    @if ($carte->cout<=75)
                                            <span>Carte {{$carte->tag}}. {{$notif->intitule}} {{ $notif->echeance }} mises encore.</span>  
                                    @endif
                                    @if ($carte->cout>=100)
                                        @if ($notif->statut=='LP')
                                            <span>Carte {{$carte->tag}}. {{$notif->intitule}} {{ $notif->echeance }} mises encore.</span>   
                                        @endif
                                        @if ($notif->statut=='NL')
                                            <span>Carte {{$carte->tag}}. {{$notif->intitule}} {{$vente->produit->intitule}} après mises encore.</span>   
                                        @endif
                                        @if ($notif->statut=='L')
                                            <span>Carte {{$carte->tag}}. {{$notif->intitule}}.</span>   
                                        @endif  
                                    @endif
                                    
                                </div>
                                <div>
                                    {{$notif->created_at->format('d.m.y')}}
                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>
                       <!-- Non combines -->
                <div class="tab-pane fade" id="outline-four" role="tabpanel" aria-labelledby="tab-outline-four">
                    @foreach ($notifs_nc as $notif)
                    @php
                        $carte=Carte::findorFail($notif->carte_id);
                        $ventes=$carte->ventes;
                        $vente=$ventes->min('cout');
                    @endphp
                    <div class="card">
                        <div class="card-body flex justify-between">
                            
                            <div class="flex gap-3">
                                <div>
                                    @if ($notif->statut=='L')
                                    <span class="badge-dot badge-success"></span>
                                    @endif
                                    @if ($notif->statut=='LP')
                                    <span class="badge-dot badge-warning"></span>
                                    @endif
                                    @if ($notif->statut=='NL')
                                    <span class="badge-dot badge-danger"></span>
                                    @endif
                                </div>

                                <span>Carte {{$carte->tag}}. {{$notif->intitule}} {{ $notif->echeance }} mises encore.</span>
                                
                            </div>
                                {{$notif->created_at->format('d.m.y')}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection