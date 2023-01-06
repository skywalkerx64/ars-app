@extends('fiches.layout')
@section('tab')
<div class="row">
    @php
        use App\Models\Client;
    @endphp
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header"></i>ARS - Fiche de supervision de l'agent {{ $agent->nom }} {{ $agent->prenom }} | {{ $agent->tag }} | {{ now() }}</h5>
            <div class="card-body">
                <table class="table table-striped" style="font-weight:bold;">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Adresse</th>
                            
                            <th scope="col">Articles</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Dernier paiement</th>
                            <th scope="col">Date</th>
                            <th scope="col">Dernier gros paiement</th>
                            <th scope="col">Date</th>
                            <th scope="col">Evolution 1</th>
                            <th scope="col">Evolution 2</th>
                            <th scope="col">Remarque</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartes_all as $carte )
                        @php
                            $client=Client::findorFail($carte->client_id);
                            $ventes=$carte->ventes
                        @endphp
                        <tr style="font-weight:bold;">
    
                            <td class="h6 text-gray-900">{{ $carte->tag }}</td>
                            <td class="h6 text-gray-900">{{ $carte->client->nom}}</td>
                            <td class="h6 text-gray-900">{{ $carte->client->prenom}}</td>
                            <td class="h6 text-gray-900">{{ $carte->client->contact}}</td>
                            <td class="h6 text-gray-900">{{ $carte->client->adresse}}</td>
                            
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
                            <td class="h6 text-gray-900">{{ $carte->cout}} XOF/j</td>
                            <td class="h6 text-gray-900">{{ $carte->last_pay}}</td>
                            <td class="h6 text-gray-900">{{ $carte->last_pay_date}}</td>
                            <td class="h6 text-gray-900">{{ $carte->last_big_pay}}</td>
                            <td class="h6 text-gray-900">{{ $carte->last_big_pay_date}}</td>
                            <td class="h6 text-gray-900">{{ $carte->evolution->mois}}/{{ $carte->evolution->jour}}</td>
                            <td class="h6 text-gray-900"></td>
                            <td class="h6 tegray-900"></td>
                        </tr>
                        
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection