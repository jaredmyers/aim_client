<?php
	include_once 'includes/dbh.inc.php';


	$post_message = mysqli_real_escape_string($conn, $_REQUEST["sentMessage"]);
	$post_name = mysqli_real_escape_string($conn, $_REQUEST["loginName"]);
	$post_pass = mysqli_real_escape_string($conn, $_REQUEST["password"]);
	$post_recipient = mysqli_real_escape_string($conn, $_REQUEST["recipient"]);

	$sqlCheck = "SELECT loginid, name, passwd FROM chatlogin WHERE name = '$post_name';";
	$result = mysqli_query($conn, $sqlCheck);
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);
		$values = array_values($row);
		$logid = $values[0];
		$name = $values[1];
		$passwd = $values[2];

		if($passwd == $post_pass){
		
			echo '<script>timer = myTimer(timer);</script>';

			$sqlTextSent = "INSERT INTO chat (loginid, name, message) VALUES ('$logid','$name', '$post_message');";

			if(mysqli_query($conn, $sqlTextSent)){
      		
#				echo '<script> alert("Success")</script>';
			}else{
				echo '<script>alert("Error")</script>';
				echo mysqli_error($conn);
			}


          $sql = "SELECT name, message FROM chat;";
          $result = mysqli_query($conn, $sql);
        //  $resultCheck = mysqli_num_rows($result);

        //display resultz in table
        print "<table>";
       # print "<tr align = 'center'>";

        //grabbing num of rows in rezult
        $num_rows = mysqli_num_rows($result);
#	echo $num_rows;


        //if rowz, put in html
        if ($num_rows > 0){
		if ($num_rows > 15){
			$sql = "DELETE FROM chat ORDER BY textid ASC LIMIT 1";
			$result = mysqli_query($conn, $sql);
          		$sql = "SELECT name, message FROM chat;";
          		$result = mysqli_query($conn, $sql);
		}
		

          $row = mysqli_fetch_assoc($result);
          $num_fields = mysqli_num_fields($result);
	
	
        //output values of the fields in the rows
        for ($row_num = 0; $row_num < $num_rows; $row_num++) {
              print "<tr>";
              $values = array_values($row);
	      


	      print "<td>";
              for($index = 0; $index < $num_fields; $index++){
              //  $value = htmlspecialchars($values[$index]);
               
	       if ($index == 0 && $values[$index] != ''){

	       		//changes colors of names, no time to add this feature - hardcoded for demo.
	       		if($values[$index] == 'Deek'){

				print '<strong style="color:blue;">' . $values[$index] .":". "</strong>";
			}else{
				print '<strong style="color:red;">' . $values[$index] .":". "</strong>";
			}


	       }else{
	       print " " . $values[$index];
		}
             
	     }
	      print "</td>";
              print "</tr>";
              $row = mysqli_fetch_assoc($result);
            }
          }
          else {
              print "Waiting... <br />";
          }
            print "</table>";


		}else{

			echo "Password Error.";
			echo '<script>timer = cancelTimer(timer);</script>';
		}
	}else{
		echo "Name Error.";
			echo '<script>timer = cancelTimer(timer);</script>';
	}

?>
