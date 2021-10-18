
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
              <li class="breadcrumb-item"><a href="#">Subcategory</a></li>
               <?php  if($isEdit){ ?>
                 <li class="breadcrumb-item active" aria-current="page">Edit Subcategory</li>
				<?php } else { ?>
                 <li class="breadcrumb-item active" aria-current="page">Add Subcategory</li>
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
                    <h6>Edit Subcategory</h6>
				<?php } else { ?>
                    <h6>Add Subcategory</h6>
			   <?php 	} ?>
             
            </div>
            <div class="ms-panel-body">
            <form class=" clearfix" action="<?=site_url().'/Subcategory/add_subcategory/'.$id;?>" method="post" enctype="multipart/form-data">
                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom18">Category Name *</label>
                    <div class="input-group">
                    <?php  if($isEdit){ ?>

                      <select class=" form-control" name="cat_name" required>
                        <option selected value="" >Select Category</option>
                        <?php

                          foreach ($resultcategory as $row) {  ?>

                            <option value="<?=$row['cat_id']?>" <?php if(isset($result)) {  if($row['cat_name'] == $result->cat_name) { echo "selected";} } elseif(set_value('cat_name')==$result->cat_name)echo"selected";?>> <?= $row['cat_name'] ?></option>;

                      <?php    } 
                        
                        ?>


                      </select>

                      <?php } else { ?>

                        <select class=" form-control" name="cat_name" required>
                        <option selected value="" >Select Category</option>
                        <?php

                          foreach ($resultcategory as $row) {  ?>

                            <option value="<?=$row['cat_id']?>"> <?= $row['cat_name'] ?></option>;

                      <?php    } 
                        
                        ?>

                      </select>

                      <?php 	} ?>

                      
                    </div>
                    <span style="color: red"><?= form_error('cat_name'); ?></span>
                   
                  </div>
                  <div class="col-md-6 mb-3">
                  
                    <label for="validationCustom18">Subcategory Name *</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="subcategory Name"  name="sub_cat_name" value="<?php if(isset($result)){ echo isset($result) ? $result->sub_cat_name : ''; } else echo set_value('sub_cat_name');?>" required="">
                    </div>
                    <span style="color: red"><?= form_error('shop_name'); ?></span>
                   
                  </div>

                  <div class="col-md-5 mb-3">
                      <label for="validationCustom18">Subcategory Image *</label>
                      <div class="input-group">
                        <input type="file" class="form-control"  name="sub_cat_image">
                      </div>
                      <?php if(isset($upload_error)) {echo $upload_error;}?>

                      <?php if($isEdit){ ?>
                    
                        <input type="hidden" class="form-control"  name="old_image_sub_cat" value="<?=$result->sub_cat_img?>">

                        <img src="<?=base_url()?>uploads/subcategory/<?=$result->sub_cat_img?>" style="height:100px; width:100px">
                        <?=$result->sub_cat_img?>

                      <?php } ?>

                  </div>

                  
                  
                </div>
               
                <?php 

                if($isEdit){ ?>
                <input type="submit" name="btnupdate" value="Update" class="btn btn-success d-block float-right ml-2"></a>
              <?php } else { ?>
                <input type="submit" name="btnsubmit" value="Create Subcategory" class="btn btn-primary d-block float-right ml-2">
              <?php 	} ?>

                <a class="btn btn-primary d-block float-right" href="<?=base_url()?>Subcategory/subcategory_manage" >Cancel</a>
              </form>
            </div>
          </div>

        </div>

      </div>
    </div>


</main>
<!-- MODALS -->

<?php include('common/footer.php')?>




