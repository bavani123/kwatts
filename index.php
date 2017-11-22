<?php
 session_start();
 $con = new mysqli("localhost","root","","mydb");
 if($con->connect_error)
 {   echo $con->connect_error;
     die("sorry database connection failed");}
?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="style.css" rel="stylesheet" type="text/css" media="all"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min_1.css" rel="stylesheet" type="text/css">
        <link href="css/tableexport.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <style>
             #frm
            {   border:solid gray 2px;
                width: 29%;
                border-radius: 7px;
                padding:30px;
                background-color: #6D78F2;
            }
            input
            {
                border:solid gray 1px;
                border-radius: 5px;
            }
            th{
                  
                    background-color: #2AAA7B;
                   
            }
            button
            {
               float: right;
                margin-top: 10px;
                background-color: #AE0399;
                color: white;
                border: none;
            }
            #c
            {
                color:white;
            }
            h4 {
                font-size: 19px;
                font-weight: 700;
            }
            #color
            {
               background-color: #386E9D; 
               color:white;
            }
            #btn
            {
                float:left;
            }
            #head
            {
                font-weight:700;
                color:white;
                font-size:22px;
            }
            #name
            {
              
            }
       </style>
       <?php    
             $n1=""; $u1="";
             $sql="SELECT * FROM kwatts WHERE id>0";
                    $result  = mysqli_query($con, $sql);
                    $result=$con->query($sql);
                    if($result->num_rows>0)
                        {
                            while($row=$result->fetch_assoc())
                             {   
                                $n1= $row['name'];
                                $u1= $row['unit'];
                             
                             }
                        }
        
        ?>               
<div class="container-fluid" id="box">
 <div class="row">
   <div class="col-md-4 col-sm-6 col-xs-6" id="frm">
       <form method="POST" class="group-form" >
            <h5  id="head">AUTOMATION CALCULATOR</h5><br>
            <lable id="c">Company Name &nbsp &nbsp : &nbsp</lable><input  type="TEXT" name="name" id="name"  style="width:50%;" value="<?php echo $n1 ?>"/><br><br>
             <lable id="c"> Per Unit Cost &nbsp &nbsp &nbsp &nbsp :  &nbsp<i class="fa fa-inr" aria-hidden="true"></i></lable>
             <input name="text" type="int" id="name" style=" width:47%;" value="<?php echo $u1 ?>"/><br><hr>
             
                      <lable id="c">Product Type &nbsp &nbsp &nbsp &nbsp : &nbsp</lable>
                            <select name="operator" style="width: 156px">
                                <option>Air Conditioner</option>
                                <option>Light</option>
                                <option>Fan</option>
                                <option>Television</option>
                                <option>Washing Machine</option>
                                <option>Others</option>
                            </select><br><br>
                            <lable id="c"> Rating /Watts (W) &nbsp:  &nbsp</lable><input type="TEXT" name="watts" id="watts"  style="width:50%; "/><br><br>
                            <lable id="c">Usage per day<br>/hours &nbsp  &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp:  &nbsp</lable><input type="TEXT" name="hours" id="hours"  style="width:50%; "/><br><br>
                            <lable id="c">Quantity  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :  &nbsp</lable><input type="TEXT" name="quantity" id="quantity"  style="width:50%;"/><br><br>
                            <button type="SUBMIT" name="submit" style="background-color:#03c04a; color:white; margin-top: 22px;">Update</button>
        </form>
        <form method="POST" action="fresh.php">
        <button id="btn" type="submit" name="btn"><a href=""></a>Reset</button>
        </form>
   </div>
