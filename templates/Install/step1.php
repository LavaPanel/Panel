<div id="step1">
    <div class="jumbotron">
        <h1>Extensions Check</h1>
        <hr>
        <p>In this step we will check to make sure you have the extensions the panel needs to operate</p>
    </div>
    <?php
    $needed = array(
        "json",
        "curl",
        "PDO"
    );
    $not_loaded = false;
    foreach ($needed as $needs) {
        if (extension_loaded($needs)) {
            if ($needs == "PDO") {
                if (count(PDO::getAvailableDrivers()) == 0) {
                    echo "<p class='extension'>" . ucwords($needs) . " - <img class='bad-pdo' height='20' id='bad' src='include/img/cross.svg' alt='Bad!'></p>";
                    $not_loaded = true;
                } else {
                    $supportedCount = 0;
                    foreach (PDO::getAvailableDrivers() as $driver) {
                        if (in_array($driver, $supported)) {
                            $supportedCount++;
                        }
                    }
                    if ($supportedCount == 0) {
                        echo "<p class='extension'>" . ucwords($needs) . " - <img class='bad-pdo' height='20' id='bad' src='include/img/cross.svg' alt='Bad!'></p>";
                        $not_loaded = true;
                    } else {
                        echo "<p class='extension'>" . ucwords($needs) . " - <img class='good' height='20' src='include/img/check.svg' alt='Good!'></p>";
                    }
                }
            } else {
                echo "<p class='extension'>" . ucwords($needs) . " - <img class='good' height='20' src='include/img/check.svg' alt='Good!'></p>";
            }
        } else {
            echo "<p class='extension'>" . ucwords($needs) . " - <img class='bad' height='20' id='bad' src='include/img/cross.svg' alt='Bad!'></p>";
            $not_loaded = true;
        }
    }
    if ($not_loaded) {
        echo "Extensions needed! Please reload the page after you've installed the extensions";
    } else {
        ?>
        <script>
            $(document).ready(function () {
                enableButtons(1);
            });
        </script>
        <?php
    }
    ?>
</div>