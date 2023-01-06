@extends('catalogue.layout')

@section('heading')
<div class="row">
    <div class="input-group mb-3 pt-0 col-12">
        <form action="/catalogue/rechercher" method="post" class="d-flex col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
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
<div class="row mt-5">
    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12 col-12">
        <div class="row">
            @if ($produits->isEmpty())
                 <div class="flex justify-center w-full">
                     <div class="h5">Aucun produit trouvé</div>
                 </div> 
            @endif

            @foreach ($produits as $produit)
            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12 h-100">
                <div class="product-thumbnail h-100">
                    <div class="product-img-head">
                        <div class="product-img">
                            <img src="/storage/public/{{$produit->image}}" alt="" class="img-fluid"></div>
                    </div>

                    <div class="product-content">
                        <div class="product-content-head">
                            <h3 class="product-title">{{ $produit->intitule }}</h3>
                            @if ($user->admin)
                            <div class="product-price my-3"> <b>{{ $produit->prix }} XOF</b></div>
                            @if ($produit->categorie=='Motocyclette')
                                <div class="product-price my-3"> <b>{{ $produit->prix_2 }} XOF</b></div>
                            @endif
                            
                            @endif
                            

                            <div class="product-price mb-3"> <b>{{ $produit->prix/372  }}/Jour</b></div>

                            @if ($produit->categorie=='Motocyclette')
                                <div class="product-price"> <b>{{ $produit->prix_2/558  }}/Jour</b></div>
                            @endif
                            
                            <div class="my-2">
                                <h1>Code: {{$produit->tag}}</h1>
                            </div>
                        </div>
                        <div class="product-btn d-flex gap-2">
                            <a href="/catalogue/produit/{{$produit->id}}" class="btn btn-success mx-1">Details</a>
                            @if($user->poste=='Administrateur' && $user->admin)
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
                            <a href="/catalogue/produit/{{$produit->id}}/modifier" class="btn btn-outline-light mx-1"><i class="fas fa-edit"></i></a> 
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="product-sidebar">
            <div class="product-sidebar-widget">
                <h4 class="mb-0">Filtre</h4>
            </div>
            <div class="product-sidebar-widget">
                <h4 class="product-sidebar-widget-title">Catégories</h4>
                <nav class="navbar navbar-expand-lg navbar-light">
                    
                        <ul class="navbar-nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="/catalogue">Toutes</a>
                            </li>
                            @foreach ($categories as $categorie)
                            <li class="nav-item">
                                <a class="nav-link active" href="/catalogue/{{$categorie->intitule}}">{{ $categorie->intitule }}</a>
                            </li> 
                            @endforeach
                            
                        </ul>
                    
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection