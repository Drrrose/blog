<?php 
if (!empty($_SESSION['success'])) { ?>
    <div class="alert alert-success" role="alert"> <?php echo  $_SESSION['success']; ?></div>
        <?php
    }
    unset($_SESSION['success']);