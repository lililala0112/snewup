<?php
	include 'lib/headmeta.php';
	include 'lib/fn.php';
?>

<body>
    <div class="logoSvg" id="logoSvg">
       <div style=" width:30%; margin:0 auto">
    	<object><embed src="logo.svg"></object>
    	</div>
    </div>
    <!-- header -->
    <?php
	include 'lib/header.php';
	?>

 
聯絡方式
</body>
</html>
<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
<script src="js/main.js"></script>
<script src="lib/cookie.js"></script>
<script>
(function (){
	//當今天第一次進入才跑動畫
	var username = getCookie("username");

	if(getCookie('visted') !== ''){
		var el = document.querySelector('.logoSvg');
		
		 // setTimeout(el.classList.add('fadeOut','animated'),10000); 
		 setTimeout(function(){ 
		 el.classList.add('fadeOut','animated');
		 	el.style.display = "none";
		 }, 2000);
	
	}else{
			//cookie empty
		    //cookie write
		        setCookie('visted', 'visted', 365);
	};




})();
</script>