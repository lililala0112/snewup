<?php
  include 'lib/headmeta.php';
  include 'lib/fn.php';
?>

<body class="log_bg">
<div class="login-page">
  <div class="form" >
    <!-- <p class="welcome_login">Welcome <b>lililala</b></p> -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <label>
         <i class="fa fa-user" aria-hidden="true"></i>
         <input type="text" name="username" placeholder="帳號" value="<?php 
            //記我30天
            if(!empty($_COOKIE['temp_username'])){
              echo $_COOKIE['temp_username'];
            }

         ?>"/>
        
      </label>
      <label >
          <i class="fa fa-lock" aria-hidden="true"></i>
      <input type="password" name="password" placeholder="密碼"/>
      </label>
      <!-- 錯誤訊息 -->
      <?php echo validation()?>
      
      
      <button type="submit">登入</button>
      <p class="message">
      <label for="rememberMe"> 
      <?php
        if(isset($_COOKIE['temp_username'])){
           echo '<input type="checkbox" name="rememberMe" id="rememberMe" checked>記住我30天?';
        }else{
           echo '<input type="checkbox" name="rememberMe" id="rememberMe">記住我30天?';
        } 
        
      ?>
      </label>
     <a href="#">申請管理者帳號</a></p>
    </form>
  </div>
</div>
<div class="dialog animated" id="">
  <p>MSG here</p>
  <button class="alert_btn">確 認</button>
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
<script src="js/main.js"></script>
<?php


  if( !isset($_SESSION['username']) ){
 
      //未登入狀態
      //Submit送出資料
      if($_SERVER['REQUEST_METHOD']=="POST"){

          if( !empty($_POST['username']) && !empty($_POST['password'])){

            $db_username = "aaa";
            $db_password = crypt(1234);

            $post_username = test_input($_POST['username']);
            $post_password = test_input($_POST['password']);

            if( ($post_username == $db_username) && (crypt($post_password,$db_password) == $db_password)){
              //資料正確 寫入session
              $_SESSION['username'] = $post_username;//寫入session
              //記我30天
              if( isset($_POST['rememberMe'])){
                  setcookie("temp_username",$post_username, time()+3600*24*30);
              }else{
                setcookie ("temp_username", "", time() - 3600);
              };
              header("Location:index.php");
            }else{
              //資料不符
              ?>
                <script>
                    //登入錯誤訊息
                    var msg = "帳號密碼錯誤請重新輸入";
                    dialog(msg);
                </script>
              <?php
            }
          }
        }
  }else{
      //已登入狀態
    
      header("Location:index.php");
  } 

 ?>