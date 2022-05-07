<nav class="navbar navbar-expand-lg navbar-dark ">
    <div class="container-sm">
        <a class="navbar-brand" href="dashboard.php">PFE ENSAK</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-light" href="dashboard.php">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Etudiants
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="etudiant.admin.php?do=fctb">Etudiant par enseignant</a></li>
                        <li><a class="dropdown-item" href="etudiant.admin.php?do=fctc">Etudiant sans enseignant</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="etudiant.admin.php?do=fctd">Etudiant qui non pas deposer le rapport</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Stages
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="stage.admin.php?do=fcta">Tous les stages</a></li>
                        <li><a class="dropdown-item" href="stage.admin.php?do=fcte">Les stages validé</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="stage.admin.php?do=fctf">Les notes des etudiants</a></li>
                    </ul>
                </li>

            </ul>
            <a href="../logout.php" class="btn bg-light">Se Deconnecter</a>
        </div>
    </div>
</nav>