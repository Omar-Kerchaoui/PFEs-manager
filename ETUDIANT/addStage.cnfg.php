<?php
session_start();



if (isset($_SESSION['id_etu']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../ADMIN/init.php';
    $id_etu = $_SESSION['id_etu'];

    $do = $_GET['do'] ?? 'add';

    if ($do ==  'add') {

        if (isset($_POST['addStage'])) {

            $ent = $_POST['entreprise'];
            $encNom = $_POST['nomEnc'];
            $encPrenom = $_POST['prenomEnc'];
            $intSjt = $_POST['intSjt'];
            $descSjt = $_POST['descSjt'];
            $tech = $_POST['tech'];

            $sql = 'INSERT INTO stage (id_ent, intitule_sjt, desc_sjt, tech, nom_encadrant, prenom_encadrant) VALUES (?,?,?,?,?,?);';
            $stm = $pdo->prepare($sql);
            $stm->execute(array($ent, $intSjt, $descSjt, $tech, $encNom, $encPrenom));
            $stm->fetch();

            $sql = 'SELECT id_stage FROM stage ORDER BY id_stage DESC LIMIT 1';
            $stm = $pdo->prepare($sql);
            $stm->execute();

            $row = $stm->fetch();

            $sql = 'UPDATE etudiant SET id_stage = ? WHERE id_etu = ?';

            $stm = $pdo->prepare($sql);
            $stm->execute(array($row['id_stage'], $id_etu));

            header('location: profil.etudiant.php');
        } else {
            header('location: addStage.php');
        }
    } elseif ($do == 'participer') {
        if (isset($_POST['participer'])) {
            $stage_id = $_POST['stage'];

            $sql = 'UPDATE etudiant SET id_stage = ? WHERE id_etu = ?';

            $stm = $pdo->prepare($sql);
            $stm->execute(array($stage_id, $id_etu));
            header('location: profil.etudiant.php');
            exit();
        }
    }
} else {
    header('location: ../index.php');
}
