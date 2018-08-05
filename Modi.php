<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once 'config.php';
    
    // Prepare a select statement
    $sql = "SELECT * FROM employees WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["date"];
               
             // Potential for mistakes
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $row["name"]; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="style/style.css" type="text/css" />
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  
  <script type="text/javascript">
function printSelection(node){
  var content=node.innerHTML
  var pwin=window.open('','print_content','width=777,height=600');
  pwin.document.open();
  pwin.document.write('<html><head><link rel="stylesheet" href="style/printstyle.css" type="text/css" />');
  pwin.document.write('<title>عصر الواب | <?php echo $row["name"]; ?></title>');
  pwin.document.write('</head><body onload="window.print()">'+content+'</body></html>');
  pwin.document.close();
  setTimeout(function(){pwin.close();},1000);

}
</script>
<?php include('inc/R.php');?>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                   
                        <p class="alert alert-success">   <i class="fas fa-sync-alt"></i>  <a href="<?php echo $s?>.php?id=<?php echo $row["id"]; ?>" title='View Record' data-toggle='tooltip'>    <?php echo $row["name"]; ?></a></p>
                    </div>
              
                    <div class="form-group">
                 <div id="id_divprint">
                      <?php echo $row["address"]; ?>
                               
                            الوقت:
 <?php echo $row["date"]; ?>
</div>

 
   <a href="#" title="طباعة" onclick="printSelection(document.getElementById('id_divprint'));return false" class="btn btn-info"> <i class="fas fa-print"></i> طباعة</a> 
                    </div>
                    
                    
               <?php include("inc/footer.php"); ?>
