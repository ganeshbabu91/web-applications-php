<?php
    $page = 'Error Page';
    require_once 'header.php';
?>
<div class="container">
    <div class="error">
        <p class="alert alert-warning"><?php echo $_GET['errmsg']?></p>
    </div>
</div>