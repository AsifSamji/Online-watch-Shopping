<?php
    session_start();    
    include("connection.php");
    
    if(isset($_POST['login']))
    {
       
        $username = $_POST['username'];
        $pwd = $_POST['password'];

        $query = "select * from registration where email = '$username' && password = '$pwd' " ;
        $data = mysqli_query($con,$query);
        $total = mysqli_num_rows($data);
        
        //echo $total;

        if($total==1)
        {
            $row = mysqli_fetch_assoc($data);
            
            $_SESSION['us'] = $username;
            $_SESSION['us_id'] = $row['id'];      
           

          echo "  <script>
                    alert('login successfully');                  
                    window.location.href='http://localhost/mobile_shopping/api/homepage.php';
                    </script>";
        }
        else
        {
           echo "<script>
                    alert('login failed');
                    </script>
                    ";
        }
    }

?>