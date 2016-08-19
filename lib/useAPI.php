<?php 
    header("Content-Type:text/html; charset=utf-8");
    include("connMysql.php");

    /*
    *參照教學:https://gist.github.com/jonsuh/3739844
    */
    if (is_ajax()) {
      if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
        $action = $_POST["action"];
        switch($action) { //Switch case for value of action
          case "inqueryForm": insertContactDB(); break;
        }
      }
    }
    //Function to check if the request is an AJAX request
    function is_ajax() {
      return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
    function insertContactDB(){
            
        //新增一筆至資料庫
            global $mysqli;
            $sql_query = "SELECT * FROM `contact`";
            $db_result = $mysqli->query($sql_query);
            if(!$db_result) die("資料表連結失敗");     
           
            $name = $mysqli->real_escape_string($_POST['name']);
            $company = $mysqli->real_escape_string($_POST['company']);
            $phone = $mysqli->real_escape_string($_POST['phone']);
            $mail = $mysqli->real_escape_string($_POST['mail']);
            $comment = $mysqli->real_escape_string($_POST['comment']);
            $sql = "INSERT INTO `contact`(`ID`, `Name`, `Company`, `Phone`, `Mail`, `Date`, `Comment`) VALUES (NULL,'{$name}','{$company}','{$phone}','{$mail}',NOW(),'{$comment}')";
            $mysqli->query($sql) or die($mysqli->connect_error);
           $insertId = $mysqli->insert_id;
           $getResult = $_POST;
           $return = array(
                  'status' => 1,
                  'message'=> '表單已送出<br/>感謝您的填寫!',
                  'resdata'=> $getResult
           );
           echo json_encode($return);
           


 

   }





 ?>
