<script>
    $(document).ready(function () {
        $("#success").hide();
        $("#fail").hide();
        typeChange();
    });
</script>
<?php
if (file_exists("storage/db.json")) {
    $data = json_decode(file_get_contents('storage/db.json'), true);
    $type = $data['type'];
    ?>
    <script>
        $(document).ready(function () {
            <?php
            if($type == "mysql") {
                ?>
                $("#host").attr("value", "<?php echo $data['host'] ?>");
                $("#port").attr("value", "<?php echo $data['port'] ?>");
                $("#db").attr("value", "<?php echo $data['db'] ?>");
                $("#user").attr("value", "<?php echo $data['user'] ?>");
                $("#pass").attr("value", "<?php echo $data['pass'] ?>");
                $("#success").show();
                enableButtons(2);
            <?php
            }
            ?>
        });
    </script>
    <?php
}
?>
<div id="step2">
    <div class="jumbotron">
        <h1>Storage Setup</h1>
        <hr>
        <p>In this step you will set up your storage method</p>
    </div>

    <div class="form-group">
        <label for="type">Database Type</label>
        <select class="form-control" id="type">
            <?php
            foreach (PDO::getAvailableDrivers() as $driver) {
                if (in_array($driver, $supported)) {
                    if ($type != null) {
                        if ($type == $driver) {
                            echo "<option selected>$driver</option>";
                            continue;
                        }
                    }
                    echo "<option>$driver</option>";
                }
            }
            ?>
        </select>
    </div>

    <div id="success" class="alert alert-success" role="alert">Database connected!</div>
    <div id="fail" class="alert alert-danger" role="alert"></div>

    <div id="step2-forms">
        <form id="mysql">
            <div class="row">
                <div class="col">
                    <label for="host">Host</label>
                    <input class="form-control" required id="host" name="host" value="127.0.0.1">
                </div>

                <div class="col">
                    <label for="port">Port</label>
                    <input class="form-control" required id="port" name="port" type="number" value="3363">
                </div>

                <div class="col">
                    <label for="db">Database</label>
                    <input class="form-control" required id="db" name="db" value="lavapanel">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="user">User</label>
                    <input class="form-control" required id="user" name="user" value="lavapanel">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="pass">Password</label>
                    <input class="form-control" required id="pass" name="pass" type="password">
                </div>
            </div>
        </form>

        <form id="sqlite">
            <label for="path">Path to sql</label>
            <input class="form-control" id="path" name="path">
        </form>
    </div>
    <button id="test-conn" class="btn btn-success"><span class="fa fa-play-circle"></span>Test Connection</button>
</div>