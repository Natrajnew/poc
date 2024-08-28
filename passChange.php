<?php

if(isset($_GET['uId']))
{
  
        $oktaDomain = 'https://bankofhope.oktapreview.com';
        $apiToken = '00pTjzEcbWYkGpmqvKczLXGZZbmpc7M7P6TcHfYHR3';
 
         $uId = $_GET['uId'];
         $token = $_GET['customStateToken'];

    
    $posurl = $oktaDomain . '/api/v1/users/' . $uId;
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => $posurl,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Accept: application/json',
        'Content-Type: application/json',
        'Authorization: SSWS '. $apiToken
      ),
    ));
    
    $res = curl_exec($curl);
    
    curl_close($curl);

    $dataArray = json_decode($res);
    $userProfile = $dataArray->profile;

    if($userProfile->appAccountStatus == 'ACTIVE' && $userProfile->customStateToken == $token)
    {

?>

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
    <div class="title">Set up password</div>
    <div class="content">
      <form id="passwordForm" name="passwordForm" method="POST">
        <div class="user-ldetails">
            <input type="hidden" id="myId" name="myId" value="<?php echo $uId; ?>">
          <div class="input-box">
            <span class="details">Enter Password</span>
            <input type="password" id="newPassword" name="newPassword" required
                   pattern="^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9])\S{8,}$" 
                   title="Password must contain at least one number, 
                           one alphabet, one symbol, and be at 
                           least 8 characters long" required />
          </div>
          <div class="input-box">
            <span class="details">Re-enter password</span>
            <input type="password" id="confirmPassword" name="confirmPassword" required />
          </div>
        </div>
        
        <div class="button">
          <input type="submit" name="user_activate" value="Next">
        </div>
        
      </form>
    </div>
  </div>

</body>
<script>
        document.getElementById('passwordForm').addEventListener('submit', function(event) {
            var password = document.getElementById('newPassword').value;
            var confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                event.preventDefault(); 
            }
        });
        
     
    </script>
</html>


<?php 

   if($_SERVER['REQUEST_METHOD'] == 'POST') 
   
   {
            
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];
        $myId = $_POST['myId'];
      
        $url = $oktaDomain . '/api/v1/users/' . $myId;
        
        $data = [
            'profile' => [
                'customStateToken' => 'USED'
            ],
            'credentials' => [
                    'password' => $confirmPassword
                    ]
        ];
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: SSWS ' . $apiToken,
            'Content-Type: application/json'
        ]);
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            echo '<script>
                alert("Password Reset Sucessfully.");
                window.location.href = "login.php";
            </script>';
        }
        
        curl_close($ch);
   }
}else{
    echo '<script>
            alert("Link expired. Redirecting back...");
            window.location.href = "login.php";
        </script>';
}
}
 