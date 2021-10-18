 <!-- Sidebar Navigation Left -->
 <aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">
    <!-- Logo -->
    <div class="logo-sn ms-d-block-lg">
      <a class="pl-0 ml-0 text-center" href="#" style="    font-size: 21px;">
        <img src="<?=assets?>img/familybazar_logo.png" alt="logo">
      </a>
    </div>
    <!-- Navigation -->
    <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
      <!-- Dashboard -->
      <li class="menu-item">
        <a href="<?=base_url()?>/dashboard" > <span><i class="material-icons fs-16">dashboard</i>Dashboard </span>
        </a>
      </li>
      <!-- /Dashboard -->
      <!-- customers-->
      
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#orders" aria-expanded="false" aria-controls="customer"> <span><i class="fas fa-user-friends fs-16"></i>Orders </span>
        </a>
        <ul id="orders" class="collapse" aria-labelledby="orders" data-parent="#side-nav-accordion">
          <!--<li> <a href="<?=base_url()?>sales/sales_list"> Order List</a>-->
          <!--</li>-->
          
          <li> <a href="<?=base_url()?>sales/sales_new_list"> Order List</a>
          </li>
        </ul>
      </li>
      
      
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#customer" aria-expanded="false" aria-controls="customer"> <span><i class="fas fa-user-friends fs-16"></i>Agents </span>
        </a>
        <ul id="customer" class="collapse" aria-labelledby="customer" data-parent="#side-nav-accordion">
          <li> <a href="<?=base_url()?>agents/add_agent"> Add Agent</a>
          </li>
          <li> <a href="<?=base_url()?>agents/agent_manage"> Agent List</a>
          </li>
          <li> <a href="<?=base_url()?>agents/agent_pending_list"> Agent Pending List</a>
          </li>
        </ul>
      </li>

      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#shop" aria-expanded="false" aria-controls="shop"> <span><i class="fa fa-archive fs-16"></i>Customer </span>
        </a>
        <ul id="shop" class="collapse" aria-labelledby="shop" data-parent="#side-nav-accordion">
          <li> <a href="<?=base_url()?>shop/add_shop"> Add Customer</a>
          </li>
          <li> <a href="<?=base_url()?>shop/shop_manage">Customer List</a>
          </li>
        </ul>
      </li>
      
      
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#product" aria-expanded="false" aria-controls="shop"> <span><i class="fa fa-archive fs-16"></i>Products </span>
        </a>
        <ul id="product" class="collapse" aria-labelledby="product" data-parent="#side-nav-accordion">
          <li> <a href="<?=base_url()?>product/add_product"> Add Products</a>
          </li>
          <li> <a href="<?=base_url()?>product/product_manage">List Products</a>
          </li>
        </ul>
      </li>

      <!-- Customers  end -->
      <!-- sales -->
      <!-- <li class="menu-item">
        <a href="<?=base_url()?>product/add_category"> <span><i class="fa fa-briefcase fs-16"></i>Category</span>
        </a>
      </li> -->

      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#cat" aria-expanded="false" aria-controls="cat"> <span><i class="fa fa-tasks fs-16"></i>Category </span>
        </a>
        <ul id="cat" class="collapse" aria-labelledby="cat" data-parent="#side-nav-accordion">
          <li> <a href="<?=base_url()?>category/add_category"> Add Category</a>
          </li>
          <li> <a href="<?=base_url()?>category/category_manage">List Category</a>
          </li>
        </ul>
        
      </li>

      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#subcat" aria-expanded="false" aria-controls="subcat"> <span><i class="fa fa-tasks fs-16"></i>Subcategory </span>
        </a>
        <ul id="subcat" class="collapse" aria-labelledby="subcat" data-parent="#side-nav-accordion">
          <li> <a href="<?=base_url()?>subcategory/add_subcategory"> Add Subcategory</a>
          </li>
          <li> <a href="<?=base_url()?>subcategory/subcategory_manage">List Subcategory</a>
          </li>
        </ul>
        
      </li>


      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#land" aria-expanded="false" aria-controls="land"> <span><i class="fa fa-tasks fs-16"></i>Account </span>
        </a>
        <ul id="land" class="collapse" aria-labelledby="land" data-parent="#side-nav-accordion">
          <li> <a href="<?=base_url()?>account">Edit Account</a>
          </li>
        </ul>
        
      </li>
     
     
      <!-- /Apps -->
    </ul>
  </aside>


