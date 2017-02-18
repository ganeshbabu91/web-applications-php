<div class="container-fluid">
    <div class="jumbotron">
        <div class="ml30">
            <h1>Welcome <?= $_SESSION['username'] ?>,</h1>
            <p><a href="<?=$searchUrl?>">Search</a> our latest collection of books from various categories. You may add your favorite books to <a href="<?=$basketUrl?>">shopping basket</a> and proceed to purchase.</p>
            <p>Don't forget to <a href="<?=$logoutUrl?>"><em>logout</em></a> when you leave. Have fun!</p>
        </div>
    </div>
    <div id="searchForms" class="row">
        <div class="col-sm-4 offset-sm-3">
            <form id="searchForm" action="<?=$actionUrl?>">
                <div class="form-group">
                    <input type="text" name="term" class="form-control" placeholder="Enter search term"> 
                </div>
                <div class="form-group">
                    <button type="submit" name="search" value='author' class="btn btn-primary">Search By Author</button>
                    <button type="submit" name="search" value='title' class="btn btn-primary">Search By Title</button>
                </div>
            </form>
        </div>
        <div class="col-sm-4 right">
            <a href="<?=$basketUrl?>" class="btn btn-primary">Shopping Basket</a><span class='counter'><?=$_SESSION['basket']['counter']?></span>
        </div>
    </div>
    <div class="row ml30">
        
        <?php 
        foreach($books as $book){
            echo "<div class='card col-sm-3 text-xs-center ml30'>
                    <div class='card-block' id='".$book['ISBN']."'>
                        <h4 class='card-title'>".$book['title']."</h4>
                        <p class='card-text'>ISBN : ".$book['ISBN']."</p>
                        <p class='card-text'>Currently in stock (".$book['stockcount']." available)</p>
                        <form class='addtocartForm'>
                        <input type='number' placeholder='Qty' value='1' min='1' max='".$book['stockcount']."'>
                        <input type='hidden' name='isbn' value='".$book['ISBN']."'>
                        <input type='hidden' name='basketId' value='".session_id()."'>
                        <input type='hidden' name='bookTitle' value='".$book['title']."'>
                        <input type='hidden' name='bookTitle' value='".$book['stockcount']."'>
                        <button class='ml10 btn btn-sm btn-primary' type='submit'>Add to Cart</button>
                        </form>
                    </div>
                  </div>";
        }
        ?>
    </div>
    <span style="display:none;" id="addtocartUrl"><?=$addtocartUrl?></span>
</div>