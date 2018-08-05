<?php include('../inc/R.php');?>
<!DOCTYPE html>
<html dir="rtl">
    <head>
        <title>اهداء يوتيوب</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />  
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    </head>
    <body>
       <div class="container">
       
        </header>
         <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <p class="pull-left"> <?php include("../inc/menu.php"); ?></p>
<p><a href="create.php" class="btn btn-danger btn-xs">اضافة خبر</a> </p>
                      
                    </div>
                    <?php
                    // Include config file
                    require_once '../config.php';
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM employees ORDER BY id DESC";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            
                                while($row = mysqli_fetch_array($result)){
                                    

                                                
 echo "<p>";
                                            echo "<a href='/". $s .".php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'>" . $row['name'] . "</a>";
echo "<br>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip' class='btn btn-primary btn-xs'>تعديل</span></a>";
                                            echo "/<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip' class='btn btn-danger btn-xs'>حذف</a>";
                                        echo "</p>";
echo "<hr>";
                                    
                                }
                           
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>لا يوجد اهداء حاليآ اضف اهدائك الان</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>

              <?php include("../inc/footer.php"); ?>