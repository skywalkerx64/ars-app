@extends('catalogue.layout')

@section('heading')
<div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Meilleures produits</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                        <li class="breadcrumb-item"><a href="/administration" class="breadcrumb-link">Administration</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Meilleures produits</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
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

<div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                                    <h5 class="card-header">Meilleurs produits</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0">Code</th>
                                                        <th class="border-0">Image</th>
                                                        <th class="border-0">Intitule</th>
                                                        <th class="border-0">Pourcentage</th>
                                                        <th class="border-0">Prix</th>
                                                        <th class="border-0">Prix B</th>
                                                        <th class="border-0">Pourcentage B</th>
                                                        <th class="border-0">Revenus</th>
                                                        <th class="border-0">Ventes</th>
                                                        <th class="border-0">Détails</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($produits as $produit)
                                                    <tr>
                                                        <td>{{ $produit->tag }}</td>
                                                        <td>
                                                            <div class="m-r-10"><img src="/storage/public/{{$produit->image}}" alt="user" class="rounded" width="45"></div>
                                                        </td>
                                                        <td>{{ $produit->intitule }} </td>
                                                        <td>{{ $produit->pourcentage }}</td>
                                                        <td>{{ $produit->prix/372 }}</td>
                                                        @if($produit->categorie=='Motocyclette')
                                                        <td>{{ $produit->pourcentage_2 }}</td>
                                                        <td>{{ $produit->prix_2/558 }}</td>
                                                        @else
                                                        <td>-</td>
                                                        <td>-</td>
                                                        @endif
                                                        
                                                        <td>{{ $produit->revenus }}</td>
                                                        <td>{{ $produit->vente_count }}</td>
                                                        <td><span><a href="/catalogue/produit/{{$produit->id}}">Details</a></span></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
        </div>
    </div> 

@endsection