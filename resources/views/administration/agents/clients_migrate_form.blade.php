@extends('administration.agents.layout')

@section('heading')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Agents</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                        <li class="breadcrumb-item"><a href="/administration" class="breadcrumb-link">Administration</a></li>
                        <li class="breadcrumb-item"><a href="/agents" class="breadcrumb-link">Agents</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Migration de clients</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="input-group mb-3 pt-0 col-12">
        <form action="/agents/rechercher" method="post" class="d-flex col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
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
<div class="col-12">
    <form action="/agent/migrate/clients" method="post">
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
                <label for="Id agent" class="col-form-label">Id agent</label>
                <input id="agent" name="agent" type="text" class="form-control" placeholder="agent" value="{{ $agent->tag }}">
            </div>
                <input name="id" type="hidden" value="{{ $agent->id }}">
                
            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <label for="agence" class="col-form-label">Agent destination</label>
                <select id="agence" name="agent_d" class="form-control" placeholder="agence">
                    @foreach ($agents as $agent)
                    <option>{{ $agent->tag }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success my-3" type="submit">Enregistrer</button>
        </div>
    </div>
</form>
</div>
@endsection