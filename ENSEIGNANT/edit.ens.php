<?php
session_start();
if (isset($_SESSION["id_ens"])) {
    $pageTitle = 'Edit';
    require "init.php";
    $sql = "SELECT * FROM enseignant where id_ens= ?";
    $id = $_SESSION["id_ens"];
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $row = $stm->fetch()
?>
    <div class="container">
        <div class="row mt-5 ">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card mb-3 mx-auto">
                    <div class="card-body text-center">
                        <img class="rounded mb-4" src="uploads/<?php echo $row["photo"] ?>" alt="image" width="180">
                        <h5 class=""><?php echo $row["nom"] . " " . $row["prenom"] ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card mb-3 mx-auto">
                    <form action="edit.cnfg.php" method="POST" enctype="multipart/form-data">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 personal-info">
                                    <div class="form-group">
                                        <label class="lab_edit mb-2">Nom</label>
                                        <input type="text" class="form-control" name="nom" value="<?php echo $row["nom"] ?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 personal-info">
                                    <div class="form-group">
                                        <label class="lab_edit mb-2">Prenom</label>
                                        <input type="text" class="form-control" name="prenom" value="<?php echo $row["prenom"] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 personal-info">
                                    <div class="form-group">
                                        <label class="lab_edit mb-2">Email Institutionnel</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $row["email"] ?>"">
                                    </div>
                                </div>
                                <div class=" col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 personal-info">
                                        <div class="form-group">
                                            <label class="lab_edit mb-2">Mot de passe</label>
                                            <input type="password" class="form-control" name="pass" value="<?php echo $row["password"] ?>"">
                                        </div>
                                </div>
                            </div>
                            <div class=" row">
                                            <div class=" col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 personal-info">
                                                <div class="form-group">
                                                    <label for="dep" id="dep" class="lab_edit mb-2">departement</label>
                                                    <select name="dep" class="browser-default custom-select form-select">
                                                        <option value="electrique">electrique</option>
                                                        <option selected="" value="informatique">informatique</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <input type="hidden" name="oldimg" value="<?php echo $row['photo']; ?>">

                                            <div class=" col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 personal-info">
                                                <div class="form-group">
                                                    <label class="lab_edit mb-2">Photo</label>
                                                    <input type="file" name="fichier1" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="text-right">
                                                <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                            </div>
                                        </div>
                                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



<?php
    require $tpl . 'footer.php';
} else {
    header('location: ../index.php');
}
?>