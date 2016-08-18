<?php
	include 'headmeta.php';
	include 'fn.php';
?>

<body>
    <div class="logoSvg" id="logoSvg">
       <div style=" width:30%; margin:0 auto">
    	<object><embed src="logo.svg"></object>
    	</div>
    </div>
    <!-- header -->
    <?php include 'header.php';?>
    <!-- contact -->

    <section class="contact">
    	<h2 class="heading-1 title">填寫需求/詢價表單</h2>
    	<div class="heading-2 sub_title">
    	<div class="paragraph text">
    		如有任何詢價或規格詢問 歡迎填寫下列表單 我們會立即與您洽談
    		或直接<a href="#">聯絡我們</a>
    	</div>
    	</div>
    	<form action="ajax-index.php" method="post" class="form form_inline" id="submitBtn">
    	  <p><span>聯絡人</span><input type="text" name="name" placeholder="必填"></p>
    	  <p><span>公司名稱</span><input type="text" name="company"></p>
    	  <p><span>聯絡手機</span><input type="text" name="phone" placeholder="必填"></p>
    	  <p><span>聯絡信箱</span><input type="text" name="mail" ></p>
    	  <p><span>驗證碼</span><input type="text" ></p>
    	  <p><span>需求說明</span></p>
    	  <textarea rows="8" cols="0"  name="comment" placeholder="必填 請簡述訂製需求"></textarea>
        <?php echo validation(); ?>
    		<button class="button" type="submit" id="submitBtn">送出表單</button>
    		
    	</form>
    </section>

    <form id="target" action="destination.html">
  <input type="text" value="Hello there">
  <input type="submit" value="Go">
</form>
<div id="other">
  Trigger the handler
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
<script src="js/main.js"></script>
<script src="js/lib/cookie.js"></script>
<script>
(function (){
	//當今天第一次進入才跑動畫
	var username = getCookie("username");
	var el = document.querySelector('.logoSvg');
    if(getCookie('visted') == ''){
        el.style.display = "block";
		 setTimeout(function(){ 
		    el.style.display = "none";
		 }, 2000);
	     setCookie('visted', 'visted', 365);
	};

})();

  $("#submitBtn").submit(function(event){
    // event.preventDefault();
    alert('sumbit');
    var data = {
      "action": "inqueryForm"
    };
    data = $(this).serialize() + "&" + $.param(data);
    console.log(data);
    $.ajax({
      xhr: function()
        {
          var xhr = new window.XMLHttpRequest();
          //Upload progress
          xhr.upload.addEventListener("progress", function(evt){
                loading(evt);
          }, false);
          //Download progress
          xhr.addEventListener("progress", function(evt){
                loading(evt);
          }, false);
          return xhr;
      },
      type: "POST",
      dataType: "json",
      url: "ajax-index.php", //Relative or absolute path to ajax-index.php file
      data: data,
      success: function(data) {
        // json.parse(data);
        //登入錯誤訊息
        console.log(data);
        if(data.status==1){
            var msg = data.message;
            dialog(msg);
        }

      }
    });
    return false;
  });

</script>

