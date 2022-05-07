<?php
//starting session
session_start();

//no navbar variable initialization

//importing connect file
require "connect.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST["user"] ?? "etudiant";

    if ($user == "admin") {
        $name = $_POST['name'];
        $pass = $_POST['password'];
        if (empty($name)) {
            echo '<div class="alert alert-danger text-center">Le nom est obligatoire</div>';
        }
        if (empty($pass)) {
            echo '<div class="alert alert-danger text-center">Le mot de passe est obligatoire</div>';
        }
        if (!empty($name) && !empty($pass)) {
            $sql = "SELECT * FROM admins WHERE username = ? AND pass = ?";
            $stm = $pdo->prepare($sql);
            $stm->bindParam(1, $name, PDO::PARAM_STR);
            $stm->bindParam(2, $pass, PDO::PARAM_STR);
            $stm->execute();
            $row = $stm->fetch();

            if ($stm->rowCount() > 0) {
                $_SESSION['id_admin'] = $row['id_admin'];
                echo 'logAdminSeccuss';
            } else {
                echo '<div class="alert alert-danger text-center">Le mot de passe ou le nom est incorrect</div>';
            }
        }
    } elseif ($user == "enseignant") {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        if (empty($email)) {
            echo '<div class="alert alert-danger text-center">Le email est obligatoire</div>';
        }
        if (empty($pass)) {
            echo '<div class="alert alert-danger text-center">Le mot de passe est obligatoire</div>';
        }
        if (!empty($email) && !empty($pass)) {
            $sql = "SELECT * FROM enseignant WHERE email = ? AND password = ?";
            $stm = $pdo->prepare($sql);
            $stm->bindParam(1, $email, PDO::PARAM_STR);
            $stm->bindParam(2, $pass, PDO::PARAM_STR);
            $stm->execute();
            $row = $stm->fetch();
            if ($stm->rowCount() > 0) {
                $_SESSION['id_ens'] = $row['id_ens'];
                echo 'logEnsSeccuss';
            } else {
                echo '<div class="alert alert-danger text-center">Le mot de passe ou le email est incorrect</div>';
            }
        }
    } elseif ($user == 'etudiant') {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        if (empty($email)) {
            echo '<div class="alert alert-danger text-center">Le email est obligatoire</div>';
        }
        if (empty($pass)) {
            echo '<div class="alert alert-danger text-center">Le mot de passe est obligatoire</div>';
        }
        if (!empty($email) && !empty($pass)) {
            $sql = "SELECT * FROM etudiant WHERE email = ? AND password = ?";
            $stm = $pdo->prepare($sql);
            $stm->bindParam(1, $email, PDO::PARAM_STR);
            $stm->bindParam(2, $pass, PDO::PARAM_STR);
            $stm->execute();
            $row = $stm->fetch();
            if ($stm->rowCount() > 0) {
                $_SESSION['id_etu'] = $row['id_etu'];
                echo 'logEtdSeccuss';
            } else {
                echo '<div class="alert alert-danger text-center">Le mot de passe ou le email est incorrect</div>';
            }
        }
    }
} else {
    header("location: login.php");
}
