<?php

session_start();


if (isset($_SESSION['id_admin'])) {
    $pageTitle = 'Stages';

    require "init.php";
    require $tpl . 'navbarAdmin.php';

    $do = $_GET['do'] ?? 'fcta';

    //START fcta 
    if ($do == 'fcta') {
        $sql = 'SELECT 
                    stage.*, enseignant.nom AS nom_ens, 
                    enseignant.prenom       AS prenom_ens, 
                    etudiant.nom            AS nom_etu, 
                    etudiant.prenom         AS prenom_etu, 
                    entreprise.nom          AS nom_ent, 
                    entreprise.*, 
                    stage.nom_encadrant           AS nom_enc, 
                    stage.prenom_encadrant        AS prenom_enc 
                FROM 
                    etudiant 
                INNER JOIN 
                    stage 
                ON 
                    etudiant.id_stage = stage.id_stage 
                INNER JOIN 
                    enseignant 
                ON 
                    enseignant.id_ens = etudiant.id_ens 
                INNER JOIN 
                    entreprise 
                ON 
                    entreprise.id_ent = stage.id_ent 
                ';

        $stm = $pdo->prepare($sql);
        $stm->execute();
        $rows = $stm->fetchAll();
        //END fcta 
?>
        <div class="gradient">

            <div class="container pt-5 stage-table">
                <div class="" style="background-color: #007bff; color: #fff;padding: 8px 15px;font-size: 20px;margin-bottom: 10px">
                    La liste des stages :
                </div>
                <!-- entreprise table end -->
                <div class="wrap">
                    <table class="table table-hover text-center main-table not-active ent">
                        <thead>
                            <tr class="table-light">
                                <th scope="col">id entreprise</th>
                                <th scope="col" title='more info' style="cursor: pointer;">Entreprise <i class="fa fa-minus click"></i></th>
                                <th scope="col">Ville</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Telephone</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($rows as $row) {
                                echo " <tr>
                            <th scope='row'>" . $row['id_ent'] . "</th>
                            <td>" .  $row['nom'] . "</td>
                            <td>" . $row['ville'] . "</td>
                            <td>"  . $row['adresse'] . "</td>
                            <td>" . $row['tel'] . "</td>
                            </tr>";
                            } ?>
                    </table>
                    <!-- entreprise table end -->

                    <!-- stage table start  -->
                    <table class="table table-hover text-center main-table active stg">
                        <thead>
                            <tr class="table-light">
                                <th scope="col">Id stage</th>
                                <th scope="col">Etudiant</th>
                                <th scope="col" title='more info' style="cursor: pointer;">Entreprise <i class="fa fa-plus click"></i></th>
                                <th scope="col">Enseignant</th>
                                <th scope="col">Encadrant</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($rows as $row) {
                                echo " <tr>
                            <th scope='row'>" . $row['id_stage'] . "</th>
                            <td>" . $row['prenom_etu'] . " " . $row['nom_etu'] . "</td>
                            <td>" . $row['nom_ent'] . "</td>
                            <td>" . $row['prenom_ens'] . " " . $row['nom_ens'] . "</td>
                            <td>" . $row['prenom_enc'] . " " . $row['nom_enc'] . "</td>
                            </tr>";
                            }

                            ?>

                        </tbody>
                    </table>
                    <!-- stage table start  -->
                </div>

            </div>
        </div>
    <?php
    } elseif ($do == 'fcte') {
        $sql = 'SELECT 
                    stage.*, 
                    etudiant.nom            AS nom_etu, 
                    etudiant.prenom         AS prenom_etu, 
                    entreprise.nom          AS nom_ent, 
                    entreprise.*, 
                    stage.nom_encadrant           AS nom_enc, 
                    stage.prenom_encadrant        AS prenom_enc 
                FROM 
                    etudiant 
                INNER JOIN 
                    stage 
                ON 
                    etudiant.id_stage = stage.id_stage 
                INNER JOIN 
                    entreprise 
                ON 
                    entreprise.id_ent = stage.id_ent 
                WHERE 
                    validation = ?';
        $stm = $pdo->prepare($sql);
        $stm->execute(array(1));
        $rows = $stm->fetchAll();

    ?>
        <div class="gradient">
            <div class="container">
                <div class="" style="background-color: #007bff; color: #fff;padding: 8px 15px;font-size: 20px;margin-bottom: 10px">
                    La liste des stages valides :
                </div>
                <!-- entreprise table end -->
                <div class="wrap">
                    <table class="table table-hover text-center main-table not-active ent">
                        <thead>
                            <tr class="table-dark">
                                <th scope="col">#Numéro Apogée</th>
                                <th scope="col" title='more info' style="cursor: pointer;">Entreprise <i class="fa fa-minus click"></i></th>
                                <th scope="col">Ville</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Telephone</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($rows as $row) {
                                echo " <tr>
                            <th scope='row'>" . $row['id_ent'] . "</th>
                            <td>" .  $row['nom'] . "</td>
                            <td>" . $row['ville'] . "</td>
                            <td>"  . $row['adresse'] . "</td>
                            <td>" . $row['tel'] . "</td>
                            </tr>";
                            } ?>
                    </table>
                    <!-- entreprise table end -->

                    <!-- stage table start  -->
                    <table class="table table-hover text-center main-table active stg">
                        <thead>
                            <tr class="table-light">
                                <th scope="col">#Numéro Apogée</th>
                                <th scope="col">Etudiant</th>
                                <th scope="col" title='more info' style="cursor: pointer;">Entreprise <i class="fa fa-plus click"></i></th>
                                <th scope="col">Encadrant</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($rows as $row) {
                                echo " <tr>
                            <th scope='row'>" . $row['id_stage'] . "</th>
                            <td>" . $row['prenom_etu'] . " " . $row['nom_etu'] . "</td>
                            <td>" . $row['nom_ent'] . "</td>
                            <td>" . $row['prenom_enc'] . " " . $row['nom_enc'] . "</td>
                            </tr>";
                            }

                            ?>

                        </tbody>
                    </table>
                    <!-- stage table start  -->
                </div>
            </div>

        <?php
    }
    //START FCTF
    elseif ($do == 'fctf') {
        $sql = "SELECT * FROM etudiant INNER JOIN stage ON etudiant.id_stage = stage.id_stage";

        $stm = $pdo->prepare($sql);
        $stm->execute();
        $rows = $stm->fetchAll();

        ?>

            <div class="gradient">
                <div class="container pt-5 stage-table">
                    <div class="" style="background-color: #007bff; color: #fff;padding: 8px 15px;font-size: 20px;margin-bottom: 10px">
                        La liste des notes des etudiants :
                    </div>
                    <div class="wrap">
                        <!-- stage table start  -->
                        <table class="table table-hover text-center main-table active stg">
                            <thead>
                                <tr class="table-light">
                                    <th scope="col">#Numéro Apogée</th>
                                    <th scope="col">Etudiant</th>
                                    <th scope="col">Note</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($rows as $row) {
                                    echo " <tr>
                            <th scope='row'>" . $row['id_stage'] . "</th>
                            <td>" . $row['prenom'] . " " . $row['nom'] . "</td>
                            <th scope='row'>" . $row['note'] . "</th>
                            </tr>";
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                    <form action="save_notes.php" method="POST">
                        <button type="submit" class="btn btn-success" name="save">Enregistrer</button>
                    </form>
                    <!-- stage table start  -->
                </div>

            </div>

    <?php

    }
    //END FCTF
    else {
        echo 'error not found';
    }
    require $tpl . 'footer.php';
} else {
    header('location: index.admin.php');
    exit();
}
