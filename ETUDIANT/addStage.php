<?php
session_start();

if (isset($_SESSION['id_etu'])) {
    require '../ADMIN/init.php';
    require $tpl . 'navbarEtudiant.php';



    $id_etu = $_SESSION['id_etu'];


    $sql = 'SELECT * FROM entreprise';

    $stm = $pdo->prepare($sql);
    $stm->execute();
    $rows = $stm->fetchAll();

?>

    <div class="main">

        <form action="addStage.cnfg.php" method="POST" class="w-100 container py-3" style="z-index: 200;position: relative;">
            <div class="mx-auto card col-md-6 col-sm-12">
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <div class="row">

                            <!-- entreprise start -->
                            <div class="col-md-5 mb-2">
                                <label for="" style="color: #111827;">Entreprise</label>
                            </div>
                            <div class="col-md-7">
                                <select name="entreprise" class="form-select">
                                    <?php
                                    foreach ($rows as $row) {
                                        echo "<option value=" . $row['id_ent'] . " >" . $row['nom'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <p class="form-text fs-7">Votre entreprise n'existe pas ?
                                    <a href="addEntreprise.php">Add Entreprise</a>
                                </p>
                            </div>
                        </div>
                        <!-- entreprise end -->

                        <!-- encadrant start  -->
                        <div class="row">
                            <div class="col-md-5 mb-2" style="color: #111827;">Encadrent</div>
                            <div class="col-md-7">
                                <input required='required' type="text" name="nomEnc" placeholder="Nom" class="form-control mb-2">
                                <input required='required' type="text" name="prenomEnc" placeholder="Prenom" class="form-control">
                            </div>
                        </div>
                        <!-- encadrant end  -->

                        <!-- intetule sujet start  -->
                        <div class="row">
                            <div class="col-md-5 mb-2" style="color: #111827;">Intitule sujet</div>
                            <div class="col-md-7">
                                <input required='required' type="text" name="intSjt" class="form-control">
                            </div>
                        </div>
                        <!-- intetule sujet end  -->

                        <!-- description sujet start  -->
                        <div class="row align-items-center">
                            <div class="col-md-5 mb-2" style="color: #111827;">Description Sujet</div>
                            <div class="col-md-7">
                                <input required='required' type="text" name="descSjt" class="form-control">
                            </div>
                        </div>
                        <!-- description sujet end  -->

                        <!-- technologie start  -->
                        <div class="row">
                            <div class="col-md-5 mb-2" style="color: #111827;">Technologie</div>
                            <div class="col-md-7">
                                <input required='required' type="text" name="tech" class="form-control">
                            </div>
                        </div>
                        <!-- technologie end  -->


                        <button type="submit" class="btn btn-primary mt-3" name="addStage">+ Ajouter </button>
                    </div>

                </div>
            </div>
        </form>
    </div>


<?php
    require $tpl . 'footer.php';
} else {
    header('location: ../index.php');
} ?>