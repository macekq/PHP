<?php

    if(isset($_FILES['file'])){

        $dir = $_POST['dir'];
        $file = $_FILES['file'];
        
        $location = $_FILES['file']['tmp_name'];

        move_uploaded_file($location, $dir);
    }

?>