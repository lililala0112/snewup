<?php 

    
    header("Content-Type:text/html; charset=utf-8");
    include("connMysql.php");
    include("../ajax-index.php");
    /*
    *參照教學:https://gist.github.com/jonsuh/3739844
    */
    if (is_ajax()) {
      if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
        $action = $_POST["action"];
        switch($action) { //Switch case for value of action
          case "inqueryForm": 
             insertContactDB();
             break;
          case "inquerySheet": 
             inquerySheet();
             break;
          case "checkAccout": 
             checkUserAccout(); 
             break;
        }
      }
    }
    //Function to check if the request is an AJAX request
    function is_ajax() {
      return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
    function insertContactDB(){
            
         $ajaxUrl = new useAPI;
         $name = $ajaxUrl->mysqli->real_escape_string($_POST['name']);
         $company = $ajaxUrl->mysqli->real_escape_string($_POST['company']);
         $phone = $ajaxUrl->mysqli->real_escape_string($_POST['phone']);
         $mail = $ajaxUrl->mysqli->real_escape_string($_POST['mail']);
         $comment = $ajaxUrl->mysqli->real_escape_string($_POST['comment']);
         $sql = "INSERT INTO 
                  `contact`(
                  `ID`, `Name`, `Company`, `Phone`, `Mail`, `Date`, `Comment`
                  ) 
                 VALUES (
                  NULL,'{$name}','{$company}','{$phone}','{$mail}',NOW(),'{$comment}'
                 )";
         $ajaxUrl->setData($sql);//寫入
         $ajaxUrl->insertData();//回傳
   }


   function inquerySheet(){
         $ajaxUrl = new useAPI;
         $sql = "SELECT * FROM `contact`";
         $ajaxUrl->setData($sql);//寫入
         $ajaxUrl->showData();//回傳
   }


   function checkUserAccout(){
       
            //未登入狀態
            //Submit送出資料

          if( !empty($_POST['username']) && !empty($_POST['password'])){
          $ajaxUrl = new useAPI;

            $post_username =  $ajaxUrl->mysqli->real_escape_string($_POST['username']);
            $post_password =  $ajaxUrl->mysqli->real_escape_string($_POST['password']);
            //查詢資料庫是否存在
   
            $sql = "SELECT * FROM `admin` where `account` = '{$post_username}'";
            $ajaxUrl->setData($sql);//寫入
            $ajaxUrl->checkData();//回傳
          }

   }





 ?>
