@extends('fiches.layout')
@section('tab')
@php
    use App\Models\Paiement;
@endphp
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header"></i>ARS - Fiche de controle de l'agent {{ $agent->nom }} {{ $agent->prenom }} | {{ $agent->tag }} | Date vérifiée: {{$date}} | Date de tirage : {{ now()->format('y.m.d') }}</h5>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Paiement</th>
                            <th scope="col">Date</th>
                            <th scope="col">Date du dernier paiement</th>
                            <th scope="col">Remarque</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartes_all as $carte )
                        @php
                        $paiements=$carte->paiements;
                        $pay=false;
                        $date_p=null;
                        $paiements_p=Paiement::query()
                                        ->where('created_at', 'like', "%{$date}%")
                                        ->get();
                                        foreach ($paiements_p as $paiement_p) 
                                        {
                                            if($paiement_p->carte_id==$carte->id)
                                            {
                                                $pay=true;
                                                $date_p=$paiement_p->created_at;
                                            } 
                                        }
   
                        @endphp
                        <tr>
                            <td class="h6 text-gray-900">{{ $carte->tag }}</td>
                            <td class="h6 text-gray-900">{{ $carte->client->nom}}</td>
                            <td class="h6 text-gray-900">{{ $carte->client->prenom}}</td>
                            <td class="h6 text-gray-900">{{ $carte->client->adresse}}</td>
                        @if ($pay)
                            <td class="h6 text-gray-900">Oui</td>
                            
                            <td class="h6 text-gray-900">{{$date_p}}</td>    
                        @else
                            <td class="h6 text-gray-900">Non</td>
                            <td class="h6 text-gray-900">-</td>    
                        @endif
                            @if ($carte->paiements->last()!=null)
                                <td class="h6 text-gray-900">{{ $carte->paiements->last()->created_at->format('d.m.y')}}</td>
                            @else
                            <td class="h6 text-gray-900">-</td>
                            @endif

                            

                            <td></td>
                        </tr>
                        
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection