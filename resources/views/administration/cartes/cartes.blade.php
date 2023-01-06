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
                        <li class="breadcrumb-item active" aria-current="page">Cartes</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">Total cartes</h5>
                        <h2 class="mb-0 text-2xl">{{$count}}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                        <i class="fas fa-book fa-fw fa-sm text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if($user->poste=='Administrateur' && $user->admin)
        <a href="/carte/stock/recharger" class="btn btn-success mx-3 my-3">Recharger</a>
        @endif
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Stocks</h5>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                                <th scope="col">Type</th>
                                <th scope="col">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartes as $carte)
                            
                            <tr>
        
                                <td>Carte {{ $carte->tag }}</td>
                                <td>{{ $carte->stock }}</td>


                                
                                
                            </tr>
                            
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>   
@endsection