
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
              <li class="breadcrumb-item"><a href="#">Agent</a></li>
                 <li class="breadcrumb-item active" aria-current="page">View Agent</li>
            </ol>
          </nav>


           

          <div class="ms-panel">
          
            <div class="ms-panel-header">
            <h6>View Agent</h6>
			   
             
            </div>
            <div class="ms-panel-body">
            <form class=" clearfix" >

                <div class="form-row">
                  <div class="col-md-6 mb-3">

                    <label for="validationCustom18">Full Name *</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Full name"  name="agent_fullname" value="<?php if(isset($result)){ echo isset($result) ? $result->agent_fullname : ''; } else echo set_value('agent_fullname');?>" >
                    </div>
                   
                   
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom19">Agent Username *</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Agent Username" name="agent_username" value="<?php if(isset($result)){ echo isset($result) ? $result->agent_username : ''; } else echo set_value('agent_username');?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('agent_username'); ?></span>
                      

                  </div>
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
                      <select class="form-control"  required=""  name="agent_state">
                        <option selected value="<?=$result->agent_state?>"> <?=$result->agent_state?></option>;
                      </select>
                    </div>
                    <span style="color: red"><?= form_error('agent_state'); ?></span>
                  </div>

                  <!-- city -->
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom22">City *</label>
                    <div class="input-group">
                      <select class="form-control"  required=""  name="agent_city">
                        <option selected value="<?=$result->agent_city?>"> <?=$result->agent_city?></option>;
                      </select>
                    </div>
                    <span style="color: red"><?= form_error('agent_city'); ?></span>
                  </div>

                  <!-- landmark -->
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom22">Landmark *</label>
                    <div class="input-group">
                      <select class="form-control"  required=""  name="agent_landmarkarea">
                        <option selected value="<?=$result->agent_landmarkarea?>"> <?=$result->agent_landmarkarea?></option>;
                      </select>
                    </div>
                    <span style="color: red"><?= form_error('agent_landmarkarea'); ?></span>
                  </div>
                  
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom24">Agent Address *</label>
                    <div class="input-group">
                      <input type="text" class="form-control"  placeholder="Agent Address" name="agent_address" value="<?php if(isset($result)){ echo isset($result) ? $result->agent_address : ''; } else echo set_value('agent_address');?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('agent_address'); ?></span>

                  </div>


                  <!-- Aadhar -->
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom21">Agent Aadhar *</label>
                    <div class="input-group">
                    
                    </div>
                    <img src="<?=base_url()?>uploads/agents/<?=$result->agent_aadhar?>" style="height: 246px;width: 406px;">

                  </div>


                  <!-- Pancard -->
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom21">Pancard </label>
                    <div class="input-group">
                     
                    </div>
                    <img src="<?=base_url()?>uploads/agents/<?=$result->agent_pancard?>" style="height: 246px;width: 406px;">

                  </div>

                  <!-- profile -->
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom21">Profile </label>
                    <div class="input-group">
                     
                    </div>
                    <img src="<?=base_url()?>uploads/agents/<?=$result->agent_profile?>" style="height: 246px;width: 406px;">
                  </div>

                  
                  <div class="col-md-6 mb-3">
                   
                  </div>
                </div>
                
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
    
</script>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );



</script>

