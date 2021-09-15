<?php
	include_once 'freshchat.php';
?>
<!DOCTYPE HTML>
<html lang="en">

  <head>
	   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
     <link rel="stylesheet" href="fifthstyle.css" type="text/css" />
     <script type = "text/javascript" src = "formjs.js"> </script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


	    <title>Flowers Baby!</title>
  </head>


    <body>
      <article>

        <div class="chatOuterBox">

	<div class="loginOuter">
	<table style="margin:auto;">
		<th>Name:<input type"text" id="login"></th>
		<th>Pw:<input type="password" id="pw"></th>
	</table>


	</div>

	<div class="leftChatNames">
	<table style="margin:auto;">
		<th><h3>Chat Users</h3></th>
	</table>
	
        <?php	
          $sql = "SELECT name FROM chatlogin;";
          $result = mysqli_query($conn, $sql);
        //  $resultCheck = mysqli_num_rows($result);

        //display resultz in table
        print "<table align = 'center'>";
        print "<tr align = 'center'>";

        //grabbing num of rows in rezult
        $num_rows = mysqli_num_rows($result);



        //if rowz, put in html
        if ($num_rows > 0){
          $row = mysqli_fetch_assoc($result);
          $num_fields = mysqli_num_fields($result);

        //  print "$row"
        //  print "$num_fields"

        //produce column labels
      //  $keys = array_keys($row);
       // for($index = 0; $index < $num_fields; $index++)
        //    print "<th>" . $keys[$index] . "</th>";

        print "</tr>";

        //output values of the fields in the rows
        for ($row_num = 0; $row_num < $num_rows; $row_num++) {
              print "<tr>";
              $values = array_values($row);
              for($index = 0; $index < $num_fields; $index++){
              //  $value = htmlspecialchars($values[$index]);
                print "<td>" . $values[$index] . "</td>";

              }
              print "</tr>";
              $row = mysqli_fetch_assoc($result);
            }
          }
          else {
              print "There were no such rows in table <br />";
          }
            print "</table>";


     ?>
		
<!---	<input type="text" id="receipt">
-->
	</div>

	<div class="rightTextBox">

         <div id="ajaxrequest">
	 </div>

     <script>
     $(document).ready(function(){
     $("#loaddata").click(function(){
     txtmessage=$("#txtinput").val();
     name=$("#login").val();
     pass=$("#pw").val();
     receipt=$("#receipt").val();
     $.ajax({url:"post_test.php",data:{sentMessage:txtmessage,loginName:name,password:pass,recipient:receipt},success: function(ajaxresult){
     $("#ajaxrequest").html(ajaxresult);
     }});
     });
     });

    // alert("HELLO");

	var timer = null;





	function myTimer(timer){

		if(timer != null){
			clearInterval(timer);
			timer = null;
		}
    		timer = setInterval(function(){
    		$("#ajaxrequest").load("refresh.php");
    		}, 1000);
//		alert("timer called");
//		alert(timer);
		return timer;
	}

	function cancelTimer(timer){
//		alert("cancel called");
//		alert(timer);
		clearInterval(timer);
		timer = null;

		return timer;
	}

     
     </script>
	</div>

	<div class="typeBox">
	
	<table>
	<tr>
		<th><input type="text" id="txtinput" size="65" maxlength="100"><br /></th>
       <!--  Enter Location: <input type="text" id="txtlocation"><br /> -->
        <th> <button id="loaddata" style="display:none;">Send</button></th>
	</table>
	
	</div>





        </div>

	<script>

	var input = document.getElementById("txtinput");

	input.addEventListener("keyup", function(event){
		
		if(event.keyCode === 13) {
			event.preventDefault();
			document.getElementById("loaddata").click();
			document.getElementById("txtinput").value = '';
		}

	});
	</script>




    </article>
    </body>






</html>
