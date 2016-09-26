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
         echo 'insertCountactDB';   
         $ajaxUrl = new useAPI;
         $name = real_escape_string($_POST['name']);
         $company = real_escape_string($_POST['company']);
         $phone = real_escape_string($_POST['phone']);
         $mail = real_escape_string($_POST['mail']);
         $comment = real_escape_string($_POST['comment']);
         $sql = "INSERT INTO `contact`(`ID`, `Name`, `Company`, `Phone`, `Mail`, `Date`, `Comment`) VALUES (NULL,'{$name}','{$company}','{$phone}','{$mail}',NOW(),'{$comment}')";
         $resdata = $_POST;
         $resdata['msg']="感謝您的填寫<br/>表單已成功送出!!";
         $ajaxUrl->setData($sql);//寫入
         $ajaxUrl->insertData();//回傳
   }


   function inquerySheet(){
         $ajaxUrl = new useAPI;
         $sql = "SELECT * FROM `contac`";
         $ajaxUrl->setData($sql);//寫入
         $ajaxUrl->showData();//回傳
   }


   function checkUserAccout(){
    
        //查詢資料庫是否存在
         if( !empty($_POST['username']) && !empty($_POST['password'])){

           $post_username = $_POST['username'];
           $post_password = crypt ($_POST['password']);
           echo $post_username.$post_password;

           //查詢資料庫是否存在
               global $mysqli;
               $sqli= "SELECT * FROM `admin` where account = '{$post_username}'";
               $db_result = $mysqli->query($sqli);
               if(!$db_result) die("資料表連結失敗");     
               //是否存在 1存在0不存在
               $checkAccout = $db_result->num_rows;
               //讀出此筆資料
               echo $checkAccout;

               if( $checkAccout == 0){
                   $sql_insert="INSERT INTO `admin`(`ID`, `account`, `password`) VALUES (NULL,'{$post_username}','{$post_password}')";

                   $result['status']=1;
                   $result['mag']="已經註冊成功";
                   $result['lanch']="index.php";

                 }else{                 
                   $result['status']=1;
                   $result['mag']="帳號已存在，請重新輸入";
               }
               echo json_encode($result);

           }
   }





 ?>
