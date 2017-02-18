<?php 
    $page = 'Single Work';
    $others = true;
    require_once 'common/header.php';
    require_once 'common/artworks-model.php';
    $artWorksModel = new ArtWorksModel($_GET['id']);
    $artwork = $artWorksModel->getArtwork();
    if(empty($artwork)){
        header('Location: /project3_thavasimuthu/php/common/error.php?errmsg=There is no artwork available with this id. Please enter valid artwork id');
        exit;
    }

    $genres = $artWorksModel->getGenres();
    $subjects = $artWorksModel->getSubjects();
    $orders = $artWorksModel->getOrders();
?>
<div class="container-fluid ml30">
    <div class="model-template">
        <?php include 'common/model-template.php'?>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2 id="artwork-title"><?php echo $artwork['Title'] ?></h2><p>by <?php echo "<a href='/project3_thavasimuthu/php/Part02_SingleArtist.php?id=".$artwork['ArtistID']."'>" .$artwork['FirstName']." ".$artwork['LastName']."</a>"?></p><hr>
        </div>
    </div>
    <div class="row">
        <div id="artwork-image" class="col-sm-3">
                <?php echo "<img data-toggle='modal' data-target='.img-modal-lg' src='/project3_thavasimuthu/images/art/works/medium/".$artwork['ImageFileName'].".jpg' class='img-responsive' alt='Art Work Image'>"; ?>
                <figcaption class="mt10">Click the art work image to enlarge</figcaption>
        </div>
        <div id="artwork-desc" class="col-sm-4 mr30">
            <p class="summary"><?php echo $artwork['Description'] ?></p>
            <p class="price mt10 color-green">Price : $<?php echo number_format($artwork['Cost'],2); ?></p>
            <div id="order-buttons" class="btn-group m130">
                <button class="btn btn-default"><span class="glyphicon glyphicon-gift text-primary"></span> <span class="text-primary"> Add to Wishlist</span></button></a></a>
                <button class="btn btn-default"><span class="glyphicon glyphicon-shopping-cart text-primary"></span> <span class="text-primary"> Add to Shopping Cart</span></button></a></a>
            </div>
            <div id="product-details" class="mt30">
                <div class="panel panel-info">
                    <div class="panel-heading">Product Details</div>
                    <div class="panel-body">
                        <table id="product-details" class="table">
                            <tr>
                                <td> Date : </td> <td><?php echo $artwork['Medium']?></td>
                            </tr>
                            <tr>
                                <td> Medium : </td> <td><?php echo $artwork['Medium']?></td>
                            </tr>
                            <tr>
                                <td> Dimensions : </td> <td><?php echo $artwork['Width']?> X <?php echo $artwork['Height']?></td>
                            </tr>
                            <tr>
                                <td> Home : </td> <td><?php echo $artwork['OriginalHome']?></td>
                            </tr>
                            <tr>
                                <td> Genres : </td> 
                                <td><?php foreach($genres as $genre){
                                    echo "<a href='#'>".$genre['GenreName']."</a><br>";
                                }?></td>
                            </tr>
                            <tr>
                                <td> Subjects : </td> 
                                <td><?php foreach($subjects as $subject){
                                    echo "<a href='#'>".$subject['SubjectName']."</a><br>";
                                }?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="artwork-ordertable" class="col-sm-2">
            <div class="panel panel-info">
                <div class="panel-heading">Sales</div>
                <div class="panel-body">
                    <table class="sales table">
                        <?php foreach($orders as $order){
                            echo "<tr><td><a href='#'>".$order['DateCreated']."</a></td></tr>";
                        }?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>