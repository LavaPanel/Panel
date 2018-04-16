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
                    echo "<option>$driver</option>";
                }
            }
            ?>
        </select>
    </div>

    <div id="forms">
        <form id="mysql">
            <div class="row">
                <div class="col">
                    <label for="host">Host</label>
                    <input class="form-control" name="host">
                </div>

                <div class="col">
                    <label for="port">Port</label>
                    <input class="form-control" name="port" type="number" value="3363">
                </div>

                <div class="col">
                    <label for="db">Database</label>
                    <input class="form-control" name="db">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="user">User</label>
                    <input class="form-control" name="user">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="pass">Password</label>
                    <input class="form-control" name="pass" type="password">
                </div>
            </div>
        </form>

        <form id="sqlite">
            <label for="path">Path to sql</label>
            <input class="form-control" name="path">
        </form>
    </div>
    <button id="test-conn" class="btn btn-success"><span class="fa fa-play-circle"></span>Test Connection</button>
</div>