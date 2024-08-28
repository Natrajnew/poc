<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Bank Of Hope</title>
    <link rel="stylesheet" href="style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body class="body">
  <div class="lcontainer">
    <div class="title">Forgot password</div>
    <div class="content">
      <form name="forgotPass" action="passwordReset.php" method="post">
        <div class="user-ldetails">
          <div class="input-box">
            <span class="details">Registered Email</span>
            <input type="email" name="userName" required />
          </div>
        </div>
        
        <div class="button">
          <input type="submit" name="forgotPass" value="Next">
        </div>
        
      </form>
    </div>
  </div>

</body>
</html>
