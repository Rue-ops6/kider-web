

<!DOCTYPE html>
<html lang="en">
<head>
<?php   require_once "Includes/Header.php";   ?>
</head>

<body>
<?php
require_once "Includes/spinner.php";
require_once "Includes/NAVlink.php";

?>
<!--each is idiosyncratic with its name -->        <!-- Page Header End -->
<div class="container-xxl py-5 page-header position-relative mb-5">
            <div class="container py-5">
                <h1 class="display-2 text-white animated slideInDown mb-4">Facilities</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="- index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="classes (2).php">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Facilities</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->


        <?php   require_once "Includes/facilities.php";?>

        
        <?php   require_once "Includes/FooterInclusive.php";   ?>
</body>

</html>