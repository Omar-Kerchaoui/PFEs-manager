<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if (isset($_SESSION['id_etu']) && isset($_SESSION['id_stage'])) {

    require "../ADMIN/init.php";
    require $tpl . 'navbarEtudiant.php';


    if (isset($_POST['first'])) {
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];
        $error = $file['error'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('pdf');

        if (in_array($fileActualExt, $allowed)) {
            if ($error === 0) {
                $fileNewName = uniqid("", true) . "." . $fileActualExt;
                $fielDestination = "DOCUMENTS/" . $fileNewName;
                move_uploaded_file($fileTmp, $fielDestination);

                $sql = 'UPDATE stage SET rapport_v1 = ? WHERE id_stage = ?';
                $stm = $pdo->prepare($sql);
                $stm->execute(array($fileNewName, $_SESSION['id_stage']));

                header("location: profil.etudiant.php");
            } else {
                echo "something went wrong when uploading your file";
            }
        } else {
            echo "please select pdf file";
        }
    }

    if (isset($_POST['second'])) {
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];
        $error = $file['error'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('pdf');

        if (in_array($fileActualExt, $allowed)) {
            if ($error === 0) {
                $fileNewName = uniqid("", true) . "." . $fileActualExt;
                $fielDestination = "DOCUMENTS/" . $fileNewName;
                move_uploaded_file($fileTmp, $fielDestination);

                $sql = 'UPDATE stage SET rapport_vf = ? WHERE id_stage = ?';
                $stm = $pdo->prepare($sql);
                $stm->execute(array($fileNewName, $_SESSION['id_stage']));

                header("location: profil.etudiant.php");
                ob_end_flush();
            } else {
                echo "something went wrong when uploading your file";
            }
        } else {
            echo "please select pdf file";
        }
    }


    if (isset($_POST['third'])) {
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];
        $error = $file['error'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('pdf');

        if (in_array($fileActualExt, $allowed)) {
            if ($error === 0) {
                $fileNewName = uniqid("", true) . "." . $fileActualExt;
                $fielDestination = "DOCUMENTS/" . $fileNewName;
                move_uploaded_file($fileTmp, $fielDestination);

                $sql = 'UPDATE stage SET presentation = ? WHERE id_stage = ?';
                $stm = $pdo->prepare($sql);
                $stm->execute(array($fileNewName, $_SESSION['id_stage']));

                header("location: profil.etudiant.php");
                ob_end_flush();
            } else {
                echo "something went wrong when uploading your file";
            }
        } else {
            echo "please select pdf file";
        }
    }


    if (isset($_POST['last'])) {
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];
        $error = $file['error'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('pdf');

        if (in_array($fileActualExt, $allowed)) {
            if ($error === 0) {
                $fileNewName = uniqid("", true) . "." . $fileActualExt;
                $fielDestination = "DOCUMENTS/" . $fileNewName;
                move_uploaded_file($fileTmp, $fielDestination);

                $sql = 'UPDATE stage SET attestation = ? WHERE id_stage = ?';
                $stm = $pdo->prepare($sql);
                $stm->execute(array($fileNewName, $_SESSION['id_stage']));

                header("location: profil.etudiant.php");
                ob_end_flush();
            } else {
                echo "something went wrong when uploading your file";
            }
        } else {
            echo "please select pdf file";
        }
    }
} else {
    header('location: ../index.php');
}
