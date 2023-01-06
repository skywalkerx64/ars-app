@extends('catalogue.layout')

@section('heading')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Ajout de produit </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/catalogue" class="breadcrumb-link">Catalogue</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ajout de produit</li>
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
        <form action="/catalogue/produit/import" method="POST" enctype="multipart/form-data" class="my-3">
            @csrf
            <label for="import" class="mx-2 "> Importer des produits avec un csv</label>
            <input type="file" name="file" id="csv">
    
            <input type="submit" name="" id="" class="btn btn-success mx-3">
        </form>
        <form action="/catalogue/ajouter" method="post" enctype="multipart/form-data">
            @csrf
        <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <h5 class="card-header">Formulaire d'ajout</h5>
            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="intitule" class="col-form-label">Intitule</label>
                    <input id="intitule" name="intitule" type="text" class="form-control" placeholder="intitule" value="{{ old('intitule') }}">
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="description" >{{ old('description') }}</textarea>
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="prix" class="col-form-label">Prix</label>
                    <input id="prix" name="prix" type="number" class="form-control" placeholder="prix" value="{{ old('prix') }}">
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="prix_alt" class="col-form-label">Prix B</label>
                    <input id="prix_alt" name="prix_alt" type="number" class="form-control" placeholder="prix" value="{{ old('prix_alt') }}">
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="tag" class="col-form-label">Tag</label>
                    <input id="tag" name="tag" type="text" class="form-control" placeholder="Tag" value="{{ old('tag') }}">
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="pourcentage" class="col-form-label">Pourcentage </label>
                    <input id="pourcentage" name="pourcentage" type="text" class="form-control" placeholder="pourcentage" value="{{ old('pourcentage') }}">
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <label for="pourcentage_alt" class="col-form-label">Pourcentage B</label>
                    <input id="pourcentage_alt" name="pourcentage_alt" type="text" class="form-control" placeholder="pourcentage" value="{{ old('pourcentage_alt') }}">
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  ">
                    <label for="categorie" class="col-form-label">Catégorie</label>
                    <select class="form-control" id="categorie" name="categorie" placeholder="categorie">
                        @foreach ($categories as $categorie)
                        <option>{{ $categorie->intitule }}</option>
                        @endforeach

                    </select>
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
@endsection