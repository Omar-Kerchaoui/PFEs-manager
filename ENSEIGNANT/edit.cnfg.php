<?php
session_start();
print_r($_POST);
print_r($_FILES);
if (isset($_SESSION["id_ens"])) {
    if (isset($_POST["submit"])) {
        require "init.php";
        if (!empty($_FILES['fichier1']['name'])) {
            $img_name = $_FILES['fichier1']['name'];
            $img_size = $_FILES['fichier1']['size'];
            $tmp_name = $_FILES['fichier1']['tmp_name'];
            $error = $_FILES['fichier1']['error'];

            if ($error === 0) {
                if ($img_size > 125000) {
                    $em = "Sorry your file is too large.";
                    header("Location: index.php?error=$em");
                } else {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    echo $img_ex; //=>png or txt
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array("jpg", "jpeg", "png");
                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                        $img_upload_path = 'uploads/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
                    } else {
                        $em = "You can't upload files of this type.";
                        header("Location: index.php?error=$em");
                    }
                }
            } else {
                // header("Location:index.php");
            }
        } else {
            $new_img_name = $_POST['oldimg'];
        }

        // print_r($_POST);
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $dep = $_POST["dep"];
        // $photo = $_POST["photo"];probleme avec photo
        $id = $_SESSION["id_ens"];
        $sql = "UPDATE enseignant set nom=?,prenom=?, photo=?,email=?,password=?,departement=? where id_ens=?";
        $stm = $pdo->prepare($sql);
        $stm->execute([$nom, $prenom, $new_img_name, $email, $pass, $dep, $id]);
    }

    header("location:profil.enseignant.php");
} else {
    header("Location : ../index.php");
}
