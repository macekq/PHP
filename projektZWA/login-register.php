<?php

    $dbServer = "localhost";
    $dbUser = "root";
    $dbPasswd = "";
    $dbName = "skap";
    $connection = "";

    $connection = mysqli_connect($dbServer, $dbUser, $dbPasswd, $dbName); //connection bude objekt s moji databazi

    if(!$connection) error_log("databazi nelze pripojit");
    else echo "<script>console.log('databaze pripojena')</script>";

    // mysqli_query($connection, 'ALTER TABLE projektZWA MODIFY COLUMN id INT NOT NULL AUTO_INCREMENT')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="uvod.css">
    <title>Document</title>
</head>
<body>
    <main id="login-register">
        <div id="l-r">
            <div class="chooseForm">
                <div class="overRadio" id="chfl" style="background-color: rgb(50,50,50); color: white;">
                    <div>login</div>
                </div>
                <input type="radio" name="form" id="login">
            </div>
            <div class="chooseForm">
                <div class="overRadio" id="chfr">    
                    <div>register</div>
                </div>
                <input type="radio" name="form" id="register">
            </div>
        </div>
        <div class="formCont" id="loginForm">
            <form method="post">
                <div class="formDiv">
                    <div class="info">jméno:</div >
                    <div class="info">heslo:</div >
                </div>
                <div class="formDiv" style="left: 40%;">
                    <input class="input" type="text" id="nameL" name="nameL">
                    <input class="input" type="text" id="passL" name="passL">
                </div>
                <input type="submit" id="subBtt">
            </form>    
        </div>
        <div class="formCont" id="registerForm">
            <form method="post">
                <div class="formDiv">
                    <div class="info">jméno:</div>
                    <div class="info">heslo:</div>
                    <div class="info">email:</div>
                    <div class="info">národnost:</div>
                </div>
                <div class="formDiv" style="left: 40%;">
                    <input class="input" type="text" id="nameR" name="nameR">
                    <input class="input" type="text" id="passR" name="passR">
                    <input class="input" type="email" id="mailR" name="mailR">
                    <input class="input" type="text" id="statR" name="statR">
                </div>
                <input type="submit" id="subBtt">
            </form>
        </div>
        <script>
            const registerForm = document.getElementById('registerForm'), loginForm = document.getElementById('loginForm')
            const regCont = document.getElementById('chfr'), logCont = document.getElementById('chfl')

            document.getElementById('login').addEventListener('click', () => {
                loginForm.style.zIndex = 999
                registerForm.style.zIndex = 4

                logCont.style.backgroundColor = 'rgb(50,50,50)'
                logCont.style.color = 'white'
                regCont.style.backgroundColor = '#cccccc'
                regCont.style.color = 'black'
            })
            document.getElementById('register').addEventListener('click', () => {
                loginForm.style.zIndex = 4
                registerForm.style.zIndex = 999

                regCont.style.backgroundColor = 'rgb(50,50,50)'
                regCont.style.color = 'white'
                logCont.style.backgroundColor = '#cccccc'
                logCont.style.color = 'black'
            })
        </script>
    </main>

    <!-- funkce -->
    <script>
        const hideForms = () => {
            document.getElementById('login-register').style.opacity = '0'
        }
    </script>
<?php
    if(isset($_POST["nameR"]) && isset($_POST["passR"]) && isset($_POST["mailR"]) && isset($_POST["statR"])){

        $name = $_POST["nameR"]; $passwd = $_POST["passR"]; $email = $_POST["mailR"]; $stat = $_POST["statR"];

        $sql = "INSERT INTO projektZWA (jmeno, heslo, email, stat, datum) VALUES ('$name', '$passwd', '$email', '$stat', CURDATE())";
        mysqli_query($connection, $sql);
        
    }
    if(isset($_POST["nameL"]) && isset($_POST["passL"])){
        $name = $_POST["nameL"]; $passwd = $_POST["passL"];
        
        $sql = "SELECT * FROM projektZWA WHERE jmeno = '{$name}' AND heslo = '$passwd'";
        $result = mysqli_query($connection, $sql);
    
        if(mysqli_num_rows($result) > 0){

            while($row = mysqli_fetch_assoc($result)){
    
                // echo "<script>console.log('" . $row['jmeno'] ."','". $row['heslo'] . "','". $row['email'] . "','". $row['datum'] . "')</script>";
                // $USERNAME = $row["jmeno"];

                echo "<script>hideForms()</script>";

                $sql = "SELECT jmeno FROM projektZWA WHERE jmeno = '{$name}'";
                $result = mysqli_query($connection, $sql);

                while($row = mysqli_fetch_assoc($result)){
                    echo "<br>" . $row["jmeno"];
                    $dir = "data/". $row["jmeno"];
                    if(!file_exists($dir)){
                        mkdir($dir);
                    }
                }
            }
        }else{
            echo "<script>window.alert('jmeno neexistuje nebo se neshoduje heslo')</script>";
        }
    }
?>