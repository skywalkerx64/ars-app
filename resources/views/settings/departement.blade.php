@extends('settings.layout')
@section('heading')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Agences</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Départements</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
@if($user->poste=='Administrateur' && $user->admin)
<div class="row">
    <a href="departements/ajouter" class="btn btn-success mx-3 my-3">Ajouter</a>
</div>
@endif
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Departements</h5>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Tag</th>
                            
    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departements as $departement)
                        <tr>
                            <td>{{ $departement->nom }}</td>
                            <td>{{ $departement->tag }}</td>
                            
                            
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection