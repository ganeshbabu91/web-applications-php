
<div class="container loginForm mt30">
<form action="<?=$actionUrl?>" method="post">
  <div class="form-group">
    <?php
        if(isset($fatal) && $fatal=="true"){
            echo "<p class='alert alert-danger'>You can't enter our website without signing in. If you don't have account, please create a new one by clicking Register button.</p>";
        }else if(isset($success) && $success=="true"){
            echo "<p class='alert alert-success'>Thank you for creating an account. Please login below to browse our catalog.</p>";
        }else if(isset($success) && $success=="false"){
            echo "<p class='alert alert-danger'>Invalid Credentials. Please try again.</p>";
        }else if(isset($_SERVER['HTTP_REFERER'])){
            echo "<p class='alert alert-success'>Thank you for shopping with us. We'd love to see you again! Please login below to start new shopping session or to track the previous order.</p>";
        }
    ?>
  </div>  
  <div class="form-group">
    <label for="username">Enter username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="pwd">Enter password</label>
    <input type="password" class="form-control" id="pwd" name="password" placeholder="Password">
  </div>
  <div class="form-group offset-sm-3">
    <button class="btn btn-primary mr10" type="submit">Login</button>
    <a href="<?=$signupUrl?>" class="btn btn-primary" type="submit">New users register here</a>
  </div>
</form>
</div>
</body>
</html>

