@extends('catalogue.layout')

@section('heading')
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="page-header">
        <h2 class="pageheader-title">Edition de prix de produit</h2>
        <p class="pageheader-text"></p>
        <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                    <li class="breadcrumb-item"><a href="/catalogue" class="breadcrumb-link">Catalogue</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edition de prix de produit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-2">
    <div class="col-12">
        <form action="/catalogue/produit/prix/changer" method="post">
            @csrf
        <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <h5 class="card-header">Formulaire d'édition</h5>
            <div class="card-body">

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="prix" class="col-form-label">Prix</label>
                    <input id="prix" name="prix" type="number" class="form-control" placeholder="prix" value="{{ $produit->prix }}" required>
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="prix_alt" class="col-form-label">Prix B</label>
                    <input id="prix_alt" name="prix_2" type="number" class="form-control" placeholder="prix" value="{{ $produit->prix_2 }}" required>
                </div>


                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="pourcentage" class="col-form-label">Pourcentage</label>
                    <input id="pourcentage" name="pourcentage" type="text" class="form-control" placeholder="pourcentage" value="{{ $produit->pourcentage }}" required>
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="pourcentage_alt" class="col-form-label">Pourcentage B</label>
                    <input id="pourcentage_alt" name="pourcentage_2" type="text" class="form-control" placeholder="pourcentage" value="{{ $produit->pourcentage_2 }}" required>
                </div>
                <input type="hidden" value="{{$produit->id}}" name="id">

                <button class="btn btn-success my-3" type="submit">Enregistrer</button>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection