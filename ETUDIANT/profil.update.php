<?php
session_start();

if (isset($_SESSION['id_etu']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    require "../connect.php";
    $id_etu = $_SESSION['id_etu'];

    if (isset($_POST['sPass'])) {

        $newPass = $_POST['password'];

        $sql = 'UPDATE etudiant SET password = ? WHERE id_etu = ?';
        $stm = $pdo->prepare($sql);
        $stm->execute(array($newPass, $id_etu));

        $row = $stm->rowCount();

        if ($row > 0) {
            header('location: profil.etudiant.php');
            exit();
        }
    }
    if (isset($_POST['sPhoto'])) {

        $file = $_FILES['photo'];
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];
        $error = $file['error'];


        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {
            if ($error === 0) {
                $fileNewName = "profile" . $id_etu . "." . $fileActualExt;
                $fielDestination = "UPLOADS/" . $fileNewName;
                move_uploaded_file($fileTmp, $fielDestination);

                $sql = 'UPDATE etudiant SET photo = ? WHERE id_etu = ?';
                $stm = $pdo->prepare($sql);
                $stm->execute(array($fileNewName . '?' . mt_rand(), $id_etu));


                header("location: profil.etudiant.php");
                exit();
            } else {
                header('location: profil.etudiant.php');
            }
        } else {
            header('location: profil.etudiant.php');
        }
    }
} else {
    header('location: ../index.php');
}
