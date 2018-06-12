<script>
    $(document).ready(function () {
        $("#<?php echo $title ?>").addClass("active");
    });
</script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand"><img src="/include/img/banner.png" height="30px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item" id="Index">
                <a class="nav-link" href="#">Home</a>
            </li>
        </ul>
    </div>
</nav>