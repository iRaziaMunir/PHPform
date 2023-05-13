<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>Document</title>
  <style>
  body{
  background-color: rgb(51,153,153);
  }
  h1{
    font-size:3rem;
  }
  .error{
    color:red;
  }
  form{
  font-weight: bold;
  }
  form input,textarea{
  padding: 6px 8px;
  background-color:rgb(204,204,204);
  border:none;
  }
  .submit-btn{
    width:200px;
    font-weight:bold;
    border:none;
  }

</style>
</head>

<html>
<body>
<?php 
// define   variables and set to empty values
$FnameErr = $LnameErr = $emailErr = $genderErr = $passwordErr = $websiteErr  = "" ;
$Fname = $Lname = $email = $gender = $comment = $website = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //check if first name is empty
  if (empty($_POST["firstname"])) {
    $FnameErr = "First Name is required";
  } else {
    $Fname = test_input($_POST["firstname"]);
    // check if First name contains only letters and whitespaces
    if(!preg_match ("/^[a-zA-Z]*$/" ,$Fname)){
      $FnameErr = "Only letters and whitespaces are allowed";
    }
  }
  //check if last name is empty
  if (empty($_POST["lastname"])) {
    $LnameErr = "Last Name is required";
  } else {
    $Lname = test_input($_POST["lastname"]);
  }
  //check if email  is empty
  if (empty($_POST["email"])) {
    $emailErr =  "Email is required";
  } else { 
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var( $email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
 //check if password  is empty
  if (empty($_POST["password"])) {
    $passwordErr =  "password is required";
  } else { 
    $password = test_input($_POST["password"]);
  }
  //check if $website   is empty
  
  if (empty($_POST["website"])) {
    $websiter =  " ";
  } else { 
    $website = test_input($_POST["website"]);
       // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
       if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
        $websiteErr = "invalid URL";
       }
  }

  //check if gender  is empty
  
  if (empty($_POST["gender"])) {
    $genderErr =  "gender is required";
  } else { 
    $gender = test_input($_POST["gender"]);
  }
  
  //check if comment   is empty
  if (empty($_POST["comment"])) {
    $comment =  " ";
  } else { 
    $comment = test_input($_POST["comment"]);
  }
  
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>




<!-- form -->
<div class="container">
    <form class="row"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
    <div class="text-center col-12">
        <h1> Personal Information:</h1>
    </div>
    <div class="col-6">
        First name:<br>
        <input type="text" name="firstname" value=" <?php echo $Fname;?>"><span class="error">*
        <?php echo $FnameErr;?></span><br><br>
    </div>
    <di class="col-6">
    Last name:<br>
        <input type="text" name="lastname" value="<?php echo $Lname; ?>">
        <span class="error">* <?php echo $LnameErr;?></span><br><br>
    </di>
    <di class="col-6">
        Email:<br>
        <input type="text" name="email" id="email" value = "<?php echo $email; ?>">
        <span class="error">* <?php echo $emailErr;?></span> <br><br>
    </di>
    <di class="col-6">
    Password:<br>
        <input type="password" name="password" id="password" value = "<?php echo $password; ?>"> 
        <span class="error">* <?php echo $passwordErr ;?></span><br><br><br>
    </di>
    <di class="col-6">
        Website:<br>
        <input type="text" name="website" id="website" value = " <?php echo $website ;?>">
        <span class="error"><?php echo $websiteErr ;?></span><br>
    </di>
    <di class="col-6">
    Gender: <span class="error">* <?php echo $genderErr ;?></span><br><br>
    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>  value="female" class = "gender">Female<br>
    <input type="radio" name="gender" <?php if (isset($gender)&& $gender == "male") echo "checked"; ?>  value="male" class = "gender">Male<br>
    <input type="radio" name="gender" <?php if (isset($gender)&& $gender == "other") echo "checked"; ?> value="other" class = "gender">Other <br>
    </di>
    <di class="col-12">
    Comment:<br>
     <textarea name="comment" rows="5" cols="40" ><?php echo $comment ; ?></textarea>
    </di>
    <di class="col-6 ">
    <br>
    <input type="submit" value="Submit" class = "submit-btn">
    </di>
    
</form>
</div>
</div>
</body>
</html>


