<?php
    require "login-register.php";

    $dbServer = "localhost";
    $dbUser = "root";
    $dbPasswd = "";
    $dbName = "skap";
    $connection = "";

    $connection = mysqli_connect($dbServer, $dbUser, $dbPasswd, $dbName); //connection bude objekt s moji databazi

    if(!$connection) error_log("databazi nelze pripojit");
    else echo "<script>console.log('databaze pripojena')</script>";

    // mysqli_query($connection, 'ALTER TABLE projektZWA MODIFY COLUMN id INT NOT NULL AUTO_INCREMENT')
    // $sql = "ALTER TABLE projektZWA MODIFY COLUMN id INT AUTO_INCREMENT;";
    // mysqli_query($connection, $sql);
?>

<div id="idk">
        <main id="mainCont">
            <nav id="navigace">
                <nav id="optionsMenu">
                    <div class="OMconts" id="editorBtt"> 
                        <input type="radio" name="options" id="editorR">
                        <div class="OMnazvy">EDITOR </div>
                        <div class="cover" id="editorC"></div>
                    </div>
                    <div class="OMconts" id="cteckaBtt">
                        <input type="radio" name="options" id="cteckaR">
                        <div class="OMnazvy">ČTEČKA</div>
                        <div class="cover" id="cteckaC"></div>
                    </div>
                    <div class="OMconts" id="souboryBtt">
                        <input type="radio" name="options" id="souboryR">
                        <div class="OMnazvy">SOUBORY</div>
                        <div class="cover" id="souboryC"></div>
                    </div>
                    <div id="userInfo">
                        <div id="username">bombardinoCrocodilo</div>
                        <img src="assets/user.png">
                    </div>
                </nav>
            </nav>
            <nav id="workspace">
                <div class="WS" id="editorWS">
                    
                    <nav id="editorInputCont">
                        <form method="post" id="editorForm">
                            <nav id="editorOptions">
                                <input type="submit" name="editorSubmitBtt" value="save changes">
                                <input type="submit" name="editorSubmitBtt" value="discard changes">
                            </nav>
                            <nav id="editorInput">
                                <textarea name="textEditor" id="textEditor"></textarea>
                            </nav>
                        </form>
                    </nav>
                    <nav id="editorOutputCont">
                        <nav id="iframeOptions">
                            <div>url - </div>
                            <a href="http://127.0.0.1:5500/hokusPokus/0.html" target="_blank" id="editorLink"><nav id="cpLinkEditor">http://127.0.0.1:5500/hp/hokusPokus/0.html</nav></a>
                            <div id="cpBttContEdit">
                                <button type="button" id="cpDirEditor" onclick="ctrlC('cpLinkEditor')">
                                    <img src="assets/copy.png">
                                </button>
                            </div>
                        </nav>
                        <div id="iframeCont">
                            <iframe src="makeItTierList/index.html" frameborder="0"></iframe>
                        </div>
                    </nav>

                </div>
                <div class="WS" id="cteckaWS">
                    
                    <div id="cteckaCont">
                        <p id="cteckaContentDisplay"></p>
                    </div>

                </div>
                <div class="WS" id="souboryWS">
                    
                    <div id="adresaSoubory">
                        <div>url - </div>
                        <a href="http://127.0.0.1:5500/hokusPokus/0.html" target="_blank" id="souboryLink"><nav id="cpLink">http://127.0.0.1:5500/hokusPokus/0.html</nav></a>
                        <div id="cpBttCont">
                            <button type="button" name="cpDir" id="cpDir" value="copy" onclick="ctrlC('cpLink')">
                                <img src="assets/copy.png">
                            </button>
                        </div>
                    </div>
                    <div id="dirOptions">
                        <nav>
                            <button class="sCHbtt">
                                <img src="assets/arrow.png" style="transform: rotate(180deg) translateY(-8%);">
                            </button>
                            <button class="sCHbtt">
                                <img src="assets/addFolder.png">
                            </button>
                            <button class="sCHbtt" id="addFileBtt">
                                <img src="assets/addFile.png">
                            </button>
                        </nav>
                        <nav id="dirOp2">
                            <button class="sCHbtt" id="removeFileBtt">-</button>
                            <button>editor</button>
                            <button>ctecka</button>
                        </nav>
                    </div>
                    <div id="obsahDir">
                        <ul id="obsahDirList">
                            <!-- <li class="soubor">
                                <nav>skap.php</nav>
                                <img class="dirIcon" src="assets/file.png">
                            </li>
                            <li class="slozka">
                                <nav>assets</nav>
                                <img class="dirIcon" src="assets/arrow.png">
                            </li> -->
                        </ul>
                    </div>
                </div>
            </nav>
        </main>
    </div>

    <script>
        var USER = {
            selected: '', name: '', ctecka: '', editor: '',
            files: [], filesAsocDir: [], currDir: '', ids: []
        }
        console.log(USER.dirContents)

        function addFromDir(name, dirName){
            USER.files.push(name)
            USER.filesAsocDir.push(dirName)
            console.log(USER)
        }
        function findSlash(str){
            for(let i = str.length-1; i>=0; i--){
                if(str[i] == '/') return i
            }
        }
        function cd00(){
            let path = USER.currDir
            
            if(path != `data/${USER.name}`){
                let index = findSlash(path)
                showDirContent(path.substring(0, index))
            }
        }
        function showDirContent(dir){
            USER.currDir = dir
            const dirList = document.getElementById('obsahDirList')
            dirList.innerHTML = ''


            for(let i = 0; i<USER.files.length; i++){
                if(USER.filesAsocDir[i] == dir){

                    let name = USER.files[i]

                    let li = document.createElement('li')
                    let nav = document.createElement('nav')
                    let img = document.createElement('img')
                    
                    nav.innerText = name
                    img.src = name.includes('.') ? 'assets/file.png' : 'assets/arrow.png';
                    img.classList.add('dirIcon')
                    if(name.includes('.')){
                        img.src = "assets/file.png"
                    }else{
                        img.src = "assets/arrow.png"
                        nav.addEventListener("click", () => {
                            showDirContent(`${USER.filesAsocDir[i]}/${USER.files[i]}`)
                        })
                    }

                    let id
                        
                    do{
                        id = Math.floor(Math.random()*1000)
                    }while(USER.ids.includes(id))
                    
                    li.id = `file-${id}`
                    USER.ids.push(li.id)
                    
                    li.append(nav, img)

                    dirList.appendChild(li)
                    console.log(USER)
                }
            }
        }

        function ctrlC(id){
            const link = document.getElementById(id).innerText

            navigator.clipboard.writeText(link)
        }   
        const editor = document.getElementById('editorBtt'), ctecka = document.getElementById('cteckaBtt'), soubory = document.getElementById('souboryBtt')
        const editorR = document.getElementById('editorR'), cteckaR = document.getElementById('cteckaR'), souboryR = document.getElementById('souboryR')
        const editorWS = document.getElementById('editorWS'), cteckaWS = document.getElementById('cteckaWS'), souboryWS = document.getElementById('souboryWS')
        const editorC = document.getElementById('editorC'), cteckaC = document.getElementById('cteckaC'), souboryC = document.getElementById('souboryC')

        const bgArr = [editor, ctecka, soubory], bttArr = [editorR, cteckaR, souboryR]
        const wsArr = [editorWS, cteckaWS, souboryWS], cArr = [editorC, cteckaC, souboryC]
        
        souboryC.style.opacity = "1"
        for(let j = 0; j<bgArr.length; j++) if(j!=2) bgArr[j].style.backgroundColor = 'rgb(150,150,150)'

        for(let i = 0; i<bgArr.length; i++){

            bttArr[i].addEventListener('change', () => {

                if(bttArr[i].checked){

                    bgArr[i].style.backgroundColor = "white"
                    cArr[i].style.opacity = "1"
                    wsArr[i].style.zIndex = "999"
                    wsArr[i].style.opacity = "1"

                    for(let j = 0; j<bgArr.length; j++){
                        if(j!=i){
                            bgArr[j].style.backgroundColor = 'rgb(150,150,150)'
                            cArr[j].style.opacity = "0"
                            wsArr[j].style.zIndex = "0"
                            wsArr[j].style.opacity = "0"
                        }
                    }
                }
            });
        }
    </script>
    <?php
    function searchDir($dir){
        $files = scandir($dir);

        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                if(str_contains($file, ".")){

                    echo "<script>addFromDir('{$file}','{$dir}')</script>";
                }else{
                    echo "<script>addFromDir('{$file}','{$dir}')</script>";
                    searchDir("{$dir}/{$file}");
                }
            }
        }
    }
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
                $USERNAME = $row["jmeno"];
                echo "<script>document.getElementById('username').innerText = '{$USERNAME}'</script>";
                echo "<script>document.getElementById('souboryLink').innerText = 'localhost/php/projektZWA/data/{$USERNAME}'</script>";
                echo "<script>USER.name='{$USERNAME}'</script>";

                $dir = "data/{$USERNAME}";
                searchDir($dir);

                echo "<script>showDirContent('{$dir}')</script>";

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
</body>
</html>