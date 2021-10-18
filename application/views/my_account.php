
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
              <li class="breadcrumb-item"><a href="#">Account</a></li>
              
                 <li class="breadcrumb-item active" aria-current="page">Profile</li>
			   
              
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
                
                    <h6>Profile</h6>
			 
             
            </div>
            <div class="ms-panel-body">
            <form class=" clearfix" action="<?=site_url().'/account/editprofile/'.$user->id;?>" method="post">
                
                <div class="form-row">
                    
                   <div class="col-md-6 mb-3">
                    <label for="validationCustom21">Username *</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Admin Username" name="admin_username" value="<?= $user->admin_username ?>" >
                    </div>
                    <span style="color: red"><?= form_error('admin_username'); ?></span>

                  </div>
                  
                   <div class="col-md-6 mb-3">
                    <label for="validationCustom21">Password *</label>
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Admin Password" name="admin_pass" value="<?= $user->admin_pass ?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('admin_pass'); ?></span>

                  </div>
                  
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom20">Fullname *</label>
                    <div class="input-group">
                      <input type="text" class="form-control"  placeholder="Admin Fullname" name="admin_name"  value="<?= $user->admin_name ?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('admin_name'); ?></span>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="validationCustom21">Phone Number *</label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Phone Number" name="admin_phone" value="<?= $user->admin_phone ?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('admin_phone'); ?></span>

                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="validationCustom21">Email *</label>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Email Address" name="admin_email" value="<?= $user->admin_email ?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('admin_email'); ?></span>

                  </div>
                  
                  
                  
                  



                  <div class="col-md-6 mb-3">
                   
                  </div>
                </div>
                
               
                <input type="submit" name="btnsubmit" value="Submit" class="btn btn-success d-block float-right ml-2"></a>
              
                <a class="btn btn-primary d-block float-right" href="<?=base_url()?>dashboard" >Cancel</a>
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



