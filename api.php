<?php

session_start();

if (isset($_SESSION['data'])) 
{
   
    $data = $_SESSION['data'];

    $email = json_decode($data, true);

      if (isset($email['profile']['email'])) 
      {
          $username = $email['profile']['email'];

          $firstname = $email['profile']['firstName'];
         
              $curl = curl_init();

              curl_setopt_array($curl, array(

                CURLOPT_URL => 'https://bankofhope.oktapreview.com/api/v1/users?activate=true',

                CURLOPT_RETURNTRANSFER => true,
                
                CURLOPT_ENCODING => '',
                
                CURLOPT_MAXREDIRS => 10,
                
                CURLOPT_TIMEOUT => 0,
                
                CURLOPT_FOLLOWLOCATION => true,
                
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                
                CURLOPT_CUSTOMREQUEST => 'POST',
                
                CURLOPT_POSTFIELDS => $data,
                
                CURLOPT_HTTPHEADER => array(
                  'Accept: application/json',
                  'Content-Type: application/json',
                  'Authorization: SSWS 00pTjzEcbWYkGpmqvKczLXGZZbmpc7M7P6TcHfYHR3'
                ),

              ));

              $response = curl_exec($curl);

              curl_close($curl);

              $activation = json_decode($response, true);
              
              //Customer added to Group
              
                $up = curl_init();
                
                curl_setopt_array($up, array(
                  CURLOPT_URL => 'https://bankofhope.oktapreview.com/api/v1/groups/00gguipjybTA2xxtK1d7/users/'.$activation['id'],
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'PUT',
                  CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    'Content-Type: application/json',
                    'Authorization: SSWS 00pTjzEcbWYkGpmqvKczLXGZZbmpc7M7P6TcHfYHR3'
                  ),
                ));
                
                $ponse = curl_exec($up);
                
                curl_close($up);
              
              if (isset($activation['id'])) 
              {
                                    $userid = $activation['id'];
                    
                                        $to = $username;
                                        
                                        // Define the subject of the email
                                        $subject = 'Bank Of Hope';
                                        
                                        // Define the body of the email
                                        $message = '<!DOCTYPE html>
                    <html>
                    
                    <head>
                        <title></title>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                    </head>
                    
                    <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
                        <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Lato, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> Thrilled to have you here! Get ready to dive into your new account. </div>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <!-- LOGO -->
                            <tr>
                                <td bgcolor="#ff7361" align="center">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#ff7361" align="center" style="padding: 0px 10px 0px 10px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                                                <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> <img src="https://bankofhope.oktapreview.com/poc/boh.png" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                           
                            <tr>
                                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;"><p>Hi '. $firstname .' ,</p>Your Bank Of Hope account was just used to activate from a new or unrecognized device, browser or application. 
                                                                for more details:<a href="https://www.bankofhope.com"> https://www.bankofhope.com</a></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#ffffff" align="left">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td align="center" style="border-radius: 3px;" bgcolor="#ff7361"><a href="https://bankofhope.oktapreview.com/poc/activate.php?userId='. $userid .'" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #ff7361; display: inline-block;">Aactivate Account</a></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr> <!-- COPY -->
                                       
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;">Your username is <a href="#"> '.$username.' </a><br>
                                                          Your account sign-in page is <a href="https://bankofhope.oktapreview.com/poc/login.php">login?</a><br>
                                                          If you experience difficulties accessing your account, you can send a help request to this email <a>support@bankofhope.com</a> <br></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;">Thanks for choosing our service,<br>BOH Team</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </body>
                    
                    </html>';
    
                    // Define additional headers
                    $headers = 'From: wic@naokta.com' . "\r\n" .
                               'Reply-To: wic@naokta.com' . "\r\n" .
                               'Content-type:text/html;charset=UTF-8' . "\r\n" .
                               'MIME-Version: 1.0' . "\r\n" .
                               'X-Mailer: PHP/' . phpversion();
                    
                    // Send the email
                    if (mail($to, $subject, $message, $headers)) 
                    {
                       echo '<script>
                            alert("Email sent sucessfully.");
                            window.location.href = "thankyou.html";
                        </script>';    
                    } 
                    else 
                    {
                         echo '<script>
                            alert("Please try after sometime..");
                        </script>';    
                    }
              } 

      } else {
          echo "Email not found in the Form data.";
      }
    } 
?>