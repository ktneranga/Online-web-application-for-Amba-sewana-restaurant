    <!-- Order modal -->
    
    <div class="modal fade" id="orderModal<?php echo $row['orderid'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
			      <h5 class="modal-title  w-100 font-weight-bold" id="exampleModalLabel">Order Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
                          <?php
                            $uid = $row['userid'];
                            $fd = "SELECT * FROM users WHERE id = $uid";
                            $res = mysqli_query($connection, $fd);

                            while ($iduser = mysqli_fetch_assoc($res)){ 
                          ?>
          <div class="modal-body">

                            <?php
                            $foodid = $row['fid'];
                            $fd = "SELECT * FROM foods WHERE id = $foodid";
                            $res = mysqli_query($connection, $fd);

                            while ($idfood = mysqli_fetch_assoc($res)){ 
                              ?>
                            <FROM>
                            <div>
                              <p> Order ID: <?php echo $row['orderid']; ?> </p>
                              <p> User Name:  <?php echo $iduser['First_Name']; echo " "; echo $iduser['Last_Name']; ?> </p>
                              <p> Food Name:  <?php echo $idfood['name']; ?> </p>
                              <p> Quantity: <?php echo $row['qty']; ?> </p>
                              <p> Total price:  <?php echo $row['price']; ?> </p>
                            </div>
                            <a href="inc/order_done.php?order_id=<?php echo $row['orderid'] ?>" class="btn btn-warning " >Mark as Done</a> | <a href="inc/order_cancel.php?order_id=<?php echo $row['orderid'] ?>"  class="btn btn-danger" >Cancel the Order</a>
                            </FROM>
                            <?php }} ?>
          </div>
        </div>
      </div>
   </div>

   <!-- end of modal -->
<!-- login modal end -->