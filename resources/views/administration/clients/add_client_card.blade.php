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
                        <li class="breadcrumb-item active" aria-current="page">Enregistrer un client</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-12">
    <form action="/client/ajouter/carte" method="post">
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
            <label for="Nom" class="col-form-label">Nom</label>
            <input id="nom" name="nom" type="text" class="form-control" placeholder="Nom" required>
        </div>

        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <label for="prenom" class="col-form-label">Prenom</label>
            <input id="prenom" name="prenom" type="text" class="form-control" placeholder="Prenom" required>
        </div>

        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <label for="adresse" class="col-form-label">Adresse</label>
            <input id="adresse" name="adresse" type="text" class="form-control" placeholder="Adresse" required>
        </div>

        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <label for="age" class="col-form-label">Age</label>
            <input id="age" name="age" type="number" class="form-control" placeholder="ans" required>
        </div>

        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <label for="contact" class="col-form-label">Contact</label>
            <input id="contact" name="contact" type="number" class="form-control" placeholder="+229">
        </div>

        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <label for="region" class="col-form-label">Region</label>
            <input id="region" name="region" type="text" class="form-control" placeholder="region" required>
        </div>

        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <label for="Agent" class="col-form-label">Agent assigné</label>
            <select id="Agent" name="agent_id" class="form-control" placeholder="Agent" required>
                <option>{{ $agent->tag }}</option>
            </select>
        </div>
            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  ">
                <label for="Type de carte" class="col-form-label">Type de carte</label>
                <select class="form-control" id="Type_de_carte" name="type" placeholder="Type de carte">
                    @foreach ($types as $type)
                    <option>{{ $type->tag }}</option>
                    @endforeach

                </select>
            </div>


            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="Agent" class="col-form-label">Produit n°1</label>
                <input id="produit_1" name="produit_1_id" type="text" class="form-control" placeholder="Produit n°1" value="{{ old('produit_1_id') }}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="Agent" class="col-form-label">Produit n°2</label>
                <input id="produit_2" name="produit_2_id" type="text" class="form-control" placeholder="Produit n°2" value="{{ old('produit_2_id') }}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="Agent" class="col-form-label">Produit n°3</label>
                <input id="produit_3" name="produit_3_id" type="text" class="form-control" placeholder="Produit n°3" value="{{ old('produit_3_id') }}">
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="Agent" class="col-form-label">Produit n°4</label>
                <input id="produit_4" name="produit_4_id" type="text" class="form-control" placeholder="Produit n°4" value="{{ old('produit_4_id') }}">
            </div>

            <button class="btn btn-primary my-3" type="submit">Enregistrer</button>
        </div>
    </div>
</form>
</div>
@endsection
@section('js')
<script>
    var produits = <?php echo json_encode($produits); ?>;
    autocomplete(document.getElementById("produit_1"), produits);
    autocomplete(document.getElementById("produit_2"), produits);
    autocomplete(document.getElementById("produit_3"), produits);
    autocomplete(document.getElementById("produit_4"), produits);
</script>
@endsection