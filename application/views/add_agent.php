
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
              <li class="breadcrumb-item"><a href="#">Agent</a></li>
               <?php  if($isEdit){ ?>
                 <li class="breadcrumb-item active" aria-current="page">Edit Agent</li>
				<?php } else { ?>
                 <li class="breadcrumb-item active" aria-current="page">Add Agent</li>
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
                    <h6>Edit Agent</h6>
				<?php } else { ?>
                    <h6>Add Agent</h6>
			   <?php 	} ?>
             
            </div>
            <div class="ms-panel-body">
            <form class=" clearfix" action="<?=site_url().'/agents/add_agent/'.$id;?>" method="post" enctype="multipart/form-data">
                <div class="form-row">
                  <div class="col-md-12 mb-12">

                    <label for="validationCustom18">Full Name *</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Full name"  name="agent_fullname" value="<?php if(isset($result)){ echo isset($result) ? $result->agent_fullname : ''; } else echo set_value('agent_fullname');?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('agent_fullname'); ?></span>
                   
                  </div>
                  
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom19">Agent Username *</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Agent Username" name="agent_username" value="<?php if(isset($result)){ echo isset($result) ? $result->agent_username : ''; } else echo set_value('agent_username');?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('agent_username'); ?></span>
                  </div>
                  
                  
                  <?php if(!$isEdit)
                  {
                      echo'
                  
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom19">Agent Password *</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Agent Password" name="agent_pass" value="">
                    </div>
                  </div>
                  ';}
                  ;?>
<span style="color: red"><?= form_error("agent_pass"); ?></span>

                  
                  
                </div>
                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom20">Phone Number *</label>
                    <div class="input-group">
                      <input type="number" class="form-control"  placeholder="Phone Number" name="agent_phone"  value="<?php if(isset($result)){ echo isset($result) ? $result->agent_phone : ''; } else echo set_value('agent_phone');?>" required="">
                     
                    </div>
                    <span style="color: red"><?= form_error('agent_phone'); ?></span>

                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom21">Email *</label>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Email Address" name="agent_email" value="<?php if(isset($result)){ echo isset($result) ? $result->agent_email : ''; } else echo set_value('agent_email');?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('agent_email'); ?></span>

                  </div>

                  <!-- state -->
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom22">State *</label>
                    <div class="input-group">
                      <select class="form-control"  required=""  name="agent_state" id="user_state">
                      <?php  if($isEdit){ ?>
                        <option selected="selected" value="<?=$result->agent_state?>"> <?=$result->agent_state?></option>
                       <?php } ?> 
                        <?php
                            foreach ($statelist as $state) {  ?>

                              <option value="<?=$state['state_name']?>"> <?= $state['state_name'] ?></option>;

                        <?php  } ?>
                      </select>
                    </div>
                    <span style="color: red"><?= form_error('agent_state'); ?></span>
                  </div>

                  <!-- city -->
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom22">City *</label>
                    <div class="input-group">
                        
                        
                      <?php  if($isEdit){ ?>
                        <input class="form-control"  required=""  name="agent_city" id="user_city" require="" value="<?=$result->agent_city?>">
                      <?php }
                      else
                      echo '<input class="form-control"  required=""  name="agent_city" id="user_city" require="" value="">';?> 
                        
                    </div>
                    <span style="color: red"><?= form_error('agent_city'); ?></span>
                  </div>

                  <!-- landmark -->
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom22">Landmark Area *</label>
                    <div class="input-group">
                        
                      <?php  if($isEdit){ ?>
                        <input class="form-control"  required=""  name="agent_landmarkarea" id="getlandmark" require="" value="<?=$result->agent_landmarkarea?>">
                      <?php }
                      else
                      echo '<input class="form-control"  required=""  name="agent_landmarkarea" id="getlandmark" require="" value="">';?> 
                
                    </div>
                    <span style="color: red"><?= form_error('agent_landmarkarea'); ?></span>
                  </div>
                  

                  <!-- Addresss -->
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom24">Agent Address *</label>
                    <div class="input-group">
                      <input type="text" class="form-control"  placeholder="Agent Address" name="agent_address" value="<?php if(isset($result)){ echo isset($result) ? $result->agent_address : ''; } else echo set_value('agent_address');?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('agent_address'); ?></span>
                  </div>


                <?php if(!$isEdit){ ?>
                
                  <!-- Aadhar -->
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom21">Agent Aadhar *</label>
                    <div class="input-group">
                      <input type="file" class="form-control" name="aadharcard">
                    </div>
                    <?php if(isset($upload_error)) {echo $upload_error;}?>

                  </div>


                  <!-- Pancard -->
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom21">Pancard </label>
                    <div class="input-group">
                      <input type="file" class="form-control"   name="pancard">
                    </div>
                    

                  </div>

                  <!-- profile -->
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom21">Profile </label>
                    <div class="input-group">
                      <input type="file" class="form-control"   name="profile">
                    </div>
                  </div>


                <?php } ?> 

                    
                  <div class="col-md-6 mb-3">
                   
                  </div>
                </div>
                <?php 
				 	if($isEdit){ ?>
				 	<input type="submit" name="btnupdate" value="Update" class="btn btn-success d-block float-right ml-2"></a>
				 <?php } else { ?>
					<input type="submit" name="btnsubmit" value="Create Agent" class="btn btn-primary d-block float-right ml-2">
				 <?php 	} ?>

                <a class="btn btn-primary d-block float-right" href="<?=base_url()?>agents/agent_manage" >Cancel</a>
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
            alert(statename);
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