<div  class="col-md-8 col-sm-6 col-xs-6">
<table border='1' id="exl">
      <tr>
           <th>List &nbsp</th>
          <th>Rating/Watts(W) &nbsp</th>
          <th>Usageperday &nbsp</th>
          <th>Quantity &nbsp</th>
          <th>Consumption <br>/day &nbsp</th>
          <th>Consumption<br>/month &nbsp</th>
          <th>Cost<br>/month &nbsp</th>
          <th>Consumption<br>/hour &nbsp</th>
          <th>Cost<br>/hour &nbsp</th>
          <th>&nbsp &nbsp &nbsp &nbsp</th>
      </tr>
        <?php
                 //$unit=$_POST['text'];
                 
        if(isset($_POST['submit'])) 
        {   
            $name=$_POST['name'];
            $watts=$_POST['watts'];
            $hours=$_POST['hours'];
            $quantity=$_POST['quantity'];
            $unit=$_POST['text'];
            $day=$watts * $hours * $quantity * 0.8 / 1000;
            $dayone=$day/$hours;
            $costone=$dayone*$unit;
            $month= $day * 30;
            $cost= $month * $unit;
            
            $sql="INSERT INTO kwatts(name,unit,watts,hours,quantity,day,month,cost,dayone,costone) VALUES('$name','$unit','$watts','$hours','$quantity','$day','$month','$cost','$dayone','$costone')";
            if($con->query($sql))
            {
               $sql="SELECT * FROM kwatts";
               $result  = mysqli_query($con, $sql);
                      $result=$con->query($sql);
                      if($result->num_rows>0)
                             {
                                 while($row=$result->fetch_assoc())
                                 {   
                                     $u=$row['unit'];
                                     $w=$row['watts'];
                                     $h=$row['hours'];
                                     $q=$row['quantity'];
                                     $d=$row['day'];
                                     $m=$row['month'];
                                     $c=$row['cost'];
                                     $do=$row['dayone'];
                                     $co=$row['costone'];
                                     $id=$row['id'];
                                     echo"
                                                 <tr style='height:30px;'>
                                                     <td><center>AC</center></td>
                                                     <td>$w</td>
                                                     <td>$h hrs</td>
                                                     <td>$q</td>
                                                     <td>$d KWh</td>
                                                     <td>$m KWh</td>
                                                     <td><i class='fa fa-inr' aria-hidden='true'></i>$c</td>
                                                     <td>$do KWh</td>
                                                     <td><i class='fa fa-inr' aria-hidden='true'></i>$co</td>    
                                                     <td><center><a href='delete.php?id=$id' id='remove1' class='fa fa-trash-o' aria-hidden='true'></a></center></td>
                                                     </tr>";
                                 }
                             }
            }
           $sql="SELECT SUM(watts),SUM(hours),SUM(quantity),SUM(day),SUM(month),SUM(cost),SUM(dayone),SUM(costone) from kwatts";
           $result  = mysqli_query($con, $sql);
                      $result=$con->query($sql);
                      if($result->num_rows>0)
                             {
                                 while($row=$result->fetch_assoc())
                                 {   
                                    $a=$row['SUM(watts)'];
	                            $b=$row['SUM(hours)'];
                                    $c=$row['SUM(quantity)'];
                                    $d=$row['SUM(day)'];
                                    $e=$row['SUM(month)'];
                                    $f=$row['SUM(cost)'];
                                    $g=$row['SUM(dayone)'];
                                    $h=$row['SUM(costone)'];
                                    
                                     echo" <tr id='color' style='height:30px;'>
                                                     <td>Total</td>
                                                     <td>$a</td>
                                                     <td>$b hrs</td>
                                                     <td>$c</td>
                                                     <td>$d KWh</td>
                                                     <td>$e KWh</td>
                                                     <td><i class='fa fa-inr' aria-hidden='true'></i>$f</td>
                                                     <td>$g KWh</td>
                                                     <td><i class='fa fa-inr' aria-hidden='true'></i>$h</td>
                                            </tr>";
                                         
                                 }
                              }
         $page = $_SERVER['PHP_SELF'];
         echo '<meta http-equiv="Refresh" content="0;' . $page . '">';   
       
        }
   else {
         $sql="SELECT * FROM kwatts";
               $result  = mysqli_query($con, $sql);
                      $result=$con->query($sql);
                      if($result->num_rows>0)
                             {
                                 while($row=$result->fetch_assoc())
                                 {   
                                     $w=$row['watts'];
                                     $h=$row['hours'];
                                     $q=$row['quantity'];
                                     $d=$row['day'];
                                     $m=$row['month'];
                                     $c=$row['cost'];
                                     $do=$row['dayone'];
                                     $co=$row['costone'];
                                     $id=$row['id'];
                                     echo"
                                                 <tr style='height:30px;'>
                                                     <td><center>AC</center></td>
                                                     <td>$w</td>
                                                     <td>$h hrs</td>
                                                     <td>$q</td>
                                                     <td>$d KWh</td>
                                                     <td>$m KWh</td>
                                                     <td><i class='fa fa-inr' aria-hidden='true'></i>$c</td>
                                                     <td>$do KWh</td>
                                                     <td><i class='fa fa-inr' aria-hidden='true'></i>$co</td>  
                                                     <td><center><a href='delete.php?id=$id' id='remove1' class='fa fa-trash-o' aria-hidden='true'></a></center></td>
                                                 </tr>";
                                  }
                             }
           $sql="SELECT SUM(watts),SUM(hours),SUM(quantity),SUM(day),SUM(month),SUM(cost),SUM(dayone),SUM(costone) from kwatts";
           $result  = mysqli_query($con, $sql);
                      $result=$con->query($sql);
                      if($result->num_rows>0)
                             {
                                 while($row=$result->fetch_assoc())
                                 {   
                                    $a=$row['SUM(watts)'];
	                            $b=$row['SUM(hours)'];
                                    $c=$row['SUM(quantity)'];
                                    $d=$row['SUM(day)'];
                                    $e=$row['SUM(month)'];
                                    $f=$row['SUM(cost)'];
                                    $g=$row['SUM(dayone)'];
                                    $h=$row['SUM(costone)'];
                                    
                                     echo" <tr id='color' style='height:30px;'>
                                                     <td>Total</td>
                                                     <td>$a</td>
                                                     <td>$b hrs</td>
                                                     <td>$c</td>
                                                     <td>$d KWh</td>
                                                     <td>$e KWh</td>
                                                     <td><i class='fa fa-inr' aria-hidden='true'></i>$f</td>
                                                     <td>$g KWh</td>
                                                     <td><i class='fa fa-inr' aria-hidden='true'></i>$h</td>
                                            </tr>";
                                         
                                 }
                              }
            
        }
        ?>
      
</table> 
</div> 
</div>
</div>
     <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min_1.js" type="text/javascript"></script>
	<script src="js/FileSaver.min.js" type="text/javascript"></script>
	<script src="js/tableexport.min.js" type="text/javascript"></script>
	
	<script>
		$('#exl').tableExport();
	</script> 
    
</body>
</html>