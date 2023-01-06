<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App_controller;
use App\Http\Controllers\Admin_controller;
use App\Http\Controllers\Agent_controller;
use App\Http\Controllers\Carte_controller;
use App\Http\Controllers\Fiche_controller;
use App\Http\Controllers\Caisse_controller;
use App\Http\Controllers\Client_controller;
use App\Http\Controllers\Imports_controller;
use App\Http\Controllers\Produit_controller;
use App\Http\Controllers\Setting_controller;
use App\Http\Controllers\Livraison_controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

/* App routes */


Route::group(['middleware' => 'auth'], function () {
    Route::get('/',[Admin_controller::class, 'home']);
    /*Catalogue routes */
    Route::get('catalogue/best',[Produit_controller::class, 'catalogue_best']);
    Route::get('catalogue/best/choices',[Produit_controller::class, 'catalogue_best_choices']);
    Route::get('catalogue',[Produit_controller::class, 'catalogue']);
    Route::get('catalogue/ajouter',[Produit_controller::class, 'add_form']);
    Route::get('catalogue/{categorie}',[Produit_controller::class, 'catalogue_sort_categorie']);
    Route::post('catalogue/ajouter',[Produit_controller::class, 'store_produit']);
    Route::get('catalogue/produit/{id}',[Produit_controller::class, 'product_details']);
    Route::get('catalogue/produit/{id}/modifier',[Produit_controller::class, 'product_edit']);
    Route::post('catalogue/produit/{id}/modifier',[Produit_controller::class, 'product_update']);
    Route::get('catalogue/produit/{id}/supprimer',[Produit_controller::class, 'product_delete']);
    Route::post('catalogue/rechercher',[Produit_controller::class, 'search']);
    Route::post('catalogue/produit/import',[Imports_controller::class, 'products_import']);
    Route::get('/catalogue/produit/{id}/prix/modifier',[Produit_controller::class, 'modify_price_form']);
    Route::post('catalogue/produit/prix/changer',[Produit_controller::class, 'price_change']);

    
    Route::get('administration',[Admin_controller::class, 'admin']);
    /*Clients routes */
    Route::get('client/{id}/migrate',[Agent_controller::class, 'client_migrate_form']);
    Route::post('client/migrate',[Agent_controller::class, 'client_migrate']);
    Route::post('clients/editer',[Client_controller::class, 'edit_store_client']);
    Route::get('clients',[Client_controller::class, 'clients']);
    Route::get('clients/exporter',[Client_controller::class, 'exports']);
    Route::get('client/{id}',[Client_controller::class, 'client']);
    Route::get('client/{id}/exporter',[Client_controller::class, 'export']);
    Route::get('client/{id}/editer',[Client_controller::class, 'client_edit']);
    Route::get('clients/ajouter',[Client_controller::class, 'add_client']);
        Route::get('client/ajouter/carte/{id}',[Client_controller::class, 'add_client_carte']);
        Route::post('client/ajouter/carte',[Client_controller::class, 'store_client_carte']);
    
    Route::get('client/ajouter/{id}',[Client_controller::class, 'add_client_agent']);
    Route::post('clients/ajouter/',[Client_controller::class, 'store_client']);
    Route::post('clients/rechercher',[Client_controller::class, 'search']);

    /*Cartes routes */
    Route::get('/carte/stock',[Carte_controller::class, 'carte_stock']);
    Route::get('/carte/stock/recharger',[Carte_controller::class, 'stock_recharge_form']);
    Route::post('/carte/stock/recharger',[Carte_controller::class, 'stock_recharge']);
    Route::get('client/carte/{id}',[Carte_controller::class, 'carte']);
    Route::get('client/{id}/exporter',[Client_controller::class, 'export']);
    Route::get('client/{id}/cartes/ajouter',[Carte_controller::class, 'add_carte']);
    Route::post('carte/ajouter',[Carte_controller::class, 'store_carte']);
    Route::get('client/carte/{id}',[Carte_controller::class, 'carte']);
    Route::get('client/{client_id}/carte/{carte_id}/supprimer',[Carte_controller::class, 'delete_carte']);
    Route::get('client/{client_id}/carte/{carte_id}/changer',[Carte_controller::class, 'exchange_form']);
    Route::get('/carte/{c_id}/vente/{v_id}/livrer',[Carte_controller::class, 'delivery']);
    Route::post('carte/changer',[Carte_controller::class, 'exchange']);
    /*Paiements */
    Route::get('/client/paiement/verser',[Carte_controller::class, 'payment_form_sample']);
    Route::get('/client/{client_id}/carte/{carte_id}/verser',[Carte_controller::class, 'payment_form']);
    Route::post('client/paiement/ajouter',[Carte_controller::class, 'payment_store']);
    Route::post('client/paiement/csv_import', [Imports_controller::class, 'payment_csv_import']);

    /*Agents */
    Route::get('agents/',[Agent_controller::class, 'agents']);
    Route::get('agents/meilleures',[Agent_controller::class, 'best_agents']);
    Route::get('agent/{id}/migrate/clients',[Agent_controller::class, 'clients_migrate_form']);
    Route::post('agent/migrate/clients',[Agent_controller::class, 'clients_migrate']);
    Route::get('agents/ajouter',[Agent_controller::class, 'add_agent']);
    Route::post('agents/rechercher',[Agent_controller::class, 'search']);
    Route::post('agents/ajouter',[Agent_controller::class, 'store_agent']);
    Route::get('agent/{id}/supervision',[Fiche_controller::class, 'supervision']);
    Route::get('agent/{id}/terrain',[Fiche_controller::class, 'terrain']);
    Route::post('fiche/controle',[Fiche_controller::class, 'controle']);
    Route::get('agent/{id}/editer',[Agent_controller::class, 'edit_agent']);
    Route::post('agent/{id}/editer',[Agent_controller::class, 'update_agent']);
    Route::get('agent/{id}',[Agent_controller::class, 'agent']);

    /*Caisses */
    Route::get('caisses',[Caisse_controller::class, 'caisses']);
    Route::post('caisse/transfert',[Caisse_controller::class, 'store']);
    Route::post('caisse/date',[Caisse_controller::class, 'per_date']);
    Route::get('caisse/transferer/{tag}',[Caisse_controller::class, 'transfert_form']);
    Route::get('caisse/{tag}',[Caisse_controller::class, 'caisse']);

    /*Livraisons */
    Route::get('livraisons',[Livraison_controller::class, 'livraisons']);

    /*Settings */
    Route::get('parametres',[Setting_controller::class, 'agences']);
    Route::get('agence/fusion',[Setting_controller::class, 'agence_fusion_form']);
    Route::post('agence/fusion',[Setting_controller::class, 'agence_fusion']);
    Route::get('agence/ajouter',[Setting_controller::class, 'agence_add']);
    Route::post('agence/ajouter',[Setting_controller::class, 'agence_store']);
    Route::post('agence/rechercher',[Setting_controller::class, 'agence_search']);
    Route::get('agence/{id}',[Setting_controller::class, 'agence']);
    Route::get('user/agence/changer',[Setting_controller::class, 'user_agence_change_form']);
    Route::get('/user/agence/changer/{id}',[Setting_controller::class, 'user_agence_change']);
    Route::get('/agence/{id}/utilisateur/ajouter',[Setting_controller::class, 'user_agence_add_form']);
    Route::post('/agence/user/add',[Setting_controller::class, 'user_store']);
    Route::get('utilisateur/{id}',[Setting_controller::class, 'user']);
    Route::get('utilisateur/{id}/editer',[Setting_controller::class, 'user_edit_form']);
    Route::get('utilisateur/{id}/supprimer/',[Setting_controller::class, 'user_delete']);
    Route::post('utilisateur/editer',[Setting_controller::class, 'user_edit']);
    Route::get('/admin/caisses',[Setting_controller::class, 'caisses']);
    Route::get('/admin/caisse/{id}',[Setting_controller::class, 'caisse']);
    /*departements */
    Route::get('departements',[Setting_controller::class, 'departements']);
    Route::get('departements/ajouter',[Setting_controller::class, 'departements_add']);
    Route::post('departements/ajouter',[Setting_controller::class, 'departements_store']);

    //villes
    Route::get('villes',[Setting_controller::class, 'villes']);
    Route::get('villes/ajouter',[Setting_controller::class, 'villes_add']);
    Route::post('villes/ajouter',[Setting_controller::class, 'villes_store']);

    //quartiers
    Route::get('quartiers',[Setting_controller::class, 'quartiers']);
    Route::get('quartiers/ajouter',[Setting_controller::class, 'quartiers_add']);
    Route::post('quartiers/ajouter',[Setting_controller::class, 'quartiers_store']);
    });

