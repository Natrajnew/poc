<?php 

session_start();

if (isset($_POST['register_user'])) {
    
    $form_data = [

      'profile' => [

          'firstName' => $_POST['firstName'],

          'lastName' => $_POST['lastName'],

          'middleName' => $_POST['middleName'],

          'email' => $_POST['email'],

          'login' => $_POST['email'],

          'primaryPhone' => $_POST['mobile'],

          'socialSecurityNumber' => $_POST['socialSecurityNumber'],

          'birthDate' => $_POST['birthDate'],

          'customerAccountNumber' => $_POST['accountNumber'],

          'accType' => $_POST['accType'],
          
          'appAccountStatus' => 'STAGED'

      ],

      'credentials'=> [

        'password' => '7iNVTfR4'

      ],
      
        'type' => [
            
           'id' => 'otyguiro1mJgOBbDH1d7'
     ]

  ];
  
  $data = json_encode($form_data);

  $_SESSION['data'] = $data;

  header("Location: api.php");

}

else

{

    echo "No data found";

}

?>