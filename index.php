<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="two.css">
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <p class="tip"></p>
<div class="cont">
  <div class="form sign-in">
    <h2>Welcome</h2>
    <br/>
    <h5 class="error" style="color:red; text-align:center;">
      <?php 
        if(isset($_GET['error'])){
            echo $_GET['error'];
        }
      ?>
    </h5>
    <form action="login.inc.php" method="POST">
        <label>
            <!-- <span>E-mail</span> -->
            <input type="email" placeholder="E-mail" name="mail"/>
        </label><br><br>
        <label>
            <!-- <span>Password</span> -->
            <input type="password" placeholder="Password" name="pwd" />
        </label>

        <!-- <p class="forgot-pass">Forgot password?</p> -->
        <input type="hidden" name="login-submit" value="true" />
        <button type="submit" class="submit">Login</button>
    </form>
    <!-- <button type="button" class="fb-btn">Connect with <span>facebook</span></button> -->
  </div>
  <div class="sub-cont">
    <div class="img">
      <div class="img__text m--up">
        <img class="logo1" src="img/welcome-right.png" alt="">
        <h5>New Account?</h5>
        <br>
      </div>
      <div class="img__text m--in">
        <img class="logo" src="img/welcome-left.png" alt="">
        <h2>Skippo!</h2>
        <p>A Todo app you can trust for life</p>
      </div>
      <div class="img__btn">
        <span class="m--up">Sign Up</span>
        <span class="m--in">Login</span>
      </div>
    </div>
    <div class="form sign-up">
        <h2>Sign Up</h2>
        <?php
            if(isset($_GET['error'])){
                echo $_GET['error'];
            }
            elseif(isset($_GET['signup'])){
                echo $_GET['signup'];
            }

        ?>
        <form action="signup.inc.php" method="POST">
            <label>
                <!-- <span>Fullname</span> -->
                <input type="text" placeholder="Fullname" name="fullname"/>
            </label><br>
            <label>
                <!-- <span>Email</span> -->
                <input type="email" placeholder="E-mail" name="mail" />
            </label><br>
            <label>
                <!-- <span>Password</span> -->
                <input type="password" placeholder="Password" name="pwd" />
            </label><br>
            <label>
                <!-- <span> Repeat Password</span> -->
                <input type="password" placeholder="Repeat Password" name="pwd-repeat"/>
            </label><br>
            <button type="submit" class="submit" name="signup-submit">Sign Up</button>
        </form>
        <!-- <button type="button" class="fb-btn">Join with <span>facebook</span></button> -->
    </div>
  </div>
</div>

<!-- <a href="https://dribbble.com/shots/3306190-Login-Registration-form" target="_blank" class="icon-link">
  <img src="http://icons.iconarchive.com/icons/uiconstock/socialmedia/256/Dribbble-icon.png">
</a>
<a href="https://twitter.com/NikolayTalanov" target="_blank" class="icon-link icon-link--twitter">
  <img src="https://cdn1.iconfinder.com/data/icons/logotypes/32/twitter-128.png">
</a> -->
<script>
  document.querySelector('.img__btn').addEventListener('click', function() {
    document.querySelector('.cont').classList.toggle('s--signup');
  });

  document.querySelector(".submit").addEventListener('click', function(){
  swal("Welcome", "Login Successful!", "success");
});
  
  // document.querySelector('.submit').addEventListener('click', function() {
  // $(document).ready(function() {
  //   $('.submit').click(function(){
  //       swal({
  //         title: "Welcome!",
  //         text: "Login Successful!",
  //         icon: "success",
  //       });
  //     });

</script>
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    </body>
</html>

