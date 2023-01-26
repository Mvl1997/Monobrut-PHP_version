<?php

$errorCodes = array();
$errorCodes[1] = "succes toegevoegd";
$errorCodes[2] = "upload failed";

echo "add building";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monobrut - add building</title>
</head>

<body>
    <nav>
        <a href="../../admin/">Dashboard</a>
    </nav>
    <main>
        <h1>Add a brutalistic building</h1>
        <article class="feedback">

            <?php if (isset($_REQUEST["code"])) {
                $error = $_REQUEST["code"];
                echo $errorCodes[$error];
            } ?>
        </article>
        <section>
            <form id="formBuilding" enctype="multipart/form-data" method="POST" action="uploadBuilding.php">
                <label for="name">Name</label><br>
                <input type="text" name="b_name" required /><br>
                <label for="desc">Description</label><br>
                <textarea id="desc" name="desc" required></textarea><br>
                <label for="city">City</label><br>
                <input type="text" name="city" required /><br>
                <label for="image">Image</label><br>
                <input type="file" name="img_src" id="img_src">
                <button class="btn_add" type="submit">Add</button>
                <button id="cancel_btn">Cancel</button>
            </form>
        </section>
    </main>
    <script>
        //clear the form
        let cancelBtn = document.getElementById('cancel_btn');
        cancelBtn.addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('formBuilding').reset();
        })
    </script>

</body>

</html>