<?php
session_start();



if (isset($_SESSION['id_admin'])) {
    $pageTitle = 'Etudiant';
    require 'init.php';
    require $tpl . 'navbarAdmin.php';

    $do = $_GET['do'] ?? 'fctb';

    //START FCTB
    if ($do == 'fctb') {
        $sql = 'SELECT 
                    etudiant.*, enseignant.nom AS nom_ens, enseignant.prenom AS prenom_ens 
                FROM 
                    etudiant 
                INNER JOIN 
                    enseignant 
                ON 
                    etudiant.id_ens = enseignant.id_ens;';

        $stm = $pdo->prepare($sql);
        $stm->execute();
        $rows = $stm->fetchAll();

?>
        <div class="gradient">
            <div class="container stage-table">
                <div class="" style="background-color: #007bff; color: #fff;padding: 8px 15px;font-size: 20px;margin-bottom: 10px">
                    La liste des etudiants par enseignants :
                </div>
                <div class="wrap">
                    <!-- stage table start  -->
                    <table class="table table-hover text-center main-table active stg">
                        <thead>
                            <tr class="table-light">
                                <th scope="col">Numéro Apogée</th>
                                <th scope="col">Etudiant</th>
                                <th scope="col">Enseignant</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($rows as $row) {
                                echo " <tr>
                            <th scope='row'>" . $row['id_etu'] . "</th>
                            <td>" . $row['prenom'] . " " . $row['nom'] . "</td>
                            <td>" . $row['prenom_ens'] . " " . $row['nom_ens'] . "</td>
                            </tr>";
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- stage table start  -->
            </div>

        </div>
    <?php
        //END FCTB

        //START FCTC
    } elseif ($do == 'fctc') {
        //SELECTIONNE LES ETUDIANT SANS ENCADRENT PEDAGOGIQUE
        $sql = 'SELECT 
                    *
                FROM 
                    etudiant 
                WHERE 
                    id_ens 
                IS NULL
                    ';

        $stm = $pdo->prepare($sql);
        $stm->execute();
        $rows = $stm->fetchAll();

    ?>
        <div class="gradient">
            <div class="container pt-5 stage-table">
                <div class="" style="background-color: #007bff; color: #fff;padding: 8px 15px;font-size: 20px;margin-bottom: 10px">
                    La liste des etudiants sans enseignant :
                </div>
                <!-- stage table start  -->
                <div class="wrap">
                    <table class="table table-hover text-center main-table active stg">
                        <thead>
                            <tr class="table-light">
                                <th scope="col">Numéro Apogée</th>
                                <th scope="col">Etudiant</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($rows as $row) {
                                echo " <tr>
                            <th scope='row'>" . $row['id_etu'] . "</th>
                            <td>" . $row['prenom'] . " " . $row['nom'] . "</td>
                            </tr>";
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- stage table start  -->
            </div>

        </div>
    <?php    }
    //END FCTC
    elseif ($do == 'fctd') {
        $sql = 'SELECT * FROM etudiant INNER JOIN stage ON stage.id_stage = etudiant.id_stage WHERE rapport_vf IS NULL';

        $stm = $pdo->prepare($sql);
        $stm->execute();
        $rows = $stm->fetchAll();

    ?>



        <div class="gradient">
            <div class="container pt-5 stage-table">
                <div class="" style="background-color: #007bff; color: #fff;padding: 8px 15px;font-size: 20px;margin-bottom: 10px">
                    La liste des etudiants qui non pas depose leur rapport :
                </div>
                <!-- stage table start  -->
                <div class="wrap">
                    <table class="table table-hover text-center main-table active stg">
                        <thead>
                            <tr class="table-light">
                                <th scope="col">Numéro Apogée</th>
                                <th scope="col">Etudiant</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($rows as $row) {
                                echo " <tr>
                            <th scope='row'>" . $row['id_etu'] . "</th>
                            <td>" . $row['prenom'] . " " . $row['nom'] . "</td>
                            </tr>";
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- stage table start  -->


            </div>

        </div>

        form

<?php
    } else {
        echo "error not found";
    }
    require $tpl . 'footer.php';
} else {
    header("location: index.admin.php");
}
