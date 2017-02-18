<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $page; ?></title>
        <link rel="stylesheet" href="/project3_thavasimuthu/css/bootstrap.min.css">
        <link rel="stylesheet" href="/project3_thavasimuthu/css/main.css">
        <script src="/project3_thavasimuthu/js/lib/jquery-3.1.1.min.js"></script>
        <script src="/project3_thavasimuthu/js/lib/bootstrap.min.js"></script>
        <script src="/project3_thavasimuthu/js/main.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Navigation Header -->
                <div class="navbar-header mr30">
                    <!-- Menu button for Mobile -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#project3_thavasimuthuNav" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- App logo or title -->
                    <a class="navbar-brand" href="/project3_thavasimuthu/php/default.php">Assignment 3</a>
                </div>
                <!-- Navigation Links -->
                <div class="collapse navbar-collapse" id="project3_thavasimuthuNav">
                    <ul class="nav navbar-nav">
                        <li class="<?php if($page == 'Home') echo 'active'?>"><a href="/project3_thavasimuthu/php/default.php">Home</a></li>
                        <li class="<?php if($page == 'About Us') echo 'active'?>"><a href="/project3_thavasimuthu/php/about.php">About Us</a></li>
                        <li class="<?php if($others) echo 'active'?>" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="<?php if($page == 'Artists') echo 'active'?>"><a href="/project3_thavasimuthu/php/Part01_ArtistsDataList.php">Artists Data List (Part 1)</a></li>
                                <li class="<?php if($page == 'Single Artist') echo 'active'?>"><a href="/project3_thavasimuthu/php/Part02_SingleArtist.php?id=19">Single Artist (Part 2)</a></li>
                                <li class="<?php if($page == 'Single Work') echo 'active'?>"><a href="/project3_thavasimuthu/php/Part03_SingleWork.php?id=394">Single Work (Part 3)</a></li>
                                <li class="<?php if($page == 'Search') echo 'active'?>"><a href="/project3_thavasimuthu/php/Part04_Search.php">Search (Part 4)</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-right" action="Part04_Search.php">
                        <span class="gray mr10">Ganeshbabu Thavasimuthu (1001452475)</span>
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Search Paintings">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </body>
</html>