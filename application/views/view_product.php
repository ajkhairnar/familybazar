
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
              <li class="breadcrumb-item"><a href="#">Product</a></li>
              
                 <li class="breadcrumb-item active" aria-current="page">View Product</li>
				
              
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
               
                    <h6>View Product</h6>
			
             
            </div>
            <div class="ms-panel-body">
            <form class=" clearfix" action="<?=site_url().'/product/add_product/'?><?php if(isset($result)){ echo isset($result) ? $result->product_id : '0'; } else echo set_value('product_id');?>" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom18">Product Category *</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="" placeholder="Product Category"  name="product_cat" value="<?php if(isset($result)){ echo isset($result) ? $result->product_cat : ''; } else echo set_value('product_cat');?>" readonly="readonly" required="">
                    </div>
                    <span style="color: red"><?= form_error('product_name'); ?></span>
                  </div>
                  
                  <div class="col-md-6 mb-3">
                    <label for="validationCustom18">Product Sub Category *</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="" placeholder="Product Sub Category"  name="product_subcat" value="<?php if(isset($result)){ echo isset($result) ? $result->product_subcat : ''; } else echo set_value('product_subcat');?>" readonly="readonly" required="">
                    </div>
                    <span style="color: red"><?= form_error('product_name'); ?></span>
                  </div>
                  
                  <div class="col-md-12 mb-3">
                    <label for="validationCustom18">Product Company *</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Product Company"  name="product_company" value="<?php if(isset($result)){ echo isset($result) ? $result->product_company : ''; } else echo set_value('product_company');?>" readonly="readonly" required="">
                    </div>
                    <span style="color: red"><?= form_error('product_name'); ?></span>
                  </div>
                  
                  <div class="col-md-12 mb-3">
                    <label for="validationCustom18">Product Name *</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Product Name"  name="product_name" value="<?php if(isset($result)){ echo isset($result) ? $result->product_name : ''; } else echo set_value('product_name');?>" readonly="readonly" required="">
                    </div>
                    <span style="color: red"><?= form_error('product_name'); ?></span>
                  </div>
                </div>
                  
                
                  <a class="btn btn-info btn-sm mt-0 mb-3">Product Variations</a>

                  <div class="tblCustomers">

                  <?php     
                  
                  
                  $variation = $result->product_variation;
                  $dprice = $result->product_dprice;
                  $mrp = $result->product_mrp;
                  
                  
                  $product_variation=json_decode($variation);
                  $product_dprice=json_decode($dprice);
                  $product_mrp=json_decode($mrp);
                  
                  /*$product_variation1= $product_variation[0];
                  $product_dprice1=$product_dprice[0];
                  $product_mrp1=$product_mrp[0];
                  */
        

                  if(is_array($product_dprice))
                  {
                      
                  for($i=0;$i<count($product_variation[0]);$i++)
                  
                  { ?>
                     
                    
                        <div class="form-row ">

                        <div class="col-md-3 mb-3">
                          <label for="validationCustom18">Product Variation *</label>
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Product Variation" value="<?=$product_variation[0][$i]?>" name="product_variation[]" readonly="readonly"  required="">
                          </div>

                        </div>

                        <div class="col-md-3 mb-3">
                          <label for="validationCustom18">Product Dist Price *</label>
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Product Dist Price" value="<?=$product_dprice[0][$i]?>" readonly="readonly"  name="product_dprice[]"  required="">
                          </div>
                        </div>

                        <div class="col-md-3 mb-3">
                          <label for="validationCustom18">Product Price *</label>
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Product Price" value="<?=$product_mrp[0][$i]?>" readonly="readonly"  name="product_mrp[]"  required="">
                          </div>
                        </div>

                        </div>
                   

                  <?php }}
                  
                  else
                  {
                      ?>
                      
                      <div class="form-row ">

                        <div class="col-md-3 mb-3">
                          <label for="validationCustom18">Product Variation *</label>
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Product Variation" value="<?=$variation?>" readonly="readonly" name="product_variation[]"  required="">
                          </div>

                        </div>

                        <div class="col-md-3 mb-3">
                          <label for="validationCustom18">Product Dist Price *</label>
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Product Dist Price" value="<?=$dprice?>" readonly="readonly"  name="product_dprice[]"  required="">
                          </div>
                        </div>

                        <div class="col-md-3 mb-3">
                          <label for="validationCustom18">Product Price *</label>
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Product Price" value="<?=$mrp?>" readonly="readonly"  name="product_mrp[]"  required="">
                          </div>
                        </div>

                        </div>
                      
                      <?php
                  }
                      
                  ?>


                  
                  
                  </div>
                    
                  
                  <?php /* if(!$isEdit){ ?>
                  <div class="col-md-4 mb-3">
                    <label for="validationCustom18">Product Image *</label>
                    <div class="input-group">
                      <input type="file" class="form-control"  name="product_image" required="">
                    </div>
                  </div>
                  <?php }*/ ?>
                  <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <label for="validationCustom18">Product Image *</label>
                    <div class="input-group">
                     <img src="<?=base_url()?>uploads/product/<?=$result->product_img?>" style="height:100px; width:100px">
                    <?=$result->product_img?>
                    </div>
                   
                  </div>

                
                </div>
                

                <a class="btn btn-primary d-block float-right" href="<?=base_url()?>product/product_manage" >Go Back</a>
              </form>
            </div>
          </div>

        </div>

      </div>
    </div>


</main>
<!-- MODALS -->

<?php include('common/footer.php')?>



<script type="text/javascript">
function changeContent(str)
{
if (str=="")
  {
	// if blank, we'll set our innerHTML to be blank.
	document.getElementById("content").innerHTML="";
	return;
  }
if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		// create a new XML http Request that will go to our generator webpage.
		xmlhttp=new XMLHttpRequest();
	}
else
	{	// code for IE6, IE5
		// create an activeX object
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	// on state change
	xmlhttp.onreadystatechange=function()
	{
	// if we get a good response from the webpage, display the output
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
	{
		document.getElementById("content").innerHTML=xmlhttp.responseText;
	}
  }
 // use our XML HTTP Request object to send a get to our content php.
xmlhttp.open("GET","getlist.php?idcustomer="+str, true);
xmlhttp.send();
}
</script>



<script>

$(document).ready(function() {

$("#adddt").click(function() {

  $(`<div class="form-row">
  <div class="col-md-3 mb-3"> 
  <div class="input-group">
    <input type="text" class="form-control" placeholder="Product Variation"  name="product_variation[]"  required="">
  </div>

</div>

<div class="col-md-3 mb-3">
    <div class="input-group">
    <input type="text" class="form-control" placeholder="Product Dist Price"  name="product_dprice[]"  required="">
    </div>
</div>

<div class="col-md-3 mb-3">
    <div class="input-group">
    <input type="text" class="form-control" placeholder="Product Price"  name="product_mrp[]"  required="">
    </div>
</div>
<button type="button" class=" contentsdt ms-btn-icon btn-primary mt-0"><i class="flaticon-trash ms-delete-trigger"></i></button>
   
    </div>`).appendTo(".tblCustomers");


		});

  });

$(document).ready(function() {
$('.tblCustomers').on('click', '.contentsdt', function() {
  $(this).parent("div").remove();
});
});

</script>