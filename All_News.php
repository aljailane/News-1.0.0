<?php include("inc/head.php"); ?>
    </head>
    <body>
       <header>
            <div class="container">
       
        </header>
         <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <p class="pull-left"> <?php include("inc/menu.php"); ?></p>
                      
                    </div>
                    <?php
                    // Include config file
                    require_once 'config.php';
                   define('TIMEZONE', 'Asia/Aden');
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM employees ORDER BY id DESC limit 0,100";
                  

                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                       
                                        echo "<p style='color:MediumSeaGreen;
    width: 100%;
    border: 1px solid #4CAF50;'>";
                                            echo "<a href='". $s .".php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'> " . $row['name'] . "</a> (". $row['date'] .")";
                                        echo "</p>";
                                    echo "</tr>";
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
        

             
             <?php include("inc/footer.php"); ?>