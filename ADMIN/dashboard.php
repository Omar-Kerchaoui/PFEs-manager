<?php
session_start();


if (isset($_SESSION['id_admin'])) {
    $pageTitle = 'Dashboard';
    require "init.php";
    require $tpl . 'navbarAdmin.php';

    $sql = 'SELECT * FROM etudiant ORDER BY id_etu DESC';

    $stm = $pdo->prepare($sql);
    $stm->execute();
    $count = $stm->rowCount();
    $rows = $stm->fetchAll();

    $sql1 = 'SELECT * FROM enseignant ORDER BY id_ens DESC';
    $stm1 = $pdo->prepare($sql1);
    $stm1->execute();
    $count1 = $stm1->rowCount();
    $rows1 = $stm1->fetchAll();
    $i = 0;

?>

    <!-- start dashboard page  -->
    <div class="home-stats">
        <div style="position: relative; z-index: 99" class="py-5">
            <div class="container text-center">
                <!-- <h1>Dashboard</h1> -->
                <div class="row justify-content-center pt-4">
                    <div class="col col-xlg-4 col-md-6">
                        <div class="stat st-members">
                            <i class="fa fa-users mb-3"></i>
                            <div class="info">
                                Nombre d'etudiants
                                <span><a href="etudiant.admin.php"><?php echo $count ?></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col col-xlg-4 col-md-6">
                        <div class="stat st-pending">
                            <i class="fas fa-chalkboard-teacher mb-3"></i>
                            <div class="info">
                                Nombre d'enseignants
                                <span>
                                    <a href="dashboard.php"><?php echo $count1 ?></a>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="latest">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mb-0 pb-0">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="float-end toggle-info">
                                        <i class="fas fa-minus"></i>
                                    </span>
                                    <i class="fa fa-users"></i> Latest Registred Users
                                </div>
                                <div class="panel-body">
                                    <ul class="list-unstyled latest-users">
                                        <?php
                                        foreach ($rows as $row) {
                                            echo "<li>" . $row['nom'] . " " . $row['prenom'] . "</li>";
                                            $i++;
                                            if ($i > 7) {
                                                $i = 0;
                                                break;
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-0 pt-0">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="float-end toggle-info">
                                        <i class="fas fa-minus"></i>
                                    </span>
                                    <i class="fa fa-tag"></i> Latest Items
                                </div>
                                <div class="panel-body">
                                    <ul class="list-unstyled latest-users">
                                        <?php
                                        foreach ($rows1 as $row1) {
                                            echo "<li>" . $row1['nom'] . " " . $row1['prenom'] . "</li>";
                                            $i++;
                                            if ($i > 7) {
                                                $i = 0;
                                                break;
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end dashboard page  -->


<?php

    require $tpl . 'footer.php';
} else {
    header("location: index.admin.php");
}
