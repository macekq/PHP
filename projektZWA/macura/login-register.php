<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="uvod.css">
    <link rel="stylesheet" href="pls.css">
    <link rel="stylesheet" href="editor-ctecka.css">
    <title>Document</title>
</head>
<body>
    <main id="login-register">
        <div id="l-r">
            <div class="chooseForm">
                <div class="overRadio" id="register" style="cursor: poiter;">
                    <div>login</div>
                </div>
                <!-- <input class="l-rRadio" type="radio" name="form" id="login"> -->
            </div>
            <div class="chooseForm">
                <div class="overRadio" id="login" style="background-color: rgb(50,50,50); color: white;cursor: poiter;">    
                    <div>register</div>
                </div>
                <!-- <input class="l-rRadio" type="radio" name="form" id="register"> -->
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
                const regCont = document.getElementById('register'), logCont = document.getElementById('login')
                loginForm.style.zIndex = "999"

                regCont.addEventListener('click', () => {
                    loginForm.style.zIndex = "999"
                    registerForm.style.zIndex = "0"

                    logCont.style.backgroundColor = 'rgb(50,50,50)'
                    logCont.style.color = 'white'
                    regCont.style.backgroundColor = '#cccccc'
                    regCont.style.color = 'black'
                    console.log("login")
                })
                logCont.addEventListener('click', () => {
                    loginForm.style.zIndex = "0"
                    registerForm.style.zIndex = "999"

                    regCont.style.backgroundColor = 'rgb(50,50,50)'
                    regCont.style.color = 'white'
                    logCont.style.backgroundColor = '#cccccc'
                    logCont.style.color = 'black'
                    console.log("register")
                })
        </script>
    </main>

    <!-- funkce -->
    <script>
        const hideForms = () => {
            document.getElementById('login-register').style.opacity = '0'
            document.getElementById('login-register').style.zIndex = 0

            document.getElementById('idk').style.zIndex = 999
        }
    </script>