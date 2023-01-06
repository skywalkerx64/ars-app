@extends('settings.layout')
@section('heading')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Agence</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editer un compte utilisateur</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-12">
    <form action="/utilisateur/editer" method="post">
        @csrf
    <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
        <h5 class="card-header">Informations utilisateur</h5>
        <div class="card-body">
            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="Nom" class="col-form-label">Nom</label>
                <input id="nom" name="name" type="text" class="form-control" placeholder="Nom" value="{{ $user_c->name }}" required>
            </div>
            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="email" class="col-form-label">Email</label>
                <input id="email" name="email" type="email" class="form-control" placeholder="email" value="{{ $user_c->email }}" required>
            </div>

            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="password" class="col-form-label">Mot de passe</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="password" required>
            </div>
            @if($user->admin)
            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  ">
                <label for="admin" class="col-form-label">Administrateur ?</label>
                <select class="form-control" id="admin" name="admin" placeholder="admin">
                    <option value="">Non</option>
                    <option value="">Oui</option>
                </select>
            </div>
        
            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="agence" class="col-form-label">Agence assignée</label>
                <select id="agence" name="agence_id" class="form-control" placeholder="agence">
                    @foreach ($agences as $agence)
                    <option>{{ $agence->tag }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <input id="id" name="id" type="hidden" value="{{$user_c->id}}">

            <button class="btn btn-success my-3" type="submit">Enregistrer</button>
        </div>
    </div>
</form>
</div>
@endsection