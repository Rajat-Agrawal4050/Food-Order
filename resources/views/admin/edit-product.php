<?php

use App\Models\Product;
use App\Models\Category;
$product_detail=Product::find($id);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Edit Product - Dashboard Admin Template</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="/css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="/jquery-ui-datepicker/jquery-ui.min.css" type="text/css" />
    <!-- http://api.jqueryui.com/datepicker/ -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="/css/templatemo-style.css">
     <link rel="stylesheet" href="/css/sweetalert2.min.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
  </head>

  <body>
    <nav class="navbar navbar-expand-xl">
      <div class="container h-100">
        <a class="navbar-brand" href="index.html">
          <h1 class="tm-site-title mb-0">Product Admin</h1>
        </a>
        <button
          class="navbar-toggler ml-auto mr-0"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars tm-nav-icon"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto h-100">
            <li class="nav-item">
              <a class="nav-link" href="/admin">
                <i class="fas fa-tachometer-alt"></i> Dashboard
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="far fa-file-alt"></i>
                <span> Reports <i class="fas fa-angle-down"></i> </span>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Daily Report</a>
                <a class="dropdown-item" href="#">Weekly Report</a>
                <a class="dropdown-item" href="#">Yearly Report</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="products.html">
                <i class="fas fa-shopping-cart"></i> Products
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="far fa-user"></i> Accounts
              </a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="fas fa-cog"></i>
                <span> Settings <i class="fas fa-angle-down"></i> </span>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Billing</a>
                <a class="dropdown-item" href="#">Customize</a>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link d-block" href="/logout">
                Admin, <b>Logout</b>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12">
                <h2 class="tm-block-title d-inline-block">Edit Product</h2>
              </div>
            </div>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form action="#" method="post" enctype="multipart/form-data" class="tm-edit-product-form">
                  
                  <div class="form-group mb-3">
                    <label
                      for="name"
                      >Product Name
                    </label>
                    <input
                      id="name"
                      name="name"
                      type="text"
                      value="<?php echo $product_detail->product_name ?>"
                      class="form-control validate"
                    />
                  </div>
                  <div class="form-group mb-3">
                    <label
                      for="desc"
                      >Description</label
                    >
                    <textarea                    
                      class="form-control validate tm-small"
                      rows="5"
                      id="desc" name="desc"
                      
                    ><?php echo $product_detail->description ?></textarea>
                  </div>
                  <div class="form-group mb-3">
                    <label
                      for="category"
                      >Category</label
                    >
                    <select
                      class="custom-select tm-select-accounts"
                      id="category" name="category"
                    >
                      <option value="">Select category</option>
                   <?php foreach($categories as $cat){ ?>
                    <option <?php echo ($cat->category_title==$product_detail->category) ? 'selected' : '' ?> value="<?Php echo $cat->category_title ?>" >
                      <?Php echo $cat->category_title ?>
                    </option>
                    <?Php } ?>
                    </select>
                  </div>
                  <div class="row">
                      <div class="form-group mb-3 col-xs-12 col-sm-6">
                          <label
                            for="price"
                            >Price
                          </label>
                          <input
                            id="price"
                            name="price"
                            type="text"
                            value="<?php echo $product_detail->price ?>"
                            class="form-control validate"
                            data-large-mode="true"
                          />
                        </div>
                        <div class="form-group mb-3 col-xs-12 col-sm-6">
                          <label
                            for="stock"
                            >Units In Stock
                          </label>
                          <input
                            id="stock"
                            name="stock"
                            type="text"
                            value="<?php echo $product_detail->stock ?>"
                            class="form-control validate"
                          />
                        </div>
                  </div>
                  
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                 <div class="tm-product-img-dummy mx-auto">
                <img src="<?php echo asset('storage/img/'.$product_detail->image) ?>" id="img_output" alt="image" style="width: 100%; height: 100%">
             
              </div>
               
                <div class="custom-file mt-3 mb-3">
                   <input id="fileInput" hidden onchange="document.querySelector('#img_output').src=window.URL.createObjectURL(this.files[0])" name="fileInput" type="file" style="" />
                  <input
                    type="button"
                    class="btn btn-primary btn-block mx-auto"
                    value="CHANGE IMAGE NOW"
                    onclick="document.getElementById('fileInput').click();"
                  />
                </div>
              </div>
              <div class="col-12">
                <input type="hidden" value="<?php echo $id ?>" name="product_id" id="product_id">
                <input type="hidden" value="<?php echo $product_detail->image ?>" name="old_img" id="old_img">
                <button type="button" id="editBtn" class="btn btn-primary btn-block text-uppercase">Update Now</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="tm-footer row tm-mt-small">
        <div class="col-12 font-weight-light">
          <p class="text-center text-white mb-0 px-4 small">
            Copyright &copy; <b>2018</b> All rights reserved. 
            
            Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
        </p>
        </div>
    </footer> 

    <script src="/js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="/jquery-ui-datepicker/jquery-ui.min.js"></script>
    <!-- https://jqueryui.com/download/ -->
    <script src="/js/bootstrap.min.js"></script>
     <script src="/js/sweetalert2.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>
      $(function() {

         $(document).on('click', '#editBtn', function() {

         console.log('edit form');
        let product_name = $('#name').val().trim();
        let desc = $('#desc').val().trim();
        let category = $('#category').val();
        let price = $('#price').val().trim();
        let stock = $('#stock').val().trim();
        let id = $('#product_id').val().trim();
        let token="<?php echo csrf_token() ?>";
        let old_img=$('#old_img').val();

        let img = null;
        if($('#fileInput').prop('files').length>0)
        img = $('#fileInput').prop('files')[0];

        if (product_name == '') {
          Swal.fire('Enter Product Name', '', 'error');
          return
        }
        if (desc == '') {
          Swal.fire('Please Enter Description', '', 'error');
          return
        }
        if (category == '') {
          Swal.fire('Please Select Category', '', 'error');
          return
        }
        if (price == '' || price <= 0) {
          Swal.fire('Enter Product Price', '', 'error');
          return
        }
        if (stock == '' || stock <= 0) {
          Swal.fire('Enter Stock Amount', '', 'error');
          return
        }

        let form_data = new FormData();
        form_data.append('product_name', product_name);
        form_data.append('desc', desc);
        form_data.append('category', category);
        form_data.append('price', price);
        form_data.append('stock', stock);
        form_data.append('product_image', img);
        form_data.append('product_id', id);
        form_data.append('_token', token);
        form_data.append('old_img', old_img);

        $.ajax({
          url: '/edit',
          type: 'POST',
          data: form_data,
          contentType: false,
          processData: false,
          success: function(resp) {
            console.log(resp);
            if (resp.trim() == 1) {
              location.href = '/all_products';
            } else {
              Swal.fire('Something went wrong', '', 'error');
            }
          },
          error: function(xhr) {
            console.error(xhr.responseText);
          }
        });

      });

      });


    </script>
  </body>
</html>
