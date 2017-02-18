<div class="container registerForm mt30">
<form action="<?=$processSignup?>" method="post">
  <div class="form-group">
    <label for="username">Enter username for this account</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="pwd">Enter password</label>
    <input type="password" class="form-control" id="pwd" name="password" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="address">Enter your residential address</label>
    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
  </div>
  <div class="form-group">
    <label for="mobile">Enter your current mobile number (10 digits)</label>
    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number">
  </div>
  <div class="form-group">
    <label for="email">Enter your personal email id</label>
    <input type="email" name="email" class="form-control" id="email" placeholder="Email ID">
  </div>
  <div class="form-group">
    <button class="btn btn-primary" type="submit">Create Account</button>
  </div>
</form>
</div>
</body>
</html>