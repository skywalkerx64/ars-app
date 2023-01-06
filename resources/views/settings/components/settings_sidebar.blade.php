@if($user->admin)
<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column mt-3">
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-2"><i class="mdi mdi-home-modern"></i>Agences</a>
                        <div id="submenu-3" class="submenu collapse" style="">
                            <ul class="nav flex-column">
                                <a class="nav-link" href="/parametres"><i class="mdi mdi-home-modern"></i>Agences<span class="badge badge-secondary">New</span></a>
                                @if($user->poste=='Administrateur' && $user->admin)
                                <li class="nav-item">
                                    <a class="nav-link" href="/agence/ajouter"><i class="fas fa-plus"></i>Créer une agence<span class="badge badge-secondary">New</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/agence/fusion"><i class="mdi mdi-vector-union"></i>Fusionner deux agences<span class="badge badge-secondary">New</span></a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="mdi mdi-map-marker-radius"></i>Localités</a>
                        <div id="submenu-2" class="submenu collapse" style="">
                            <ul class="nav flex-column">
                                <a class="nav-link" href="/departements"><i class=""></i>Départements<span class="badge badge-secondary">New</span></a>
                                <li class="nav-item">
                                    <a class="nav-link" href="/villes"><i class=""></i>Villes<span class="badge badge-secondary">New</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/quartiers"><i class=""></i>Quartiers<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/caisses"><i class="mdi mdi-wallet"></i>Caisses<span class="badge badge-secondary">New</span></a>
                    </li>  
                    
                    
                    
                </ul>
            </div>
        </nav>
    </div>
</div>
@endif