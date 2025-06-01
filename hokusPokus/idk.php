<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <form method="get">
        <button type="button" onclick="submitForm()">btt</button>
    </form>
<body>
    <script>
        async function submitForm(){
            window.alert("spusteno")
            let url = `http://localhost/php/hokuspokus/proces.php?true=david`

            const response = await fetch(url, {
                method: "GET"
            })
            if(response.ok){
                let returnString = await response.text()
                window.alert(returnString)

            }
        }
    </script>
</body>
</html>