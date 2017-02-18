<!-- 
    Backend Logic :
        Join Artist and Artworks tables to get both artist information and list his works as thumbnails as shown in the snapshot
    Known Issues :
        There is no Albums table in the given sql. 
        ImageFileName doesn't match with the ones in the travel-images folder.
    Solution/Assumption :
        So for now, thumbnail images are hard-coded. 
        But the artwork title and number of artworks dynamically changes based on the artist id from query string
    Example :
        Vincent Van Gogh has 12 artworks in total. 
        El Greco has only two artworks.
-->
<?php 
    $page = 'Single Artist';
    $others = true;
    require_once 'common/header.php';
    require_once 'common/artists-model.php';
    $artistsModel = new ArtistsModel;
    $artist_works = $artistsModel->getArtistAndWorks($_GET['id']);
    if(empty($artist_works)){
        header('Location: /project3_thavasimuthu/php/common/error.php?errmsg=There is no artist available with this id. Please enter valid artist id');
        exit;
    }
?>
<div class="container-fluid ml30">
    <div class="row">
        <div class="col-sm-12">
            <h2 id="artist-title"><?php echo $artist_works[0]['FirstName']." ".$artist_works[0]['LastName'] ?></h2><hr>
        </div>
    </div>
    <div class="row">
        <div id="artist-image" class="col-sm-3">
            <?php
                echo "<img src='/project3_thavasimuthu/images/art/artists/medium/".$artist_works[0]['ArtistID'].".jpg' class='img-responsive' alt='Art Work Image'>";
            ?>
        </div>
        <div id="artist-desc" class="col-sm-4 mr30">
            <p class="summary"><?php echo $artist_works[0]['Details'] ?></p>
            <div id="order-buttons" class="m130">
                <button class="btn btn-default mr30"><span class="glyphicon glyphicon-heart text-primary"></span> <span class="text-primary"> Add to Favorites List</span></button></a></a>
            </div>
            <div id="artist-details" class="mt30">
                <div class="panel panel-info">
                    <div class="panel-heading">Artist Details</div>
                    <div class="panel-body">
                        <table id="artist-details" class="table">
                            <tr>
                                <td> Date : </td> <td><?php echo $artist_works[0]['YearOfBirth']." - ".$artist_works[0]['YearOfDeath'] ?></td>
                            </tr>
                            <tr>
                                <td> Nationality : </td> <td><?php echo $artist_works[0]['Nationality']?></td>
                            </tr>
                            <tr>
                                <td> More Info : </td> <td><?php echo "<a href='".$artist_works[0]['ArtistLink']."'>".$artist_works[0]['ArtistLink']."</a>"?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h1>Art by <?php echo $artist_works[0]['FirstName']." ".$artist_works[0]['LastName'] ?></h1>
        </div>
        <?php foreach($artist_works as $artist_work){
           echo "<div class='col-sm-3 thumbnail'>
                <a href='/project3_thavasimuthu/php/Part03_SingleWork.php?id=".$artist_work['ArtWorkID']."'><figure>
                    <img class='img-thumbnail' src='/project3_thavasimuthu/images/art/works/square-medium/".$artist_work['ImageFileName'].".jpg'/>
                    <figcaption class='mt10'>".$artist_work['Title']."</figcaption>
                </figure></a>
                <div class='buttons mt10'>
                    <a href='/project3_thavasimuthu/php/Part03_SingleWork.php?id=".$artist_work['ArtWorkID']."'><button type='button' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-info-sign'></span> View</button></a>
                    <button type='button' class='btn btn-xs btn-success'><span class='glyphicon glyphicon-gift'></span> Wish</button>
                    <button type='button' class='btn btn-xs btn-info'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</button>
                </div> 
            </div>";
        }?>
    </div>
</div>