<?php
session_start();

if (isset($_SESSION['id_ens'])) {
    $pageTitle = 'Profile';
    require "init.php";
    $id_ens = $_SESSION["id_ens"];
    $sql = "SELECT * FROM enseignant WHERE id_ens = ?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$id_ens]);
    $row = $stm->fetch();

?>
    <div class="container-sm">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-4">
                <div class="card mb-3 mx-auto">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img class="img-fluid rounded mb-4" src="uploads/<?php echo $row["photo"] ?>" alt="" width="180">
                            <div class="mt-3">
                                <h4 style="font-weight: ;color:#;"><?php echo $row['nom'] . " " . $row['prenom']; ?></h4>
                                <p class="text-muted font-size-sm"><?php echo $row['departement']; ?></p>
                                <a href="edit.ens.php" class="btn btn-primary">Editer Profil</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3 mx-auto">
                    <div class=" card-body">
                        <div class="row align-items-center">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nom</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $row['nom'] ?> </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Prenom </h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $row['prenom']; ?> </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email UIT</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $row['email']; ?> </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    require $tpl . "footer.php";
} else {
    header("location: ../index.php");
}
