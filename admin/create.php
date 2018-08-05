<?php
// Include config file
require_once '../config.php';
 
// Define variables and initialize with empty values
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "ارجو ادخال العنوان.";
    } elseif(!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"^[A-Za-z0-9ا-ي]^")))){
        $name_err = 'لم تقم باضافة عنوان.';
    } else{
        $name = $input_name;
    }
    
    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = 'لم تقم باضافة رساله.';     
    } else{
        $address = $input_address;
    }
    
    // Validate salary
     $input_salary = trim($_POST["salary"]);
    if(empty($input_address)){
        $salary_err = 'Please enter an salary.';     
    } else{
        $salary = $input_salary;
    }
    
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employees (name, address, salary) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
      <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
      <script src="/ckeditor/ckeditor.js"></script>
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
                      
                    </div>

                    <p>اضافة خبر او تحديث للموقع</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>العنوان</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>نص الخبر (<a href="help.php">مساعدة</a>)</label>
                            <textarea name="address" id="address" rows="10" cols="80" class="form-control"><?php echo $address; ?></textarea>
   <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'address' );
            </script>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                        
                        <input type="submit" class="btn btn-primary btn-block" value="ارسال">
                        
                    </form>

                <?php include("../inc/footer.php"); ?>