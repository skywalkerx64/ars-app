<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Client;
use App\Models\Paiement;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification_livraison;

class Paiement_controller extends Controller
{
    public static function pay($carte, $montant)
    {
        $user=Auth::user();
        $agence=$user->agence;
        $caisses=$agence->caisses;
        //update la carte
        if(($montant/$carte->cout)>$carte->tranches)
        {
            $error_message='Le montant entré excède le montant restant à payer';
            return view('errors.error_page',compact('error_message'));
        }
        else
        {
        $carte->tranches=$carte->tranches-($montant/$carte->cout);
        if($carte->tranches==0)
        {
            $carte->completed=1;
        }
        //update evolution
        $evolution=$carte->evolution;
        //Dispatch
        if($evolution->mois==1) //est-ce qu'on est dans le premier moi?
        {
            switch($carte->duree)
            {
                case 124:   //pour les cartes de 124 jours
                   if ($evolution->jour<4)
                   {
                        if($montant/$carte->cout>(4-$evolution->jour))//si on déborde
                        {
                            $transaction1=new Transaction;
                            $transaction1->montant=(4-$evolution->jour)*$carte->cout;
                            $transaction1->caisse_id=$caisses->where('tag', 'C1')->first()->id;
                            $transaction1->motif='Paiement de carte C1';
                            $transaction1->save();
                            $reste=$montant-$transaction1->montant; //le nombre de paiements de surplus
                            if($reste/$carte->cout>2) //on vérifie si ça déborde
                            {
                                $transaction2=new Transaction;
                                $transaction2->montant=(2)*$carte->cout;
                                $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                $transaction2->motif='Paiement de carte C2';
                                $transaction2->save();
                                $reste-=$transaction2->montant;
                                //on enregistre ce qui déborde

                                $transaction3=new Transaction; //separation des benefices
                                $transaction3->montant=($reste/$carte->cout)*$carte->pourcentage;
                                $transaction3->caisse_id=$caisses->where('tag', 'B')->first()->id;
                                $transaction3->motif='Bénéfice';
                                $transaction3->save();

                                $transaction4=new Transaction;
                                $transaction4->montant= $reste-$transaction3->montant;
                                $transaction4->caisse_id=$caisses->where('tag', 'C3')->first()->id;
                                $transaction4->motif='Paiement de carte C3';
                                $transaction4->save();

                            }
                            else
                            {
                                $transaction2=new Transaction;
                                $transaction2->montant=$reste;
                                $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                $transaction2->motif='Paiement de carte C2';
                                $transaction2->save();
                            }


                        }
                        else
                        {
                                $transaction1=new Transaction;
                                $transaction1->montant=$montant;
                                $transaction1->caisse_id=$caisses->where('tag', 'C1')->first()->id;
                                $transaction1->motif='Paiement de carte C1';
                                $transaction1->save();
                        }
                   }
                   if ($evolution->jour>=4 && $evolution->jour<6)
                   {
                    if($montant/$carte->cout>2) //on vérifie si ça déborde
                            {
                                $transaction2=new Transaction;
                                $transaction2->montant=(2)*$carte->cout;
                                $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                $transaction2->motif='Paiement de carte C2';
                                $transaction2->save();
                                $reste=$montant-$transaction2->montant;
                                //on enregistre ce qui déborde

                                $transaction3=new Transaction; //separation des benefices
                                $transaction3->montant=($reste/$carte->cout)*$carte->pourcentage;
                                $transaction3->caisse_id=$caisses->where('tag', 'B')->first()->id;
                                $transaction3->motif='Bénéfice';
                                $transaction3->save();

                                $transaction4=new Transaction;
                                $transaction4->montant= $reste-$transaction3->montant;
                                $transaction4->caisse_id=$caisses->where('tag', 'C3')->first()->id;
                                $transaction4->motif='Paiement de carte C3';
                                $transaction4->save();

                            }
                            else
                            {
                                $transaction2=new Transaction;
                                $transaction2->montant=$montant;
                                $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                $transaction2->motif='Paiement de carte C2';
                                $transaction2->save();
                            }
                   }
                   if ($evolution->jour>=6)
                   {
                    $transaction3=new Transaction; //separation des benefices
                    $transaction3->montant=($montant/$carte->cout)*$carte->pourcentage;
                    $transaction3->caisse_id=$caisses->where('tag', 'B')->first()->id;
                    $transaction3->motif='Bénéfice';
                    $transaction3->save();

                    $transaction4=new Transaction;
                    $transaction4->montant= $montant-$transaction3->montant;
                    $transaction4->caisse_id=$caisses->where('tag', 'C3')->first()->id;
                    $transaction4->motif='Paiement de carte C3';
                    $transaction4->save();
                   }

                break;

                case 186:  //pour les cartes de 186 jours
                    if ($evolution->jour<6)
                        {
                             if($montant/$carte->cout>(6-$evolution->jour))//si on déborde
                             {
                                 $transaction1=new Transaction;
                                 $transaction1->montant=(6-$evolution->jour)*$carte->cout;
                                 $transaction1->caisse_id=$caisses->where('tag', 'C1')->first()->id;
                                 $transaction1->motif='Paiement de carte C1';
                                 $transaction1->save();
                                 $reste=$montant-$transaction1->montant; //le nombre de paiements de surplus
                                 if($reste/$carte->cout>3) //on vérifie si ça déborde
                                 {
                                     $transaction2=new Transaction;
                                     $transaction2->montant=(3)*$carte->cout;
                                     $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                     $transaction2->motif='Paiement de carte C2';
                                     $transaction2->save();
                                     $reste-=$transaction2->montant;
                                     //on enregistre ce qui déborde
     
                                     $transaction3=new Transaction; //separation des benefices
                                     $transaction3->montant=($reste/$carte->cout)*$carte->pourcentage;
                                     $transaction3->caisse_id=$caisses->where('tag', 'B')->first()->id;
                                     $transaction3->motif='Bénéfice';
                                     $transaction3->save();
     
                                     $transaction4=new Transaction;
                                     $transaction4->montant= $reste-$transaction3->montant;
                                     $transaction4->caisse_id=$caisses->where('tag', 'C3')->first()->id;
                                     $transaction4->motif='Paiement de carte C3';
                                     $transaction4->save();
     
                                 }
                                 else
                                 {
                                     $transaction2=new Transaction;
                                     $transaction2->montant=$reste;
                                     $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                     $transaction2->motif='Paiement de carte C2';
                                     $transaction2->save();
                                 }
     
     
                             }
                             else
                             {
                                     $transaction1=new Transaction;
                                     $transaction1->montant=$montant;
                                     $transaction1->caisse_id=$caisses->where('tag', 'C1')->first()->id;
                                     $transaction1->motif='Paiement de carte C1';
                                     $transaction1->save();
                             }
                        }
                        if ($evolution->jour>=6 && $evolution->jour<9)
                        {
                         if($montant/$carte->cout>3) //on vérifie si ça déborde
                                 {
                                     $transaction2=new Transaction;
                                     $transaction2->montant=(3)*$carte->cout;
                                     $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                     $transaction2->motif='Paiement de carte C2';
                                     $transaction2->save();
                                     $reste=$montant-$transaction2->montant;
                                     //on enregistre ce qui déborde
     
                                     $transaction3=new Transaction; //separation des benefices
                                     $transaction3->montant=($reste/$carte->cout)*$carte->pourcentage;
                                     $transaction3->caisse_id=$caisses->where('tag', 'B')->first()->id;
                                     $transaction3->motif='Bénéfice';
                                     $transaction3->save();
     
                                     $transaction4=new Transaction;
                                     $transaction4->montant= $reste-$transaction3->montant;
                                     $transaction4->caisse_id=$caisses->where('tag', 'C3')->first()->id;
                                     $transaction4->motif='Paiement de carte C3';
                                     $transaction4->save();
     
                                 }
                                 else
                                 {
                                     $transaction2=new Transaction;
                                     $transaction2->montant=$montant;
                                     $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                     $transaction2->motif='Paiement de carte C2';
                                     $transaction2->save();
                                 }
                        }
                        if ($evolution->jour>=9)
                        {
                         $transaction3=new Transaction; //separation des benefices
                         $transaction3->montant=($montant/$carte->cout)*$carte->pourcentage;
                         $transaction3->caisse_id=$caisses->where('tag', 'B')->first()->id;
                         $transaction3->motif='Bénéfice';
                         $transaction3->save();
     
                         $transaction4=new Transaction;
                         $transaction4->montant= $montant-$transaction3->montant;
                         $transaction4->caisse_id=$caisses->where('tag', 'C3')->first()->id;
                         $transaction4->motif='Paiement de carte C3';
                         $transaction4->save();
                        }
                break;

                case 372:   //pour les cartes de 372 jours
                    if ($evolution->jour<12)
                    {
                         if($montant/$carte->cout>(12-$evolution->jour))//si on déborde
                         {
                             $transaction1=new Transaction;
                             $transaction1->montant=(12-$evolution->jour)*$carte->cout;
                             $transaction1->caisse_id=$caisses->where('tag', 'C1')->first()->id;
                             $transaction1->motif='Paiement de carte C1';
                             $transaction1->save();
                             $reste=$montant-$transaction1->montant; //le nombre de paiements de surplus
                             if($reste/$carte->cout>6) //on vérifie si ça déborde
                             {
                                 $transaction2=new Transaction;
                                 $transaction2->montant=(6)*$carte->cout;
                                 $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                 $transaction2->motif='Paiement de carte C2';
                                 $transaction2->save();
                                 $reste-=$transaction2->montant;
                                 //on enregistre ce qui déborde
 
                                 $transaction3=new Transaction; //separation des benefices
                                 $transaction3->montant=($reste/$carte->cout)*$carte->pourcentage;
                                 $transaction3->caisse_id=$caisses->where('tag', 'B')->first()->id;
                                 $transaction3->motif='Bénéfice';
                                 $transaction3->save();
 
                                 $transaction4=new Transaction;
                                 $transaction4->montant= $reste-$transaction3->montant;
                                 $transaction4->caisse_id=$caisses->where('tag', 'C3')->first()->id;
                                 $transaction4->motif='Paiement de carte C3';
                                 $transaction4->save();
 
                             }
                             else
                             {
                                 $transaction2=new Transaction;
                                 $transaction2->montant=$reste;
                                 $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                 $transaction2->motif='Paiement de carte C2';
                                 $transaction2->save();
                             }
 
 
                         }
                         else
                         {
                                 $transaction1=new Transaction;
                                 $transaction1->montant=$montant;
                                 $transaction1->caisse_id=$caisses->where('tag', 'C1')->first()->id;
                                 $transaction1->motif='Paiement de carte C1';
                                 $transaction1->save();
                         }
                    }
                    if ($evolution->jour>=12 && $evolution->jour<18)
                    {
                     if($montant/$carte->cout>6) //on vérifie si ça déborde
                             {
                                 $transaction2=new Transaction;
                                 $transaction2->montant=(6)*$carte->cout;
                                 $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                 $transaction2->motif='Paiement de carte C2';
                                 $transaction2->save();
                                 $reste=$montant-$transaction2->montant;
                                 //on enregistre ce qui déborde
 
                                 $transaction3=new Transaction; //separation des benefices
                                 $transaction3->montant=($reste/$carte->cout)*$carte->pourcentage;
                                 $transaction3->caisse_id=$caisses->where('tag', 'B')->first()->id;
                                 $transaction3->motif='Bénéfice';
                                 $transaction3->save();
 
                                 $transaction4=new Transaction;
                                 $transaction4->montant= $reste-$transaction3->montant;
                                 $transaction4->caisse_id=$caisses->where('tag', 'C3')->first()->id;
                                 $transaction4->motif='Paiement de carte C3';
                                 $transaction4->save();
 
                             }
                             else
                             {
                                 $transaction2=new Transaction;
                                 $transaction2->montant=$montant;
                                 $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                 $transaction2->motif='Paiement de carte C2';
                                 $transaction2->save();
                             }
                    }
                    if ($evolution->jour>=18)
                    {
                     $transaction3=new Transaction; //separation des benefices
                     $transaction3->montant=($montant/$carte->cout)*$carte->pourcentage;
                     $transaction3->caisse_id=$caisses->where('tag', 'B')->first()->id;
                     $transaction3->motif='Bénéfice';
                     $transaction3->save();
 
                     $transaction4=new Transaction;
                     $transaction4->montant= $montant-$transaction3->montant;
                     $transaction4->caisse_id=$caisses->where('tag', 'C3')->first()->id;
                     $transaction4->motif='Paiement de carte C3';
                     $transaction4->save();
                    }
 
                break;

                case 558:   //pour les cartes de 558 jours
                    if ($evolution->jour<18)
                    {
                         if($montant/$carte->cout>(18-$evolution->jour))//si on déborde
                         {
                             $transaction1=new Transaction;
                             $transaction1->montant=(18-$evolution->jour)*$carte->cout;
                             $transaction1->caisse_id=$caisses->where('tag', 'C1')->first()->id;
                             $transaction1->motif='Paiement de carte C1';
                             $transaction1->save();
                             $reste=$montant-$transaction1->montant; //le nombre de paiements de surplus
                             if($reste/$carte->cout>9) //on vérifie si ça déborde
                             {
                                 $transaction2=new Transaction;
                                 $transaction2->montant=(9)*$carte->cout;
                                 $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                 $transaction2->motif='Paiement de carte C2';
                                 $transaction2->save();
                                 $reste-=$transaction2->montant;
                                 //on enregistre ce qui déborde
 
                                 $transaction3=new Transaction; //separation des benefices
                                 $transaction3->montant=($reste/$carte->cout)*$carte->pourcentage;
                                 $transaction3->caisse_id=$caisses->where('tag', 'B')->first()->id;
                                 $transaction3->motif='Bénéfice';
                                 $transaction3->save();
 
                                 $transaction4=new Transaction;
                                 $transaction4->montant= $reste-$transaction3->montant;
                                 $transaction4->caisse_id=$caisses->where('tag', 'C3')->first()->id;
                                 $transaction4->motif='Paiement de carte C3';
                                 $transaction4->save();
 
                             }
                             else
                             {
                                 $transaction2=new Transaction;
                                 $transaction2->montant=$reste;
                                 $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                 $transaction2->motif='Paiement de carte C2';
                                 $transaction2->save();
                             }
 
 
                         }
                         else
                         {
                                 $transaction1=new Transaction;
                                 $transaction1->montant=$montant;
                                 $transaction1->caisse_id=$caisses->where('tag', 'C1')->first()->id;
                                 $transaction1->motif='Paiement de carte C1';
                                 $transaction1->save();
                         }
                    }
                    if ($evolution->jour>=18 && $evolution->jour<27)
                    {
                     if($montant/$carte->cout>9) //on vérifie si ça déborde
                             {
                                 $transaction2=new Transaction;
                                 $transaction2->montant=(9)*$carte->cout;
                                 $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                 $transaction2->motif='Paiement de carte C2';
                                 $transaction2->save();
                                 $reste=$montant-$transaction2->montant;
                                 //on enregistre ce qui déborde
 
                                 $transaction3=new Transaction; //separation des benefices
                                 $transaction3->montant=($reste/$carte->cout)*$carte->pourcentage;
                                 $transaction3->caisse_id=$caisses->where('tag', 'B')->first()->id;
                                 $transaction3->motif='Bénéfice';
                                 $transaction3->save();
 
                                 $transaction4=new Transaction;
                                 $transaction4->montant= $reste-$transaction3->montant;
                                 $transaction4->caisse_id=$caisses->where('tag', 'C3')->first()->id;
                                 $transaction4->motif='Paiement de carte C3';
                                 $transaction4->save();
 
                             }
                             else
                             {
                                 $transaction2=new Transaction;
                                 $transaction2->montant=$montant;
                                 $transaction2->caisse_id=$caisses->where('tag', 'C2')->first()->id;
                                 $transaction2->motif='Paiement de carte C2';
                                 $transaction2->save();
                             }
                    }
                    if ($evolution->jour>=27)
                    {
                     $transaction3=new Transaction; //separation des benefices
                     $transaction3->montant=($montant/$carte->cout)*$carte->pourcentage;
                     $transaction3->caisse_id=$caisses->where('tag', 'B')->first()->id;
                     $transaction3->motif='Bénéfice';
                     $transaction3->save();
 
                     $transaction4=new Transaction;
                     $transaction4->montant= $montant-$transaction3->montant;
                     $transaction4->caisse_id=$caisses->where('tag', 'C3')->first()->id;
                     $transaction4->motif='Paiement de carte C3';
                     $transaction4->save();
                    }
 
                break;
            } 
        }
else
{

    $transaction1=new Transaction; //separation des benefices
    $transaction1->montant=($montant/$carte->cout)*$carte->pourcentage;
    $transaction1->caisse_id=$caisses->where('tag', 'B')->first()->id;
    $transaction1->motif='Bénéfice';
    $transaction1->save();

    $transaction2=new Transaction;
    $transaction2->montant= $montant-$transaction1->montant;
    $transaction2->caisse_id=$caisses->where('tag', 'C3')->first()->id;
    $transaction2->motif='Paiement de carte C3';
    $transaction2->save();

}
        $jour=$evolution->jour+$montant/$carte->cout;
        $evolution->jour=$jour%31;
        $mois=$jour/31;
        $evolution->mois+=floor($mois);
        $evolution->save();

        $payment= new Paiement;
        $payment->client_id=$carte->client_id;
        $payment->agent_id=$carte->agent_id;
        $payment->carte_id=$carte->id;
        $payment->montant=$montant;
        $payment->save();
        $carte->save();
        //Notifications
        $ventes=$carte->ventes;
        $moto=false;
        $vente_count=0;
        foreach($ventes as $vente)
        {
            if($vente->produit_id!=null)//vente existe?
            {
                if($vente->produit->categorie=='Motocyclette')//si moto
                {
                    $moto=true;
                }
                $vente_count++;
            }
        }
        if($vente_count==1)//non combiné
        {
            if($carte->tranches==0)
            {
                $notification=new Notification_livraison;
                $notification->intitule='Carte Payée';
                $notification->agence_id=$agence->id;
                $notification->categorie='NC';
                $notification->carte_id=$carte->id;
                $notification->echeance=$carte->tranches;
                $notification->save();
            }
                if($evolution->mois>=11 && $carte->tranches!=0)
                {
                    $notification=new Notification_livraison;
                    $notification->intitule='Livraison des produits et finalisation des paiements apres';
                    $notification->agence_id=$agence->id;
                    $notification->categorie='NC';
                    $notification->carte_id=$carte->id;
                    $notification->echeance=$carte->tranches;
                    $notification->save();
                }
        }
        if($vente_count>1)//combiné
        {
            if($carte->tranches==0)
            {
                $notification=new Notification_livraison;
                $notification->intitule='Carte Payée';
                $notification->agence_id=$agence->id;
                $notification->categorie='NC';
                $notification->carte_id=$carte->id;
                $notification->echeance=$carte->tranches;
                $notification->save();
            }
            if($carte->cout<=75 && $carte->tranches!=0)//combiné 1
            {
                if($evolution->mois>=3)
                {
                        $notification=new Notification_livraison;
                        $notification->intitule='Livraison des produits et finalisation des paiements apres';
                        $notification->agence_id=$agence->id;
                        $notification->categorie='C';
                        $notification->carte_id=$carte->id;
                        $notification->echeance=$carte->tranches;
                        $notification->save();
                    
                }
            }

            if($carte->cout>=100 && $carte->tranches!=0)//combiné 2
            {   
                if($evolution->mois>=7 &&  $evolution->mois<=8)
                {
                    if($carte->LP)
                    {
                        $notification=new Notification_livraison;
                        $notification->intitule='Livraison du reste des produits et finalisation des paiements apres';
                        $notification->statut='LP';
                        $notification->agence_id=$agence->id;
                        $notification->categorie='C';
                        $notification->carte_id=$carte->id;
                        $notification->echeance=$carte->tranches;
                        $notification->save();
                    }
                    else
                    {
                        $notification=new Notification_livraison;
                        $notification->intitule='Livraison du produit';
                        $notification->agence_id=$agence->id;
                        $notification->categorie='C';
                        $notification->carte_id=$carte->id;
                        $notification->echeance=(7*31)-($carte->duree-$carte->tranches);
                        $notification->save();
                    }
                }
            }

        }

        if($moto)//Motos
        {
            if($carte->tranches==0)
            {
                $notification=new Notification_livraison;
                $notification->intitule='Carte Payée';
                $notification->agence_id=$agence->id;
                $notification->categorie='NC';
                $notification->carte_id=$carte->id;
                $notification->echeance=$carte->tranches;
                $notification->save();
            }
            if($carte->duree==372 && $carte->tranches!=0)
            {
                if($evolution->mois>=8 && $evolution->mois<=10)
                {
                    if($carte->LP)
                    {
                        $notification=new Notification_livraison;
                        $notification->intitule='Finalisation des paiements apres';
                        $notification->statut='LP';
                        $notification->agence_id=$agence->id;
                        $notification->categorie='C';
                        $notification->carte_id=$carte->id;
                        $notification->echeance=$carte->tranches;
                        $notification->save();
                    }
                    else
                    {
                        $notification=new Notification_livraison;
                        $notification->intitule='Livraison du produit';
                        $notification->agence_id=$agence->id;
                        $notification->categorie='C';
                        $notification->carte_id=$carte->id;
                        $notification->echeance=(11*31)-($carte->duree-$carte->tranches);
                        $notification->save();
                    }
                }
            }
            elseif($carte->duree==558 && $carte->tranches!=0)
            {
                if($evolution->mois>=13 && $evolution->mois<=15)
                {
                    $notification=new Notification_livraison;
                    $notification->agence_id=$agence->id;
                    $notification->categorie='M';
                    $notification->carte_id=$carte->id;
                    $notification->echeance=(31*13)-($carte->duree-$carte->tranches);
                    $notification->save();
                }
            }
            
        }


    }
    }
}
