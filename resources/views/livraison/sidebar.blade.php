<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column mt-3">

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-users"></i>Clients</a>
                        <div id="submenu-2" class="submenu collapse" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/clients"><i class="fas fa-list"></i>Clients<span class="badge badge-secondary">New</span></a>
                                </li>
                                @if($user->poste!='Comptable')
                                <li class="nav-item">
                                    <a class="nav-link" href="/clients/ajouter"><i class="fas fa-plus"></i>Enregistrer un client<span class="badge badge-secondary">New</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/client/paiement/verser"><i class="fas fa-upload"></i>Importer des paiements<span class="badge badge-secondary">New</span></a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-2"><i class="mdi mdi-contact-mail"></i>Agents</a>
                        <div id="submenu-3" class="submenu collapse" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/agents"><i class="fas fa-list"></i>Agents<span class="badge badge-secondary">New</span></a>
                                </li>
                                @if($user->poste!='Comptable')
                                <li class="nav-item">
                                    <a class="nav-link" href="/agents/ajouter"><i class="fas fa-plus"></i>Recruter un agent<span class="badge badge-secondary">New</span></a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/caisses"><i class="mdi mdi-wallet"></i>Caisses<span class="badge badge-secondary">New</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/livraisons"><i class="mdi mdi-truck-delivery"></i>Livraisons<span class="badge badge-secondary">New</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/carte/stock"><i class="fas fa-book"></i>Cartes<span class="badge badge-secondary">New</span></a>
                    </li>
                    
                    
                    
                    
                </ul>
            </div>
        </nav>
    </div>
</div>