<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$con = new mysqli("localhost","root","","mydb");
 
 if($con->connect_error)
 {
     echo $con->connect_error;
     die("sorry database connection failed");
     
 }
 
  $sql="DELETE FROM kwatts WHERE id>0";
        if($con->query($sql))
        {
           
           
        }
       else 
       {
         echo"error";  
       }
 ?>



<script type="text/javascript">
    window.location="index.php";
    </script>
 



