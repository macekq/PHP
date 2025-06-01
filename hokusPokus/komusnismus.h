<body>
    <form method="post" id="f1">
        <textarea id="in" name="in"></textarea>

        <div style="position: absolute; top: 60vh;">
            <label for="nazev">nazev souboru</label>
            <input type="text" id="nazev" name="nazev">
            <input type="submit" id="saveBtt" value="save">
        </div>
    </form>
    <form method="post" id="f2">
        <label for="nazevSouboru">otevrit soubor</label>
        <input type="text" id="nazevSouboru" name="nazevSouboru">
        <input type="submit">
    </form>

    <form method="post" id="f3">
        <label for="dir">dir</label>
        <input type="text" id="dir" name="dir">
        <input type="submit">
    </form>

    <script>
        function writeOutContent(content){
            console.log(content.split('■').join("\n"))
            document.getElementById('in').value = content.split('■').join('\n')
        }
        document.getElementById('saveBtt').addEventListener("click", () => {
            const input = document.getElementById('in')
            
            // console.log("nazev: ", nazev)
            console.log("content", input.value)
        })
    </script>