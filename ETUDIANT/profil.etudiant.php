<?php
session_start();


if (isset($_SESSION['id_etu'])) {
    $pageTitle = 'Profile';
    require '../ADMIN/init.php';
    require $tpl . 'navbarEtudiant.php';


    $id_etu = $_SESSION['id_etu'];

    $sql_check_stage = 'SELECT * FROM etudiant WHERE id_etu = ?';
    $stm_check_stage = $pdo->prepare($sql_check_stage);
    $stm_check_stage->execute(array($id_etu));
    $row_check_stage = $stm_check_stage->fetch();

    if (!empty($row_check_stage['id_stage'])) {
        $sql = 'SELECT *,etudiant.email as etdemail, etudiant.nom as nometd, etudiant.prenom as prenometd, entreprise.nom AS entNom, stage.nom_encadrant as encNom, stage.prenom_encadrant as encPrenom, etudiant.password as etdp, etudiant.photo as etimg FROM 
    etudiant INNER JOIN stage ON etudiant.id_stage = stage.id_stage 
    INNER JOIN entreprise ON entreprise.id_ent = stage.id_ent 
    WHERE etudiant.id_etu = ?
    ';
    } else {
        $sql = 'SELECT *,etudiant.email as etdemail, etudiant.nom as nometd, etudiant.prenom as prenometd, etudiant.password as etdp, etudiant.photo as etimg FROM etudiant WHERE id_etu =?';
    }

    $stm = $pdo->prepare($sql);
    $stm->execute(array($id_etu));
    $row = $stm->fetch();

?>
    <!-- start personnal informations -->
    <div class="main">
        <div class="container-sm my-4">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="card mx-auto">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="<?php
                                            if (!empty($row['etimg'])) {
                                                echo 'UPLOADS/' . $row['etimg'];
                                            } else {
                                                echo '/UPLOADS/default.png';
                                            }  ?>" class="rounded" width="180">
                                <div class="mt-4">
                                    <h4 style="font-weight: 700;color:#111827;"><?php echo $row['nometd'] . ' ' . $row['prenometd'] ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card mb-3 mx-auto">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0" style="color:#111827;">Nom</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['nometd'] ?> </div>
                            </div>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0" style="color:#111827;">Prenom </h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['prenometd'] ?> </div>
                            </div>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0" style="color:#111827;">Num Appogee </h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['id_etu'] ?> </div>
                            </div>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0" style="color:#111827;">Email UIT</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['etdemail']; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0" style="color:#111827;">Mot de Passe</h6>
                                </div>
                                <form action="profil.update.php" method="POST" class="col-sm-9 text-secondary">
                                    <div class="d-flex gap-3">
                                        <div class="col-7" style="position: relative;">
                                            <input type="password" class="form-control" value="<?php echo $row['etdp'] ?>" name="password">
                                            <i class="fas fa-eye-slash" style="position: absolute; top: 11px;right: 13px;cursor: pointer"></i>
                                        </div>
                                        <button type='submit' class="btn btn-primary" name="sPass">save</button>
                                    </div>
                                </form>

                            </div>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0" style="color:#111827;">Photo de profile</h6>
                                </div>
                                <form action="profil.update.php" class="col-sm-9 text-secondary" enctype="multipart/form-data" method="POST">
                                    <div class="d-flex gap-3">
                                        <div class="col-7"> <input type="file" class="form-control" name="photo">
                                        </div>
                                        <div> <button type='submit' class="btn btn-primary " name="sPhoto">save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end personnal informations -->


            <!-- start stage section  -->
            <?php

            $sql = 'SELECT * FROM etudiant WHERE id_stage IS NOT NULL AND id_etu = ?';
            $stm = $pdo->prepare($sql);
            $stm->execute(array($id_etu));

            //if this students has a stage or not
            if ($stm->rowCount() > 0) {
                $row2 = $stm->fetch();
                // in this case we will show the informations of stage 
                $_SESSION['id_stage'] = $row['id_stage'];

            ?>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card mb-3 mx-auto">
                            <div class="card-body">
                                <h3 class="my-3 mb-5" style="color: #111827;">Votre stage :</h3>

                                <div class="row align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="color:#111827;">Entreprise</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $row['entNom'] ?> </div>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="color:#111827;">Encadrant</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $row['encNom'] . " " . $row['encPrenom'] ?> </div>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="color:#111827;">Intitule sujet</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $row['intitule_sjt'] ?> </div>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="color:#111827;">description du sujet</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $row['desc_sjt'] ?> </div>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="color:#111827;">technologies utilise</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $row['tech'] ?> </div>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="color:#111827;">Note</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $row['note'] ?> </div>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="color:#111827;">Etat</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php if ($row['validation'] == 1) {
                                            echo 'Valide';
                                        } else {
                                            echo 'Non encore valide';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="color:#111827;">Rapport V1</h6>
                                    </div>
                                    <form action="addDocuments.php" method="POST" class="col-sm-9 text-secondary" enctype="multipart/form-data">
                                        <div class="d-flex gap-3">
                                            <div class="col-7">
                                                <input type="file" name="file" class="form-control">
                                            </div>
                                            <button type='submit' class="btn btn-primary" name="first">save</button>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="color:#111827;">Rapport V-Finale</h6>
                                    </div>
                                    <form action="addDocuments.php" method="POST" class="col-sm-9 text-secondary" enctype="multipart/form-data">
                                        <div class="d-flex gap-3">
                                            <div class="col-7">
                                                <input type="file" name="file" class="form-control">
                                            </div>
                                            <button type='submit' class="btn btn-primary" name="second">save</button>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="color:#111827;">Presentation</h6>
                                    </div>
                                    <form action="addDocuments.php" method="POST" class="col-sm-9 text-secondary" enctype="multipart/form-data">
                                        <div class="d-flex gap-3">
                                            <div class="col-7">
                                                <input type="file" name="file" class="form-control">
                                            </div>
                                            <button type='submit' class="btn btn-primary" name="third">save</button>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="color:#111827;">attestation</h6>
                                    </div>
                                    <form action="addDocuments.php" method="POST" class="col-sm-9 text-secondary" enctype="multipart/form-data">
                                        <div class="d-flex gap-3">
                                            <div class="col-7">
                                                <input type="file" name="file" class="form-control">
                                            </div>
                                            <button type='submit' class="btn btn-primary" name="last">save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            <?php

            } else {
                // in this case we will show the use the button to create a stage
                //so it would redirect him to the page where he will fill the nessecary informations
            ?>
                <div class="row justify-content-center">
                    <form action="addStage.cnfg.php?do=participer" method="POST" class="w-100 container py-3" style="z-index: 200;position: relative;">
                        <div class="mx-auto card col-md-10 col-sm-12">
                            <div class="card-body">
                                <div class="d-grid gap-3">
                                    <div class="row">

                                        <!-- Binome start -->
                                        <div class="col-md-5 mb-2">
                                            <label for="" style="color: #111827;">Binome</label>
                                        </div>
                                        <div class="col-md-5">
                                            <select name="stage" class="form-select">
                                                <?php
                                                $sql = 'SELECT * FROM etudiant WHERE id_stage IS NOT NULL AND id_etu != ?';
                                                $stm = $pdo->prepare($sql);
                                                $stm->execute(array($id_etu));
                                                $rows = $stm->fetchAll();
                                                foreach ($rows as $row) {
                                                    echo "<option value=" . $row['id_stage'] . " >" . $row['nom'] . "</option>";
                                                }
                                                ?>
                                            </select>



                                        </div>
                                        <div class="col-md-2"> <button type="submit" class="btn btn-primary" name="participer">Save</button>
                                        </div>
                                        <p class="form-text">Vous voulez participer a un stage existent? </p>


                                    </div>
                                    <!-- Binome end -->
                                </div>
                            </div>
                    </form>
                </div>
        </div>
        <div class="row justify-content-center card col-md-10 mx-auto alert alert-info">
            <p class="">Vous voulez ajouter un stage? <a href="addStage.php" class="fs-5" style="color: #111827;">Ajouter</a></p>
        </div>
    <?php
            }
    ?>




<?php
    require $tpl . 'footer.php';
} else {
    header('location: login.php?user=etudiant');
}

?>