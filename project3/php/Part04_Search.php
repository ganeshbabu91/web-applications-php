<?php 
    $page = 'Search';
    $others = true;
    require_once 'common/header.php';
    require_once 'common/search-model.php';
    $searchModel = new searchModel();
    $searchResults = array();
    $title = "";
    $description = "";
    if(isset($_GET['title']))
        $title = $_GET['title'];
    if(isset($_GET['description']))
        $description = $_GET['description'];
    if($title != "")
        $searchResults = $searchModel->search($_GET['title'], 'title');
    else if($description != "")
        $searchResults = $searchModel->search($_GET['description'], 'desc');
    else
        $searchResults = $searchModel->search('','all');
?>
<div class="container-fluid">
    <h2 class="ml10">Search Results</h2><hr>
    <div id="searchForm" class="row">
        <div class="col-md-12">
        <form action="Part04_Search.php">
            <div class="form-group">
                <input type="radio" data-target='.title-text' class="radio-title" name="radio-group"> Filter By Title : </br>
                <input type="text" name="title" class="form-control title-text" placeholder="Enter Title">
                <input type="radio" data-target='.desc-text' name="radio-group" class="radio-desc"> Filter By Description : </br>
                <input type="text" name="description" class="form-control desc-text" placeholder="Enter Description">
                <input type="radio" name="radio-group" class="radio-all"> No Filter (Show all art works) :  </br>          
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        </div>
    </div>
    <div id="searchResults" class="ml20">
        <?php foreach($searchResults as $artwork){
            echo "<div class='result row mt30'>
                <div class='col-md-1'>
                    <img class='img-responsive' src='/project3_thavasimuthu/images/art/works/square-medium/".$artwork['ImageFileName'].".jpg'/>
                </div>
                <div class='col-md-10'>
                    <h3><a href='/project3_thavasimuthu/php/Part03_SingleWork.php?id=".$artwork['ArtWorkID']."'>".$artwork['Title']."</a></h3>
                    <p>".$artwork['Description']."</p>
                </div></div>"; 
        }?>
    </div>
</div>