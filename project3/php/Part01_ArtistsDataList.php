<?php 
    $page = 'Artists';
    $others = true;
    require_once 'common/header.php';
    require_once 'common/artists-model.php';
    $artistsModel = new ArtistsModel;
    $artists = $artistsModel->getArtists();
?>
<div class="ml30">
    <h2>Artists Data List (Part 01)</h2><hr>
    <div id="artistsGroup" class="">
        <?php 
            foreach($artists as $artist){
                echo "<a href='./Part02_SingleArtist.php?id=".$artist['ArtistID']."'>".$artist['FirstName']." ".$artist['LastName']. " ( ".$artist['YearOfBirth']." - ".$artist['YearOfDeath']." ) </a><br>";
            }
        ?>
    </div>
</div>