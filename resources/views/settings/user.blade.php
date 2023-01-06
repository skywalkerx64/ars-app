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
                        <li class="breadcrumb-item active" aria-current="page">Compte utilisateur</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Informations utilisateur</h2>
        </div>
        <div class="card-body">
            <div class="div my-3 mx-2">
                <span class="text-bold">Username : </span>{{$user_c->name}}
            </div>
            <div class="div my-3 mx-2">
                <span class="text-bold">Email : </span>{{$user_c->email}}
            </div>
            <div class="div my-3 mx-2">
                <span class="text-bold">Administrateur : </span>
                @if ($user_c->admin)
                    <i class="fas fa-circle text-success"></i>
                @endif
                @if (!$user_c->admin)
                    <i class="fas fa-circle text-danger"></i>
                @endif
            </div>
            <div class="div my-3 mx-2">
                <span class="text-bold">Mot de passe (Haché) : </span>{{$user_c->password}}
            </div>
            <div class="flex justiify-end">
                <a href="/utilisateur/{{ $user_c->id }}/editer" class="btn btn-dark mr-3"><i class="mdi mdi-account-edit"></i></a>
                <div class="">
                    <!-- Button trigger modal -->
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-trash" ></i>
                            </a>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </a>
                                </div>
                                <div class="modal-body">
                                    <p>Etes vous sûre de vouloir supprimer le compte utilisateur {{ $user_c->name }}?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn btn-success" data-dismiss="modal">Fermer</a>
                                    <a href="/utilisateur/{{ $user_c->id }}/supprimer" class="btn btn-dark">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection