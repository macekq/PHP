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

    mysqli_query($connection, 'ALTER TABLE projektZWA MODIFY COLUMN id INT NOT NULL AUTO_INCREMENT');
    // $sql = "ALTER TABLE projektZWA MODIFY COLUMN id INT AUTO_INCREMENT;";
    // mysqli_query($connection, $sql);
?>

<div id="idk">
        <main id="mainCont">
            <nav id="navigace">
                <nav id="optionsMenu">
                    <div class="OMconts" id="editorBtt"> 
                        <input type="radio" name="options" id="editorR" class="OMcontsRadio">
                        <div class="OMnazvy">EDITOR </div>
                        <div class="cover" id="editorC"></div>
                    </div>
                    <div class="OMconts" id="cteckaBtt">
                        <input type="radio" name="options" id="cteckaR" class="OMcontsRadio">
                        <div class="OMnazvy">ČTEČKA</div>
                        <div class="cover" id="cteckaC"></div>
                    </div>
                    <div class="OMconts" id="souboryBtt">
                        <input type="radio" name="options" id="souboryR" class="OMcontsRadio">
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
                                <button type="button" class="sCHbtt" onclick="saveChanges()">save changes</button>
                                <button type="button" class="sCHbtt" onclick="discardChanges()">discard changes</button>
                            </nav>
                            <nav id="editorInput">
                                <textarea name="textEditor" id="textEditor"></textarea>
                            </nav>
                        </form>
                    </nav>
                    <nav id="editorOutputCont">
                        <nav id="iframeOptions">
                            <div>url - </div>
                            <a href="http://127.0.0.1:5500/hokusPokus/0.html" target="_blank" id="editorLink">
                                <nav id="cpLinkEditor">http://127.0.0.1:5500/hp/hokusPokus/0.html</nav>
                            </a>
                            
                            <div id="cpBttContEdit">
                                <button type="button" id="cpDirEditor" onclick="ctrlC('cpLinkEditor')">
                                    <img src="assets/copy.png">
                                </button>
                            </div>
                        </nav>
                        <div id="iframeCont">
                            <iframe id="editorIframe" src="" frameborder="0"></iframe>
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
                        <nav style="display: flex;">
                            <button class="sCHbtt" onclick="cd00()">
                                <img src="assets/arrow.png" style="transform: rotate(180deg) translateY(-8%);">
                            </button>

                            <form method="get" id="addFF">
                                <button type="button" name="addFFBtt" class="sCHbtt" onclick="submitForm('folder')">
                                    <img src="assets/addFolder.png">
                                </button>
                                <button type="button" name="addFFBtt" class="sCHbtt" onclick="submitForm('file')">
                                    <img src="assets/addFile.png">
                                </button>
                            </form>
                        
                        </nav>
                        <nav id="dirOp2">
                        
                            <form method="get" id="removeFF">
                                <button type="button" class="sCHbtt" id="removeFileBtt" onclick="removeFF()">-</button>
                            </form>
                            
                            <form method="get" id="openInE||C">
                                <button type="button" class="sCHbtt" onclick="openInEC('e')">editor</button>
                                <button type="button" class="sCHbtt" onclick="openInEC('c')">ctecka</button>
                            </form>    
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
                        <form method="post" id="uploadFile">
                            <input type="file">
                            <button type="button" onclick="uploadFile()">upload</button>
                        </form>
                    </div>
                </div>
            </nav>
        </main>
    </div>

    <script>

        document.getElementById('userInfo').addEventListener('click', () => {
            if(window.confirm('opravdu se chcete odhlasit?')){
                window.location.assign('/php/projektZWA')
            }
        })


        const textEditor = document.getElementById("textEditor"), textCtecka = document.getElementById("cteckaCont")
        const editorIframe = document.getElementById("editorIframe"), editorLink = document.getElementById("cpLinkEditor"), editorLinkHref = document.getElementById("editorLink")
        const fileUpload = document.getElementById("uploadFile")

        var USER = {
            selected: '', name: '', ctecka: '', editor: '', editorContent: '', cteckaContent: '',
            files: [], filesAsocDir: [], currDir: '', ids: [],
        }
        //-----------------------------------------------------------------------------
        async function submitForm(action) {
            let nazev, isFolder

            if (action == "folder") {
                nazev = ridStringOf(window.prompt("nazev slozky:\n(jestli tam das tecku '.' tak ji smazu)"), ".")
                isFolder = "true"
            
            } else {
                nazev = window.prompt("nazev souboru i s typem souboru:\n(all files)")
                if(!nazev.includes(".")) nazev += ".txt"
                isFolder = "false"
            }
            
            let url = `http://localhost/PHP/projektZWA/proces1.php?nazev=${nazev}&path=${USER.currDir}&SS=${isFolder}`;

            try{
                const response = await fetch(url, {
                    method: "GET",
                })

                USER.files.push(nazev)
                USER.filesAsocDir.push(USER.currDir)

                showDirContent(USER.currDir)

            }catch(error){window.alert("hopa")}
        }
        async function removeFF(){
            
            if(window.confirm("chcete smazat slozku/soubor?")){
                let isFolder
                if(USER.selected.includes(".")){
                    isFolder = "false"
                }else{
                    isFolder = "true"
                }

                let url = `http://localhost/PHP/projektZWA/proces2.php?nazev=${USER.selected}&dir=${USER.currDir}&SS=${isFolder}`
                // window.alert(url)

                try{
                    const response = await fetch(url, {
                        method: "GET"
                    })

                    for(let i = 0; i<USER.files.length; i++){
                        if(USER.selected == USER.files[i] && USER.currDir == USER.filesAsocDir[i]){
                            
                            USER.files.splice(i, 1)
                            USER.filesAsocDir.splice(i, 1)
                            break
                        }
                    }
                    showDirContent(USER.currDir)
                
                }catch(error){window.alert("hopa")}
            }
        }
        async function openInEC(EC){
            let name = USER.selected, dir = USER.currDir
            
            if(name.includes(".")){
                
                let url = `http://localhost/php/projektZWA/proces3.php?nazev=${name}&dir=${dir}`

                const response = await fetch(url, {
                    method: "GET"
                })
                if(response.ok){
                    let returnString = await response.text()
                                            // NIGGER
                    if(EC == 'c'){
                        USER.ctecka = `${USER.currDir}/${USER.selected}`
                        USER.cteckaContent = returnString

                        textCtecka.innerText = returnString.split('■').join('\n')
                        window.alert("otevreno ve ctecce")
                    
                    }else{
                        USER.editor = `${USER.currDir}/${USER.selected}`
                        USER.editorContent = returnString

                        textEditor.value = returnString.split('■').join('\n')

                        editorIframe.src = `http://localhost/php/projektZWA/${USER.editor}`
                        editorLink.innerText = `http://localhost/php/projektZWA/${USER.editor}`
                        editorLinkHref.href = `http://localhost/php/projektZWA/${USER.editor}`
                        
                        window.alert("otevreno v editoru")
                    }
                }else{
                    window.alert("hopa")
                }

            }else{
                window.alert("toe slozka ty sasku")
            }
        }
        async function saveChanges(){
2
            if(window.confirm("opravdu chtete ulozit zmeny?" !== null)){

                let url = `http://localhost/php/projektZWA/proces4.php`

                try{
                    const response = await fetch(url, {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded', // or 'application/json'
                        },
                        body: new URLSearchParams({
                            fullDir: USER.editor,
                            content: textEditor.value
                        })
                    })

                    USER.editorContent = textEditor.value
                    editorIframe.src = USER.editor

                }catch(error){window.alert("hopa")}
            }
        }
        async function uploadFile(){
            if(!fileUpload.files || fileUpload.files.length === 0){
                
                window.alert("nejprve vloz soubor")
            }else{

                const formData = new FormData()
                const file = fileUpload.files[0]
                formData.append('file', file)
            
                let url = `http://localhost/php/projektZWA/proces5.php`
                try{
                    const response = await fetch(url, {
                        method: "POST",
                        body: new URLSearchParams({
                            FD: formData,
                            dir: USER.currDir
                        })
                    })

                }catch(error){window.alert("hopa fr")}
            }
        }
        function discardChanges(){
            if(window.confirm("opravdu chtete smazat vsechny zmeny?" !== null)){
        
                textEditor.value = USER.editorContent.split('■').join('\n')
            }
        }
        function ridStringOf(string, char){
            let newString = ""
            for(let i of string){
                if(i != char) newString += i
            }
            return newString
        }
        //-----------------------------------------------------------------------------
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

        function selectFile(id, name){
            if(name == USER.selected){

                if(!name.includes(".")){

                    showDirContent(`${USER.currDir}/${name}`)
                }
                
            }else{
                document.getElementById(id).style.backgroundColor = "rgb(180,180,180)"
                for(let i of USER.ids){
                    if(i!=id){
                        document.getElementById(i).style.backgroundColor = "white"
                    }
                }
                document.getElementById('cpLink').innerText = `localhost/php/projektZWA/${USER.currDir}/${name}`
                document.getElementById('souboryLink').href = `${USER.currDir}/${name}`
            
                USER.selected = name
            }
        }

        function showDirContent(dir){
            USER.currDir = dir
            USER.ids = []
            USER.selected = ''

            const dirList = document.getElementById('obsahDirList')
            dirList.innerHTML = ''

            console.log(USER)

            document.getElementById('cpLink').innerText = `localhost/php/projektZWA/${USER.currDir}`
            document.getElementById('souboryLink').href = `${USER.currDir}`

            for(let i = 0; i<USER.files.length; i++){
                console.log(USER.files[i], USER.filesAsocDir[i], 0)
                if(USER.filesAsocDir[i] == dir){
                    // console.log(true, 1)

                    let name = USER.files[i]
                    
                    let li = document.createElement('li')
                    let nav = document.createElement('nav')
                    let img = document.createElement('img')
                    
                    nav.innerText = name
                    img.src = name.includes('.') ? 'assets/file.png' : 'assets/arrow.png';
                    img.classList.add('dirIcon')
                    
                    if(name.includes('.')){
                        img.src = "assets/file.png"

                        let a = document.createElement('a')
                        let aImg = document.createElement('img')
                        // a.download = true
                        a.setAttribute("download", USER.files[i])
        
                        a.href = `${USER.filesAsocDir[i]}/${USER.files[i]}`
                        a.appendChild(aImg)
        
                        a.classList.add('fileDownloadBtt')
        
                        aImg.src = "assets/download.png"


                        li.append(nav, a, img)
                    }else{
                        img.src = "assets/arrow.png"
                        // nav.addEventListener("click", () => {
                            //     showDirContent(`${USER.filesAsocDir[i]}/${USER.files[i]}`)
                            // })
                            li.append(nav, img)
                    }
                        
                        let id
                        
                        do{
                        id = Math.floor(Math.random()*1000)
                    }while(USER.ids.includes(id))
                    
                    
                    dirList.appendChild(li)

                    li.id = `file-${id}`
                    USER.ids.push(li.id)
                    console.log(USER)

                    li.addEventListener('click', () => {
                        selectFile(li.id, name)
                    })
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
        textEditor.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                e.preventDefault(); // Prevent default tab behavior
                
                // Get current cursor position
                const start = this.selectionStart;
                const end = this.selectionEnd;
                const value = this.value;
                
                // Insert tab character
                this.value = value.substring(0, start) + '\t' + value.substring(end);
                
                // Move cursor position after the inserted tab
                this.selectionStart = this.selectionEnd = start + 1;
            }
        });
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
        
        echo "true";
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
                // echo "<script>document.getElementById('souboryLink').innerText = 'localhost/php/projektZWA/data/{$USERNAME}'</script>";
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