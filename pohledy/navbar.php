<?php

$zalozka = ( isset ($_GET['zalozka']) ) ? $_GET['zalozka'] : 'menu';
?>
<nav class="navbar">
    <div class="container_fluid menu">
        <div class="navbar-header">
            <a class="navbar-brand logo" href="/">
                <img src="img/logo.svg" alt="Hlavní strana" class="img_logo" >
            </a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
            <li><a href="#">Page 3</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li <?php if ( $zalozka == 'login' )
                { 
                    echo 'class="active"';
                }?>><a href="/login"><span class="glyphicon glyphicon-user"></span> přihlásit se</a></li>
        </ul>
    </div>
</nav>