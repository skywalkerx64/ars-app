@extends('fiches.layout')
@section('tab')
<div class="row">
    @php
        use App\Models\Client;
    @endphp
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header"><span class="mx-3">ARS - Fiche de terrain {{ $agent->nom }} {{ $agent->prenom }}</span> | <span class="mx-3">ID: {{ $agent->tag }}</span > | <span class="mx-3">Date: {{ $date }}</span> </h5>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nom prenom et Identifiant</th>
                            <th scope="col">Articles</th>
                            <th scope="col"><p>T.A</p><hr><p>T.C</p></th>
                            <th scope="col"><p>Prix J.</p><hr><p>N. Mises</p></th>
                            <th scope="col">Montant</th>
                            <th scope="col">Adresse Contact</th>
                            <th scope="col">Evolution</th>
                            <th scope="col">Emargement</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartes_all as $carte)
                        @php

                            $client=Client::findorFail($carte->client_id);
                            $ventes=$carte->ventes
                        @endphp
                        <tr>
                            <td class="h6 text-gray-900">{{$client->nom}} {{$client->prenom}} | {{$client->tag}}  <div class="my-2">{{$carte->tag}}</div>  </td>
                            <td class="h6 text-gray-900">
                                @foreach ($ventes as $vente)
                                    <span>
                                        @if ($vente->produit!=null)
                                        {{$vente->produit['intitule']}} | {{$vente->produit['tag']}}
                                        @endif
                                    </span>
                                    <hr class="bg-gray-900">
                                @endforeach
                            </td class="h6 text-gray-900">
                            <td class="h6 text-gray-900">
                                @php
                                    $moto='n';
                                @endphp

                                @foreach ($ventes as $vente)
                                @if ($vente->produit!=null)
                                    @if ($vente->produit['categorie']=='Motocyclette')
                                        @php
                                            $moto='y'
                                        @endphp
                                    @endif
                                @endif    
                                @endforeach
                                @if ($moto=='y')
                                    <span>A.M</span>
                                @else
                                    <span>A.A</span>
                                @endif
                                <hr class="bg-gray-900">
                                @if ($carte->duree==124)
                                    <span>C</span>
                                @endif
                                @if ($carte->duree==186)
                                <span>D</span>
                                @endif
                                @if ($carte->duree==558)
                                <span>B</span>
                                @endif
                                @if ($carte->duree==372)
                                <span>A</span>
                                @endif

                            </td class="h6 text-gray-900">
                            <td class="h6 text-gray-900">
                                {{$carte->cout}}
                                <hr class="bg-gray-900">
                                <div class="h-5"></div>
                            </td class="h6 text-gray-900">
                            <td class="h6 text-gray-900"></td>
                            <td class="h6 text-gray-900">
                                <span>{{$client->adresse}}</span>
                                <hr class="bg-gray-900">
                                <span>{{$client->contact}}</span>
                            </td>
                            
                            <td class="h6 text-gray-900">
                                <hr class="bg-gray-900">
                            </td>
                            <td class="h6 text-gray-900"></td>
                        </tr>  
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection