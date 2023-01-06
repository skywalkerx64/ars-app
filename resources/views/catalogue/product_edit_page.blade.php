@extends('catalogue.layout')

@section('heading')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Edition de produit</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                        <li class="breadcrumb-item"><a href="/catalogue" class="breadcrumb-link">Catalogue</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edition de produit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-2">
    <div class="col-12">
        <form action="/catalogue/produit/{{ $produit->id }}/modifier" method="post" enctype="multipart/form-data">
            @csrf
        <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <h5 class="card-header">Formulaire d'édition</h5>
            <div class="card-body">

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="intitule" class="col-form-label">Intitule</label>
                    <input id="intitule" name="intitule" type="text" class="form-control" placeholder="intitule" value="{{ $produit->intitule }}">
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="description">Description</label>
                    <textarea class="form-control" type="text" id="description" name="description" rows="3" placeholder="description">   {{$produit->description}}</textarea>
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="prix" class="col-form-label">Prix</label>
                    <input id="prix" name="prix" type="number" class="form-control" placeholder="prix" value="{{ $produit->prix }}">
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="prix_alt" class="col-form-label">Prix B</label>
                    <input id="prix_alt" name="prix_alt" type="number" class="form-control" placeholder="prix" value="{{ $produit->prix_2 }}">
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  ">
                    <label for="categorie" class="col-form-label">Catégorie</label>
                    <select class="form-control" id="categorie" name="categorie" placeholder="categorie">
                        <option>{{ $produit->categorie }}</option>
                        @foreach ($categories as $categorie)

                        <option>{{ $categorie->intitule }}</option>

                        @endforeach

                    </select>
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="tag" class="col-form-label">Tag</label>
                    <input id="tag" name="tag" type="text" class="form-control" placeholder="Tag" value="{{ $produit->tag }}">
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="pourcentage" class="col-form-label">Pourcentage</label>
                    <input id="pourcentage" name="pourcentage" type="text" class="form-control" placeholder="pourcentage" value="{{ $produit->pourcentage }}">
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="pourcentage_alt" class="col-form-label">Pourcentage B</label>
                    <input id="pourcentage_alt" name="pourcentage_alt" type="text" class="form-control" placeholder="pourcentage" value="{{ $produit->pourcentage_2 }}">
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="image" class="col-form-label " >Image</label>
                    <input id="image" name="image" type="file" class="form-control" placeholder="image">
                </div>

                <button class="btn btn-success my-3" type="submit">Enregistrer</button>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection