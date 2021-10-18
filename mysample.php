<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
  $mysqli = new mysqli("localhost", "familybazar", "FAMILYbazar1not2$$", "familybazar");
  $mysqli->set_charset("utf8mb4");
} catch(Exception $e) {
  error_log($e->getMessage());
  exit('Error connecting to database'); //Should be a message a typical user could understand
}
?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

    </head>
    
    <body>
        
        
         <div class="container">
          <div class="row align-items-start">
            <div class="col">
                
                        <h1>Sales List</h1>    
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Product ID</th>
                              <th scope="col">Product Name</th>
                              <th scope="col">Product Variation</th>
                              <th scope="col">Product MRP</th>
                              <th scope="col">Product Qty</th>
                              <th scope="col">Product DP MRP</th>
                            </tr>
                          </thead>
                          <tbody>
              <?php
              $stmt = $mysqli->prepare("SELECT * FROM shop_sales");
                    //$stmt->bind_param("s", $_POST['name']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if($result->num_rows === 0) exit('No rows');
                    while($row = $result->fetch_assoc()) {
                        ?>

                            <tr>
                              <td><?=$row['sales_id'];?></td>
                               <td><?=$row['p_id'];?></td>
                               <td><?=$row['p_name'];?></td>
                               <td><?=$row['p_var'];?></td>
                               <td><?=$row['p_mrp'];?></td>
                               <td><?=$row['p_qty'];?></td>
                               <td><?=$row['p_dp'];?></td>
                            </tr>

  
                        
                    <?php
                    }
                    $stmt->close();
              
              ?>
              </tbody>
</table>
            </div>
            <div class="col">
              <h1>Sales Summary</h1>    
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Product ID</th>
                              <th scope="col">Product Name</th>
                              <th scope="col">Product Variation</th>
                              <th scope="col">Product MRP</th>
                              <th scope="col">Product Qty</th>
                            </tr>
                          </thead>
                          <tbody>
              <?php
              $date = "2021-01-11";
              $stmt = $mysqli->prepare("SELECT p_id,p_name,p_var, SUM(p_qty) AS Totalquantity FROM shop_sales WHERE sales_date = ? GROUP BY p_id");
                    $stmt->bind_param("s",$date);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if($result->num_rows === 0) exit('No rows');
                    while($row = $result->fetch_assoc()) {
                        ?>

                            <tr>
                               <td><?=$row['p_id'];?></td>
                               <td><?=$row['p_name'];?></td>
                               <td><?=$row['p_var'];?></td>
                               <td><?=$row['p_mrp'];?></td>
                               <td><?=$row['Totalquantity'];?></td>
                            </tr>

  
                        
                    <?php
                    }
                    $stmt->close();
              
              ?>
              </tbody>
</table>
            </div>
        </div>
                
    </body>
</html>