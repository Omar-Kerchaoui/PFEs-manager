<?php
$noNavbar = '';
$pageTitle = 'Login';
require "init.php";


$user = $_GET["user"] ?? "etudiant";
if ($user == "admin") { ?>
    <div class="gradient">
        <div class="container">
            <form class="login_admin shadow-lg" method="POST" action="login.cnfg.php" id="form_admin">
                <h2 class="text-center mb-5">Se connecter</h2>
                <input type="hidden" value="admin" name="user">
                <div class="error"></div>
                <div class="mb-3">
                    <label for="email" class="form-label fs-5">Nom</label>
                    <input type="text" class="form-control shadow-sm" name="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fs-5">url</label>
                    <input type="" class="form-control shadow-sm" name="name">
                </div>
                <div class="mb-3" style="position: relative">
                    <label for="exampleInputPassword1" class="form-label fs-5">Mot de Passe</label>
                    <div style="position: relative">
                        <input type="password" class="form-control mb-5 shadow-sm" name="password">
                        <i class="fas fa-eye-slash" style="position: absolute; top: 11px;right: 13px;cursor: pointer;color: #555"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 shadow fs-5" id="submit">Login</button>

            </form>
        </div>
    </div>
<?php } elseif ($user == "etudiant") { ?>
    <div class="gradient">
        <div class="container">
            <form class="login_admin shadow-lg" method="POST" action="login.cnfg.php" id="form_admin">
                <h2 class="text-center mb-5">Se connecter</h2>
                <input type="hidden" value="etudiant" name="user">
                <div class="error"></div>
                <div class="mb-3">
                    <label for="email" class="form-label fs-5">Email</label>
                    <input type="text" class="form-control shadow-sm" name="email">
                </div>
                <div class="mb-3" style="position: relative;">
                    <label for="exampleInputPassword1" class="form-label fs-5">Mot de passe</label>
                    <div style="position: relative">
                        <input type="password" class="form-control mb-5 shadow-sm" name="password">
                        <i class="fas fa-eye-slash" style="position: absolute; top: 11px;right: 13px;cursor: pointer;color: #555"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 shadow fs-5" id="submit">Login</button>
            </form>
        </div>
    </div>

<?php } elseif ($user == "enseignant") { ?>
    <div class="gradient">
        <div class="container">
            <form class="login_admin shadow-lg" method="POST" action="login.cnfg.php" id="form_admin">
                <h2 class="text-center mb-5">Se connecter</h2>
                <input type="hidden" value="enseignant" name="user">
                <div class="error"></div>
                <div class="mb-3">
                    <label for="email" class="form-label fs-5">Email</label>
                    <input type="text" class="form-control shadow-sm" name="email">
                </div>
                <div class="mb-3" style="position: relative;">
                    <label for="exampleInputPassword1" class="form-label fs-5">Mot de passe</label>
                    <div style="position: relative">
                        <input type="password" class="form-control mb-5 shadow-sm" name="password">
                        <i class="fas fa-eye-slash" style="position: absolute; top: 11px;right: 13px;cursor: pointer;color: #555"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 shadow fs-5" id="submit">Login</button>
            </form>
        </div>
    </div>
<?php }

require $tpl . "footer.php";
