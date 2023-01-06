@extends('administration.caisses.layout')

@section('heading')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Caisses</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Alpha Rehma Services</a></li>
                        <li class="breadcrumb-item"><a href="/administration" class="breadcrumb-link">Administration</a></li>
                        <li class="breadcrumb-item"><a href="/caisses" class="breadcrumb-link">Caisses</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $caisse->intitule }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="card col-12">
        <div class="card-header">
            <h3 class="my-1 text-xl">{{ $caisse->intitule }}</h3>
        </div>
        <div class="card-body">
            <div class="row flex flex-row">
                <p>
                    <span class="h6">Solde:</span> {{ $caisse->solde }} XOF
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
        <div class="col-3">
    <form action="/caisse/date" method="post" class="flex items-center">
            @csrf
                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <input id="date" name="date" type="date" class="form-control" placeholder="Diplome">
                </div>
                <input type="hidden" value="{{ $caisse->id }}" name="caisse_id">
    
                <button class="btn btn-success my-3" type="submit">Charger</button>
        </form>
        </div>
    @if ($caisse->tag=='CA' && ($user->poste=='Chef agence' || $user->poste=='Administrateur'))
        <a href="/caisse/transferer/{{$caisse->tag}}" class="btn btn-success my-2 mx-32">Transferer</a>
    @endif
    
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header"> <i class="mdi mdi-swap-horizontal"></i>Transactions</h5>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Motif</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction )
                        
                        <tr>
    
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->montant }} XOF</td>
                            <td>{{ $transaction->statut }}</td>
                            <td>{{ $transaction->motif }}</td>
                            <td>{{ $transaction->created_at }}</td>
                        </tr>
                        
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection