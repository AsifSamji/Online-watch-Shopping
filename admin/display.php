<?php 
  include("connection.php");
  include("header2.php");

   $sql = "select * from registration";
   $data = mysqli_query($con,$sql);
   $total = mysqli_num_rows($data);

   if($total != 0)
   {
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h2 {
        margin-top: 20px;
        color: #333;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 90%;
        margin: 20px 0;
        font-size: 1.1em;
        text-align: left;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 12px 15px;
        text-align: center;
    }

    th {
        background-color:rgb(47, 120, 165);
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    @media (max-width: 768px) {
        table {
            width: 50%;
        }

        th, td {
            padding: 8px;
            font-size: 14px;
        }
    }
</style>

<h2>Display All Records</h2>
<center>
   <table border="1" cellspacing="7">
      <tr>
          <th>Id</th>        
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Password</th>
      </tr>
<?php
       while($result = mysqli_fetch_assoc($data))
       {
            echo "<tr>
                  <td>".$result['id']."</td>
                  <td>".$result['fname']."</td>
                  <td>".$result['lname']."</td>
                  <td>".$result['email']."</td>
                  <td>".$result['password']."</td> 
                  </tr>";
       }
}
?>
</table>
<center>