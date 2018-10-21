<?php
session_start();


require 'inc/head.php'; ?>

<section class="cookies container-fluid">
    <div class="row">




        <p>Pecan nuts : Nombre dans votre panier:<?php echo $_SESSION['Pecan_nuts'];?></p>


        <p>Chocolate chips : Nombre dans votre panier:<?php echo $_SESSION['chocolate_chips'];?></p>

        <p>Chocolate cookie : Nombre dans votre panier:<?php echo $_SESSION['Chocolate_cookie'];?></p>


        <p>MM's cookies : Nombre dans votre panier: <?php echo $_SESSION['MMs_cookies'];?></p>



    </div>
</section>
<?php require 'inc/foot.php'; ?>