	<header>
	    <div class="nav_header">
		    <h1 class="logo"></h1>
		    <nav>
		    	<ul class="nav_bar">
		    	  <li class="active"><a href="index.php">首頁</a></li>
		    	  <li><a href="#">螺旋訂做</a></li>
		    	  <li><a href="#">商品總覽</a></li>
		    	  <li><a href="#">採購詢價</a></li>
		    	  <li><a href="#">聯絡方式</a></li>
		    	</ul>
				<?php
					if(!isset($_SESSION['username'])){
						echo '<span class="loginbar"><a href="login.php"><i class="fa fa-user" aria-hidden="true"></i>登入</a></span>';
					}else{
						echo '
						<div class="logbar_wrap">
						<span class="loginbar"><a href="#">
								<i class="fa fa-user" aria-hidden="true"></i>'.$_SESSION['username'].'<i class="fa fa-chevron-down" aria-hidden="true"></i></a>		
							    <ul class="log_dropdown">
							  	  <li><a href="#">管理版面</a></li>
							  	  <li><a href="?logout=true">登出</a></li>
							    </ul>
				    		  </span>

				    		  ';
					}
		    	
					//登出
					if( isset($_GET['logout']) && ($_GET['logout'] == true) ){
						unset($_SESSION['username']);//清除session
						header("Refresh: 1; URL = login.php");
					}
		    	
		    	?>


		    </nav>	
	    </div>
	</header>