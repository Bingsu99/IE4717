<?php 
        include "./php/dbconnect.php";
        $query = 'select * from items ';
        $result = $dbcnx->query($query);
        while($row =$result->fetch_assoc()){
          echo $row["ItemDescription"];
        }
        $dbcnx->close()
      ?>