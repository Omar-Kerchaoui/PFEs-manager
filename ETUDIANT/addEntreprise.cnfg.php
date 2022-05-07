<?php
session_start();




if (isset($_SESSION['id_etu'])) {
    $noNavbar = '';
    require '../ADMIN/init.php';

    $id_etu = $_SESSION['id_etu'];

    if (isset($_POST['addEnt'])) {

        $nom = $_POST['nom'];
        $add = $_POST['adresse'];
        $ville = $_POST['ville'];
        $tel = $_POST['tel'];

        if (empty($nom) || empty($add) || empty($ville) || empty($tel)) {
            echo "<div class='alert alert-danger container my-5'>Tout les champs sont obligatoire </div>";
            $ref = $_SERVER['HTTP_REFERER'];
            header("refresh:3;url=$ref");
            exit();
        } else {

            $sql2 = 'SELECT nom from entreprise WHERE nom = ?';

            $stmCheck = $pdo->prepare($sql2);
            $stmCheck->execute(array($nom));
            if ($stmCheck->rowCount() > 0) {
                echo "<div class=container><div class='alert alert-danger mt-5'>Cette entreprise Existe deja!!</div></div>";
                header("Refresh:3;url=addEntreprise.php");
                exit();
            } else {

                $sql = 'INSERT INTO entreprise (nom, adresse, tel, ville) VALUES (?,?,?,?)';

                $stm = $pdo->prepare($sql);
                $stm->execute(array($nom, $add, $tel, $ville));
                $rows = $stm->rowCount();
                if ($rows > 0) {
                    header("location: addStage.php");
                }
            }
        }
    }
} else {
    header('location: ../login.php');
}
