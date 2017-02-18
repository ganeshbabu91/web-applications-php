<?php 
    $page = 'Home';
    include 'common/header.php';
?>

<div class="jumbotron">
    <div class="ml30">
        <h1>Welcome to Assignment #3</h1>
        <p>This is the third assignment for Ganeshbabu Thavasimuthu for CSE 5335</p>
    </div>
</div>

<div class="container-fluid ml30">
    <div class="row pages">
        <div class="col-sm-2">
            <h3><span class="glyphicon glyphicon-info-sign"></span> About US</h3>
            <p>What this is all about and other stuff</p>
            <a href="/project3_thavasimuthu/php/about.php"><button class="btn btn-default"><span class="glyphicon glyphicon-link"></span> Visit Page</button></a></a>
        </div>
        <div class="col-sm-2">
            <h3><span class="glyphicon glyphicon-th-list"></span> Artist List</h3>
            <p>Display list of artist names as links</p>
            <a href="/project3_thavasimuthu/php/Part01_ArtistsDataList.php"><button class="btn btn-default"><span class="glyphicon glyphicon-link"></span> Visit Page</button></a>
        </div>
        <div class="col-sm-2">
            <h3><span class="glyphicon glyphicon-user"></span> Single Artist</h3>
            <p>Displays information for single artist</p>
            <a href="/project3_thavasimuthu/php/Part02_SingleArtist.php?id=19"><button class="btn btn-default"><span class="glyphicon glyphicon-link"></span> Visit Page</button></a>
        </div>
        <div class="col-sm-2">
            <h3><span class="glyphicon glyphicon-picture"></span> Single Work</h3>
            <p>Displays information for single work</p>
            <a href="/project3_thavasimuthu/php/Part03_SingleWork.php?id=394"><button class="btn btn-default"><span class="glyphicon glyphicon-link"></span> Visit Page</button></a>
        </div>
        <div class="col-sm-2">
            <h3><span class="glyphicon glyphicon-search"></span> Search</h3>
            <p>Performs search on ArtWorks table</p>
            <a href="/project3_thavasimuthu/php/Part04_Search.php"><button class="btn btn-default"><span class="glyphicon glyphicon-link"></span> Visit Page</button></a>
        </div>
    </div>
</div>