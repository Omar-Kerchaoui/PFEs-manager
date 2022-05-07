<?php
session_start();
if (isset($_SESSION['id_ens'])) {
    $pageTitle = 'Stage';
    require "init.php";
    //Tous les stages sans prendre en consideration les binomes
    $sql = 'SELECT
                    etudiant.id_etu AS id_etu,
                    etudiant.prenom AS prenom_etu,
                    etudiant.nom AS nom_etu,
                    enseignant.prenom AS prenom_ens,
                    enseignant.nom AS nom_ens,
                    entreprise.nom AS nom_ent
                FROM
                    etudiant
                INNER JOIN
                    enseignant
                ON
                    etudiant.id_ens = enseignant.id_ens
                INNER JOIN
                    stage
                ON
                    etudiant.id_stage = stage.id_stage
                INNER JOIN
                    entreprise
                ON
                    entreprise.id_ent = stage.id_ent
                ';

    $stm = $pdo->prepare($sql);
    $stm->execute();
    $rows = $stm->fetchAll();

?>

    <div class="gradient">
        <div class="container pt-5 stage-table">
            <div class="" style="background-color: #007bff; color: #fff;padding: 8px 15px;font-size: 20px;margin-bottom: 10px">
                Visualiser tous les stages (avec le nom de l’enseignant qui l’encadre):
            </div>
            <div class="wrap">

                <table class="table table-hover text-center main-table ent">
                    <thead>
                        <tr class="head">
                            <th scope="col">ID</th>
                            <th scope="col"> Etudiant</th>
                            <th scope="col" title='more info' style="cursor: pointer;">Entreprise</th>
                            <th scope="col">Enseignant</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #f4f2f2">

                        <?php
                        foreach ($rows as $row) {
                            echo " <tr>
                            <th scope='row'>" . $row['id_etu'] . "</th>
                            <td>" . $row['prenom_etu'] . " " . $row['nom_etu'] . "</td>
                            <td>" . $row['nom_ent'] . "</td>
                            <td>" . $row['prenom_ens'] . " " . $row['nom_ens'] . "</td>
                            </tr>";
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
    require $tpl . 'footer.php';
} else {
    header('location: ../index.php');
}
?>