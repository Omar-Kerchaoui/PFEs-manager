<?php
session_start();
if (isset($_SESSION['id_ens'])) {
    $pageTitle = 'Validation';
    $id_ens = $_SESSION["id_ens"];
    require "init.php";
    $sql = 'SELECT 
                etudiant.id_etu AS id_etu, 
                GROUP_CONCAT(CONCAT( etudiant.nom ," ",etudiant.prenom) SEPARATOR "</br>") AS nom_etu, 
                entreprise.nom AS nom_ent, stage.id_stage AS id_stage, stage.intitule_sjt AS intitule, 
                stage.validation AS validation,
                stage.note AS note,
                stage.tech AS tech, 
                stage.desc_sjt AS description_sjt
                FROM etudiant INNER JOIN stage 
                ON etudiant.id_stage = stage.id_stage 
                INNER JOIN entreprise 
                ON entreprise.id_ent = stage.id_ent 
                where etudiant.id_ens= ? 
                group BY id_stage';
    $stm = $pdo->prepare($sql);
    $stm->execute([$id_ens]);
    $rows = $stm->fetchAll();


?>
    <form action="#" method="post">
        <div class="gradient">


            <div class="container pt-5 stage-table">
                <div class="" style="background-color: #007bff; color: #fff;padding: 8px 15px;font-size: 20px;margin-bottom: 10px">
                    Valider un stage pour la soutenance et Attribuer une note finale :
                </div>
                <div class="wrap">

                    <table class="table table-hover text-center main-table ent">
                        <thead>
                            <tr class="head">
                                <th scope="col">ID Stage</th>
                                <th scope="col"> Etudiant</th>
                                <th scope="col">Entreprise</th>
                                <th scope="col">Intitulé du sujet</th>
                                <th scope="col">Description du sujet</th>
                                <th scope="col">Technologie utilisé</th>
                                <th scope="col">valider</th>
                                <th scope="col">Non valider</th>
                                <th scope="col">Note finale</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #f4f2f2">
                            <?php
                            foreach ($rows as $row) {
                                echo " <tr>
                            <td scope='row'>" . $row['id_stage'] . "</td>
                            <td>" . $row['nom_etu'] . "</td>
                            <td>" . $row['nom_ent'] . "</td>
                            <td>" . $row['intitule'] . "</td>
                            <td>" . $row['description_sjt'] . "</td>
                            <td>" . $row['tech'] . "</td>

                            
                            <td><input type='checkbox' name='v[]' value='" . $row['id_stage'] . "' ";
                                if ($row['validation'] == 1) {
                                    echo 'checked="checked"';
                                }
                                echo " ></td>
                            <td><input type='checkbox' name='nv[]' value='" . $row['id_stage'] . "' ";

                                if ($row['validation'] == 0) {
                                    echo 'checked="checked"';
                                }
                                echo " ></td>
                                <td><input type='number' name='note[" . $row['id_stage'] . "]' id='note' width='20px' min='0' max='20' value=";
                                if (!empty($row['note'])) {
                                    echo $row['note'];
                                }
                                echo "></td>
                            </tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                    <input type='submit' class="btn btn-primary" name="submit2" value='valider'>
                </div>
            </div>
        </div>
    </form>
<?php
    if (isset($_POST["submit2"])) {
        print_r($_POST);
        $v = $_POST["v"];
        $nv = $_POST["nv"];
        $note = $_POST["note"];
        //update ceux qui ont validé
        foreach ($v as $val) {
            $sql1 = "UPDATE stage set validation=?, note=? where id_stage=?";
            $stm1 = $pdo->prepare($sql1);
            $stm1->execute([1, $note[$val], $val]);
        }
        //update ceux qui non pas valider
        foreach ($nv as $nval) {
            $sql2 = "UPDATE stage set validation=?, note=? where id_stage=?";
            $stm2 = $pdo->prepare($sql2);
            $stm2->execute([0, $note[$nval], $nval]);
        }

        header("location: validation.ens.php");
    }
    require $tpl . "footer.php";
} else {
    header('location: ../index.php');
}
?>