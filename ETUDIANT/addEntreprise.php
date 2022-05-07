<?php
session_start();


if (isset($_SESSION['id_etu'])) {
    require "../ADMIN/init.php";
    require $tpl . 'navbarEtudiant.php';

?>

    <div class="main">
        <div class="container">
            <form action="addEntreprise.cnfg.php" method="POST" class="my-5">
                <div class="mx-auto card col-md-6 col-sm-12">
                    <div class="card-body">
                        <h3 style="color: #111827;" class="mb-4">Entreprise</h3>
                        <div class="d-grid gap-3">
                            <div class="row justify-content-center">
                                <div class="col-md-5 mb-2">
                                    <label>Nom</label>
                                </div>
                                <div class="col-md-7">
                                    <input required='required' type="text" name="nom" class="form-control">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-5 mb-2">
                                    <label>Adresse</label>
                                </div>
                                <div class="col-md-7">
                                    <input required='required' type="text" name="adresse" class="form-control">
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-5 mb-2">
                                    <label>Ville</label>
                                </div>
                                <div class="col-md-7">
                                    <input required='required' type="text" name="ville" class="form-control">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-5 mb-2">
                                    <label>Telephone</label>
                                </div>
                                <div class="col-md-7">
                                    <input required='required' type="text" name="tel" class="form-control">
                                </div>
                            </div>
                            <div class="row justify-content-center ">
                                <div class="col-md-5 mb-2"></div>
                                <div class="col-md-7">
                                    <button class="btn btn-primary col-5" type="submit" name="addEnt">+ Ajouter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

<?php
    require "../includes/templates/footer.php";
} else {
    header('location: ../index.php');
}
