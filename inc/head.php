<?php include('inc/R.php');?>
<!DOCTYPE html>
<html dir="rtl">
    <head>
        <title><?php echo $site?></title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />  
         <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
     <script src="/ckeditor/ckeditor.js"></script>
<script>
$('.btn').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 8000);
});
</script>
