@extends('catalogue.layout')

@section('heading')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Fiche produit</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                        <li class="breadcrumb-item"><a href="/catalogue" class="breadcrumb-link">Catalogue</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Fiche produit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-2">
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pr-xl-0 pr-lg-0 pr-md-0  m-b-30 d-flex align-items-center justify-content-center">
                <img class="d-block" src="/storage/public/{{$produit->image}}" alt="Product image">
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pl-xl-0 pl-lg-0 pl-md-0 border-left m-b-30">
                <div class="product-details">
                    <div class="border-bottom pb-3 mb-3">
                        <h2 class="">{{$produit->intitule}}</h2>
                    @if ($user->admin)
                        <h3 class="mb-2 text-primary">{{$produit->prix}} XOF</h3>
                        @if ($produit->categorie=='Motocyclette')
                                <h3 class="mb-2 text-primary">{{ $produit->prix_2}} XOF</h3>
                        @endif
                    </div>
                    @endif


                    <div class="product-description">
                        <h4 class="mb-1">Description</h4>
                        <p class="mb-2">{{ $produit->description }}</p>
                        <div><h4 class="inline">Code: </h1>{{ $produit->tag }}</div>
                            @if ($user->admin)
                        <div><h4 class="inline">Pourcentage: </h1>{{ $produit->pourcentage }}%</div>
                            @if ($produit->categorie=='Motocyclette')
                                <div><h4 class="inline">Pourcentage B: </h1>{{ $produit->pourcentage_2 }}%</div>
                            @endif
                            @if($user->poste=='Administrateur' && $user->admin)
                            <div class="row d-flex gap-5 py-3 px-3">
                                <div class="">
                                    <!-- Button trigger modal -->
                                    <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
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
                                                    <p>Etes vous sûre de vouloir supprimer le produit {{ $produit->intitule }} ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" class="btn btn-success" data-dismiss="modal">Fermer</a>
                                                    <a href="/catalogue/produit/{{$produit->id}}/supprimer" class="btn btn-danger">Supprimer</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/catalogue/produit/{{ $produit->id }}/modifier" class="btn btn-outline-light mx-1" ><i class="fas fa-edit"></i></a>
                                <a href="/catalogue/produit/{{ $produit->id }}/prix/modifier" class="btn btn-outline-light mx-1" >Changer le prix</a>

                            </div>
                            @endif
                        @endif
                            
                            
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-b-60">
                <div class="simple-card">
                    <ul class="nav nav-tabs" id="myTab5" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active border-left-0" id="product-tab-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="product-tab-1" aria-selected="true">Descriptions</a>
                        </li>
                        @if ($user->admin)
                        <li class="nav-item">
                            <a class="nav-link" id="product-tab-2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="product-tab-2" aria-selected="false">Reviews</a>
                        </li>
                        @endif
                        
                    </ul>
                    <div class="tab-content" id="myTabContent5">
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="product-tab-1">
                            <p>{{ $produit->description }}</p>
                            
                        </div>
                        @if ($user->admin)
                        <div class="tab-pane fade d-flex" id="tab-2" role="tabpanel" aria-labelledby="product-tab-2">
                            
                            </div>
                        </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection