@extends('administration.cartes.layout')

@section('heading')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Cartes</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                        <li class="breadcrumb-item"><a href="/administration" class="breadcrumb-link">Administration</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Recharger cartes</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

</div>
@endsection

@section('content')
<div class="col-12">
    <form action="/carte/stock/recharger" method="post">
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

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  ">
                <label for="Type de carte" class="col-form-label">Type de carte</label>
                <select class="form-control" id="Type_de_carte" name="type" placeholder="Type de carte">
                    @foreach ($types as $type)
                    <option>{{ $type->tag }}</option>
                    @endforeach

                </select>
            </div>


            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="quantite" class="col-form-label">Quantité</label>
                <input id="quantite" name="quantite" type="number" class="form-control" placeholder="quantite">
            </div>



            <button class="btn btn-success my-3" type="submit">Enregistrer</button>
        </div>
    </div>
</form>
</div>
@endsection