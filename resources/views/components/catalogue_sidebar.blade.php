<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column mt-3">

                    <li class="nav-item">
                        <a class="nav-link" href="/catalogue"><i class="mdi mdi-list"></i>Catalogue<span class="badge badge-secondary">New</span></a>
                    </li>
                    @if($user->poste=='Administrateur' && $user->admin)
                    <li class="nav-item">
                        <a class="nav-link" href="/catalogue/ajouter"><i class="fas fa-plus"></i>Ajout de produit<span class="badge badge-secondary">New</span></a>
                    </li>
                    @endif
                    
                    
                    
                    
                    
                </ul>
            </div>
        </nav>
    </div>
</div>