<html>  
<head>  
    <title>Calendar</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
</head>
<style>
  body {
    align-content: center;
  }
 .box
 {
  width:100%;
  max-width:600px;
  background-color:#f9f9f9;
  border-radius: 10px;
  padding:16px;
  margin:0 auto;
  box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
 }
 .form-control {
  border: none;
  padding: 15px;
  height: 50px;

 }
 .error
{
  color: red;
  font-weight: 700;
} 
</style>
<?php 
include('config.php');
if(isset($_REQUEST['save-event']))
{
  $title = $_REQUEST['title'];
  $start_date = $_REQUEST['start_date'];
  $end_date = $_REQUEST['end_date'];

  $insert_query = mysqli_query($conn, "INSERT INTO events SET title='$title', start_date='$start_date', end_date='$end_date'");
  if($insert_query)
  {
    header('location:HomeScreen.php');
  }
  else
  {
    $msg = "Event not created!";
  }
}
?>
<body>  
    <div class="container">  
    <div class="table-responsive">  
    <h1 align="center">Create Event</h1><br/>
    <div class="box">
     <form method="post" >  
       <div class="form-group">
       <label for="title">Enter Title of the Event</label>
       <input type="text" name="title" id="title" placeholder="Enter Title" required 
       data-parsley-type="title" data-parsley-trigg
       er="keyup" class="form-control"/>
      </div>
      <div class="form-group">
       <label for="date">Start Date</label>
       <input type="datetime-local" name="start_date" id="start_date" required 
       data-parsley-type="date" data-parsley-trigg
       er="keyup" class="form-control"/>
      </div>
      <div class="form-group">
       <label for="date">End Date</label>
       <input type="datetime-local" name="end_date" id="end_date" required 
       data-parsley-type="date" data-parsley-trigg
       er="keyup" class="form-control"/>
      </div>
      <div class="form-group">
       <input type="submit" id="save-event" name="save-event" value="Save Event" class="btn btn-success" />
       </div>
       <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
     </form>
     </div>
   </div>  
  </div>
 </body>  
</html>  