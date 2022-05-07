<?php
$noNavbar = '';
$pageTitle = 'Home';
require "init.php";

// if (isset($_SESSION['']))
?>

<div class="main">
    <div class="container-md py-5 " style="position: relative; z-index: 300;">
        <!-- admin start  -->
        <div class="row justify-content-center mb-4 card  mx-auto">
            <div class="card-body text-light text-center fs-2 p-4" style="background-color: #007bff;">
                <h3 class="">Gerer Les PFE En Un seule Click</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-8 mb-5">
                <div class="hover">
                    <div class="card mx-auto shadow-lg" style="width: 100%;">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOHAqB6Lv8htPEjA8yRRW4W5TMjzS27bVGvqiO5nXBliJDugRFtDdyhbYTAjEs6vMDhLc&usqp=CAU&w=940" class="card-img-top" alt="...">
                        <div class="card-body py-4">
                            <h5 class="card-title text-center">Espace Admin</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="login.php?user=admin" class="btn btn-primary w-100">SE CONNECTER</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- admin end  -->

            <!-- student start  -->
            <div class="col-lg-4 col-sm-8 mb-5">
                <div class="hover">
                    <div class="card mx-auto shadow-lg" style="width: 100%;">
                        <img src="https://images.pexels.com/photos/1438081/pexels-photo-1438081.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="card-img-top" alt="...">
                        <div class="card-body py-4">
                            <h5 class="card-title text-center">Espace Etudiant</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="login.php?user=etudiant" class="btn btn-primary w-100">SE CONNECTER</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- student end  -->

            <!-- teacher start  -->
            <div class="col-lg-4 col-sm-8 mb-5">
                <div class="hover">
                    <div class="card mx-auto shadow-lg" style="width: 100%;">
                        <img src="https://images.pexels.com/photos/3184328/pexels-photo-3184328.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="card-img-top" alt="...">
                        <div class="card-body py-4">
                            <h5 class="card-title text-center">Espace Enseignant</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="login.php?user=enseignant" class="btn btn-primary w-100">SE CONNECTER</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- teacher start  -->
        </div>
    </div>
</div>
<?php
require $tpl . "footer.php";
