
<?php include('common/header.php')?>

<!-- sidebar -->
<?php include('common/sidebar.php')?>

<!-- Main Content -->
<main class="body-content">
<style>
span p{
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
              <li class="breadcrumb-item"><a href="#">Landmark</a></li>
               <?php  if($isEdit){ ?>
                 <li class="breadcrumb-item active" aria-current="page">Edit Landmark</li>
				<?php } else { ?>
                 <li class="breadcrumb-item active" aria-current="page">Add Landmark</li>
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
                    <h6>Edit Landmark</h6>
				<?php } else { ?>
                    <h6>Add Landmark</h6>
			   <?php 	} ?>
             
            </div>
            <div class="ms-panel-body">
            <form class=" clearfix" action="<?=site_url().'/landmark/add_landmark/'.$id;?>" method="post">
                <div class="form-row">
                  <div class="col-md-6 mb-12">

                    <label for="validationCustom18">Select State *</label>
                    <div class="input-group">
                      <select class=" form-control" name="shop_state" id="user_state" required="" >
                        <option selected value="">Select State</option>


                        <?php  if($isEdit){ ?>
                          <option selected="selected" value="<?=$result->shop_state?>"> <?=$result->shop_state?></option>
                        <?php } ?> 

                        <?php

                          foreach ($statelist as $row) {  ?>

                            <option value="<?=$row['state_name']?>"> <?= $row['state_name'] ?></option>;

                      <?php } ?>

                      </select>

                    </div>

                    <span style="color: red"><?= form_error('shop_state'); ?></span>
                   
                  </div>
                  
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom19">Select City *</label>
                    <div class="input-group">
                      <select class="form-control"  required=""  name="shop_city" id="user_city">
                        <?php  if($isEdit){ ?>
                          <option selected="selected" value="<?=$result->shop_city?>"> <?=$result->shop_city?></option>
                        <?php } ?> 
                      </select>
                    </div>
                    <span style="color: red"><?= form_error('shop_city'); ?></span>
                  </div>
                  
                  
                
                  
                  
                </div>
                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom20">Landmark *</label>
                    <div class="input-group">
                      <input type="text" class="form-control"  placeholder="Enter Landmark" name="landmark_name"  value="<?php if(isset($result)){ echo isset($result) ? $result->landmark_name : ''; } else echo set_value('landmark_name');?>" required="">
                     
                    </div>
                    <span style="color: red"><?= form_error('landmark_name'); ?></span>

                  </div>
                  
                  <div class="col-md-6 mb-3">
                   
                  </div>
                </div>
                <?php 
                  if($isEdit){ ?>
                  <input type="submit" name="btnupdate" value="Update" class="btn btn-success d-block float-right ml-2"></a>
                <?php } else { ?>
                  <input type="submit" name="btnsubmit" value="Create Landmark" class="btn btn-primary d-block float-right ml-2">
                <?php 	} ?>

                <a class="btn btn-primary d-block float-right" href="<?=base_url()?>landmark/landmark_manage" >Cancel</a>
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

$(document).ready(function(){
$('#user_state').change(function () {
            var statename = $(this).val();

            $.ajax({
                type: "POST",
                url:'<?=base_url()?>get_state_city.php',
                data: {'statename': statename}

            }).done(function (msg) {
                console.log(msg);
                       $('#user_city').html(msg); 
            });
        });
});

</script>

