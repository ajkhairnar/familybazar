
  <?php include('common/header.php')?>

<!-- sidebar -->
<?php include('common/sidebar.php')?>

<!-- Main Content -->
<main class="body-content">

  <!-- header -->
  <?php include('common/navbar.php')?>
  <style>

table img {
    max-width: 60px;
    border-radius: 0%;
    margin-right: 0px;
    }
</style>
  <div class="ms-content-wrapper">
      <div class="row">

        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-0">
              <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i>Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Subcategory</a></li>
              <li class="breadcrumb-item active" aria-current="page">Subcategory List</li>
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
            
              <h6>Subcategory List</h6>
            </div>
            <div class="ms-panel-body">
            <form action="<?=base_url()?>subcategory/update_subcat" method="post">
                <div class="row mb-4">
                  <div class="col-md-4">
                      <select class=" form-control" name="product_cat" required>
                          <option selected value="" >Select Category</option>
                          <?php

                              foreach ($resultcategory as $row) {  ?>

                              <option value="<?=$row['cat_id']?>,<?=$row['cat_name']?>,<?=$row['cat_slug']?>"><?= $row['cat_name'] ?></option>;

                          <?php }  ?>

                      </select>
                   </div>
                   <div class="col">
                      <button type="submit" name="submit" class="btn btn-danger btn-sm mt-1">Update</button>
                  </div>
                  </div>
                            
              <div class="table-responsive">
                <table id="pTable" class="table w-100 thead-primary">
                <thead>
						<tr>
              <th>select</th>
							<th>Id</th>
              <th> Subcategory Name </th>
							<th> Category Name </th>
              <th> Image </th>
              <th> Action </th>
						</tr>
					</thead>

                    <tbody>
                          <script type="text/javascript">
                     $(document).ready(function(){
                        $('#pTable').DataTable({
                        'pagingType': 'full_numbers',
                        'pageLength': 20,
                        'processing': true,
                        'serverSide': true,
                        'serverMethod': 'post',
                          'ajax': {
                             'url':'<?=base_url()?>Subcategory/getsubcategory'
                          },
                          'columns': [
                             {data:'sub_cat_id',
                                    render: function(data, type, row, meta) {
                                        var a = `<input type="checkbox" id="checkItem" name="check[]" value="${row.sub_cat_id}"/>`;
                                        return a;
                             },},
                             { data: 'sub_cat_id' },
                             { data: 'sub_cat_name' },
                             { data: 'cat_name' },
                             { data: "sub_cat_img",
                                    render: function(data, type, row, meta) {
                                        var b =`<img src="<?=base_url()?>uploads/subcategory/${row.sub_cat_img}" width="150" height="150" />`;
                                        return b;
                             }, },
                             {data: 'sub_cat_id',
                                    render: function(data, type, row, meta) {
                                        var c = `<a href="<?=base_url()?>subcategory/subcategory_manage/${row.sub_cat_id}"><i class="fas fa-pencil-alt text-secondary"></i></a><a href="<?=base_url()?>subcategory/subcategory_delete/${row.sub_cat_id}"><i class="far fa-trash-alt ms-text-danger"></i></a>`;
                                        return c;
                             },},
                          ]
                        });
                     });
                     </script>
                    <?php  //foreach ($subcategories as $subcategory) { ?>
                            <!--<tr>-->
                            <!--<th ><input type="checkbox" id="checkItem" name="check[]" value="<?= $subcategory->sub_cat_id ?>"></th>-->
                            <!--    <td><?= $subcategory->sub_cat_id ?></td>-->
                            <!--    <td><?= $subcategory->sub_cat_name ?></td>-->
                            <!--    <td><?= $subcategory->cat_name ?></td>-->
                                
                            <!--    <td scope="row"><img src="<?=base_url()?>uploads/subcategory/<?=$subcategory->sub_cat_img?>"></td>-->
                            <!--    <td>-->
                            <!--        <a href="<?=base_url().'subcategory/subcategory_manage/'.$subcategory->sub_cat_id ?>"><i class="fas fa-pencil-alt text-secondary"></i></a>-->
                            <!--        <a href="<?=base_url().'subcategory/subcategory_delete/'.$subcategory->sub_cat_id ?>"><i class="far fa-trash-alt ms-text-danger"></i></a>-->
                            <!--    </td>-->
                              
                            <!--</tr>-->
                            <?php //} ?>
						
					</tbody>
                </table>
              </div>
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

