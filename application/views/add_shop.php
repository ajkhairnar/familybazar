
<?php include('common/header.php')?>

<!-- sidebar -->
<?php include('common/sidebar.php')?>

<!-- Main Content -->
<main class="body-content">
<style>
span p{
    color:red;
}

p{
  color:red;
}
</style>
  <!-- header -->
  <?php include('common/navbar.php')?>

  <div class="ms-content-wrapper">

      <div class="row">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-0">
              <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i>Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Shop</a></li>
               <?php  if($isEdit){ ?>
                 <li class="breadcrumb-item active" aria-current="page">Edit Customer</li>
				<?php } else { ?>
                 <li class="breadcrumb-item active" aria-current="page">Add Customer</li>
			   <?php 	} ?>
              
            </ol>
          </nav>


            <?php if($this->session->flashdata('success_msg')){ ?>
                <div class="alert alert-success" role="alert">
                    <i class="flaticon-tick-inside-circle"></i> <strong>Well done!</strong>  <?=$this->session->flashdata('success_msg')?>
                </div>
		    <?php } ?>
            
            <?php if($this->session->flashdata('error_msg')){ ?>
                <div class="alert alert-danger" role="alert">
                    <i class="flaticon-alert-1"></i> <strong>Oh snap!</strong> <?=$this->session->flashdata('error_msg')?>
                </div>
		    <?php } ?>
            


          <div class="ms-panel">
          
            <div class="ms-panel-header">
                <?php  if($isEdit){ ?>
                    <h6>Edit Customer</h6>
				<?php } else { ?>
                    <h6>Add Customer</h6>
			   <?php 	} ?>
             
            </div>
            <div class="ms-panel-body">
            <form class=" clearfix" action="<?=site_url().'/shop/add_shop/'.$id;?>" method="post">
                
                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom20">Customer Name *</label>
                    <div class="input-group">
                      <input type="text" class="form-control"  placeholder="Customer Name" name="shop_owner"  value="<?php if(isset($result)){ echo isset($result) ? $result->shop_owner : ''; } else echo set_value('shop_owner');?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('shop_owner'); ?></span>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="validationCustom21">Phone Number *</label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Phone Number" name="shop_phone" value="<?php if(isset($result)){ echo isset($result) ? $result->shop_phone : ''; } else echo set_value('shop_phone');?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('shop_phone'); ?></span>

                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="validationCustom21">Email *</label>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Email Address" name="shop_email" value="<?php if(isset($result)){ echo isset($result) ? $result->shop_email : ''; } else echo set_value('shop_email');?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('shop_email'); ?></span>

                  </div>
                  
                  

                  <div class="col-md-6 mb-3">
                    <label for="validationCustom22">State *</label>
                    <div class="input-group">
                      <select class="form-control"  required=""  name="shop_state" id="user_state">
                      <?php  if($isEdit){ ?>
                        <option selected="selected" value="<?=$result->shop_state?>"> <?=$result->shop_state?></option>
                       <?php } ?> 
                        <?php
                            foreach ($statelist as $state) {  ?>

                              <option value="<?=$state['state_name']?>"> <?= $state['state_name'] ?></option>;

                        <?php  } ?>
                      </select>
                    </div>
                    <span style="color: red"><?= form_error('shop_state'); ?></span>
                  </div>


                  <div class="col-md-6 mb-3">
                    <label for="validationCustom22">City *</label>
                    <div class="input-group">
                      <select class="form-control"  required=""  name="shop_city" id="user_city">
                      <?php  if($isEdit){ ?>
                        <option selected="selected" value="<?=$result->shop_city?>"> <?=$result->shop_city?></option>
                      <?php } ?>   
                        
                      </select>
                    </div>
                    <span style="color: red"><?= form_error('shop_city'); ?></span>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="validationCustom22">Landmark Area *</label>
                    <div class="input-group">
                      <select class="form-control"  required=""  name="shop_landmarkarea" id="getlandmark" require="">
                      <?php  if($isEdit){ ?>
                        <option selected="selected" value="<?=$result->shop_landmarkarea?>"> <?=$result->shop_landmarkarea?></option>
                      <?php } ?> 
                
                      </select>
                    </div>
                    <span style="color: red"><?= form_error('shop_landmarkarea'); ?></span>
                  </div>
                  

                    
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom21">Address *</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Shop Address" name="shop_address" value="<?php if(isset($result)){ echo isset($result) ? $result->shop_address : ''; } else echo set_value('shop_address');?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('shop_address'); ?></span>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="validationCustom21">Zip Code *</label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Zip Code" name="shop_zipcode" value="<?php if(isset($result)){ echo isset($result) ? $result->shop_zipcode : ''; } else echo set_value('shop_zipcode');?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('shop_zipcode'); ?></span>
                  </div>



                  <div class="col-md-6 mb-3">
                   
                  </div>
                </div>
                <?php 

                if($isEdit){ ?>
                <input type="submit" name="btnupdate" value="Update" class="btn btn-success d-block float-right ml-2"></a>
              <?php } else { ?>
                <input type="submit" name="btnsubmit" value="Create Shop" class="btn btn-primary d-block float-right ml-2">
              <?php 	} ?>

                <a class="btn btn-primary d-block float-right" href="<?=base_url()?>shop/shop_manage" >Cancel</a>
              </form>
            </div>
          </div>

        </div>

      </div>
    </div>


</main>
<!-- MODALS -->

<?php include('common/footer.php')?>


<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );

</script>


<script>


//get city
$(document).ready(function(){
$('#user_state').change(function () {
            var statename = $(this).val();

            $.ajax({
                type: "POST",
                url:'<?=base_url()?>get_state_city.php',
                data: {'statename': statename}

            }).done(function (msg) {
               
                       $('#user_city').html(msg); 
            });
        });
});



//get landmark
$(document).ready(function(){
$('#user_city').change(function () {
            var statename = $(this).val();
            
            $.ajax({
                type: "POST",
                url:'<?=base_url()?>get_landmark.php',
                data: {'statename': statename}

            }).done(function (msg) {
                console.log(msg);
                       $('#getlandmark').html(msg); 
            });
        });
});

</script>
