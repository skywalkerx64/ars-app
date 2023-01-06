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
                        <li class="breadcrumb-item active" aria-current="page">Meilleures agents</li>
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
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">Total Agents</h5>
                        <h2 class="mb-0 text-2xl">{{$agents->count()}}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                        <i class="fa fa-user fa-fw fa-sm text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">Total Clients</h5>
                        <h2 class="mb-0 text-2xl"> {{$clients->count()}} </h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-secondary-light mt-1">
                        <i class="fa fa-handshake fa-fw fa-sm text-secondary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Agents</h5>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Diplome</th>
                                <th scope="col">Plus</th>
                                @if ($user->admin)
                                <th><i class="fas fa-ellipsis-h text-dark"></i></th>
                                @endif
                                
        
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agents as $agent)
                            
                            <tr>
        
                                <td>{{ $agent->tag }}</td>
                                <td>{{ $agent->nom }}</td>
                                <td>{{ $agent->prenom }}</td>
                                <td>{{ $agent->adresse }}</td>
                                <td>{{ $agent->contact }}</td>
                                <td>{{ $agent->diplome }}</td>
                                <td><a href="/agent/{{ $agent->id }}">Détails</a></td>
                                @if ($user->admin)
                                <td><a href="/agent/{{ $agent->id }}/editer"><i class="far fa-edit"></i></a></td>
                                @endif
                                
                                
                            </tr>
                            
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>   
@endsection