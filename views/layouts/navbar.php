<?php
//var_dump($_SESSION);
if (!isset($_SESSION['user_id'])) {



    ?>

    <nav class="navbar navbar-inverse" style="border-radius: 0px">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/index/index">WebSiteName</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="/user/formRegister"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href=/user/formLogin><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </nav>
<?php } else { ?>

    <nav class="navbar navbar-inverse" style="border-radius: 0px">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/profil/index">WebSiteName</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="/profil/map1">Map 1</a></li>
                <li><a href="/profil/map2">Map 2</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href=/user/logOut><span class="glyphicon glyphicon-log-in"></span> Login out</a></li>
            </ul>
        </div>
    </nav>
    <?php
}
?>