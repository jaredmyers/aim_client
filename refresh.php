<?php
	include_once 'includes/dbh.inc.php';

          $sql = "SELECT name, message FROM chat;";
          $result = mysqli_query($conn, $sql);

        //display resultz in table
        print "<table>";

        //grabbing num of rows in rezult
        $num_rows = mysqli_num_rows($result);

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
               
	       if ($index == 0){
		
			//Changes name colors, no time to add feature -- hardcoded for demo
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



