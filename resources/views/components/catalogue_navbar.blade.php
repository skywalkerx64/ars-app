<nav class="navbar navbar-expand-lg bg-white fixed-top">
    <a class="navbar-brand" href="/"><img src="{{ asset('assets/images/brand.png') }}" alt=""></a>
    <button class="navbar-toggler focus:outline-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto navbar-right-top">
            <li class="nav-item d-flex justify-center items-center px-20">
                <ul class="d-flex gap-3 text-base justify-center items-center">
                    <li><a href="/catalogue" class="text-success" >Catalogue</a></li>
                    <li><a href="/administration">Administration</a></li>
                </ul>
            </li>
            
            
            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('assets/images/avatar-1.jpg') }}" alt="" class="user-avatar-md rounded-circle"></a>
                <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                    <div class="nav-user-info bg-success">
                        <h5 class="h5 mb-2 text-white nav-user-name">Compte {{ $user->poste }}</h5>
                        <span class="ml-2">{{ $user->name }}</span>
                        
                    </div>
                    @if ($user->admin)
                    <a class="dropdown-item" href="/parametres/"><i class="fas fa-cog mr-2"></i>Paramètres</a>
                    @endif
                    
                                <form method="POST" action="/logout" id="logout-form">
                                    @csrf
                                     <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="http://agency.test:81/logout" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();"><i class="fas fa-power-off mr-2"></i>Déconnexion</a>

                                </form>
        </ul>
    </div>
</nav>