<?php 
    require_once 'conn.php';
    if (!empty($_SESSION['errors'])) { ?>
        <div class="alert alert-danger" > <?php
        foreach ($_SESSION['errors'] as $error) {
            echo $error . '<br/>';
            }  ; ?></div> <?php
        }
        unset($_SESSION['errors']);

                
            