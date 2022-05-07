<?php
session_start();
if (isset($_SESSION['id_ens'])) {
    $pageTitle = 'Stage';
    require "init.php";
    $sql = 'SELECT 
                    etudiant.id_etu AS id_etu,
                    etudiant.prenom AS prenom_etu,
                    etudiant.nom AS nom_etu,
                    entreprise.nom AS nom_ent
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
                where etudiant.id_ens Is NULL
                ';

    $stm = $pdo->prepare($sql);
    $stm->execute();
    $rows = $stm->fetchAll();
?>
    <form action="#" method="post">
        <div class="gradient">
            <div class="container pt-5 stage-table">
                <div class="" style="background-color: #007bff; color: #fff;padding: 8px 15px;font-size: 20px;margin-bottom: 10px">

                    Choisir les stages à encadrer</div>
                <div class="wrap">

                    <table class="table table-hover text-center main-table ent">
                        <thead>
                            <tr class="head">
                                <th scope="col">ID</th>
                                <th scope="col"> Etudiant</th>
                                <th scope="col" title='more info' style="cursor: pointer;">Entreprise</th>
                                <th scope="col">Choisir</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #f4f2f2">
                            <?php
                            foreach ($rows as $row) {
                                echo " <tr>
                            <td scope='row'>" . $row['id_etu'] . "</td>
                            <td>" . $row['prenom_etu'] . " " . $row['nom_etu'] . "</td>
                            <td>" . $row['nom_ent'] . "</td>
                            <td><input type='checkbox' id='choix' name='choix[]' value='" . $row['id_etu'] . "'></td>
                            </tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                    <input type='submit' class="btn btn-primary" name="submit1" value='valider'>
                </div>
            </div>
        </div>
    </form>
<?php
    if (isset($_POST["submit1"])) {
        $id_etu = $_POST["choix"];
        $id_ens = $_SESSION["id_ens"];
        foreach ($id_etu as $choice) {
            $sql1 = "UPDATE etudiant set id_ens=? where id_etu=?";
            $stm1 = $pdo->prepare($sql1);
            $stm1->execute([$id_ens, $choice]);
        }
        header('location: chose.ens.php');
    }

    require $tpl . 'footer.php';
} else {
    header('location: ../index.php');
}
?>