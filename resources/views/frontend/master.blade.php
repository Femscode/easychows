<!DOCTYPE html>
<html lang="en">
   
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta content="Codescandy" name="author" />
      <title>EasyChows | Home</title>
      <meta name="description" content="Get Your Meals Delivered In No Time!" />
	<meta name="keywords" content="Order with ease with EasyChows" />
	

      <link href="{{url('assets/libs/slick-carousel/slick/slick.css')}}" rel="stylesheet" />
      <link href="{{url('assets/libs/slick-carousel/slick/slick-theme.css')}}" rel="stylesheet" />
      <link href="{{url('assets/libs/tiny-slider/dist/tiny-slider.css')}}" rel="stylesheet" />

      <!-- Favicon icon-->
      <link rel="shortcut icon" type="image/x-icon" href="{{url('assets/images/logo/easychow.svg')}}" />

      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Libs CSS -->
      <link href="{{url('assets/libs/bootstrap-icons/font/bootstrap-icons.min.css')}}" rel="stylesheet" />
      <link href="{{url('assets/libs/feather-webfont/dist/feather-icons.css')}}" rel="stylesheet" />
      <link href="{{url('assets/libs/simplebar/dist/simplebar.min.css')}}" rel="stylesheet" />

      <!-- Theme CSS -->
      <link rel="stylesheet" href="{{url('assets/css/theme.min.css')}}" />
      @yield('header')
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag() {
            dataLayer.push(arguments);
         }
         gtag("js", new Date());

         gtag("config", "G-M8S4MT3EYG");
      </script>
      <script type="text/javascript">
         (function (c, l, a, r, i, t, y) {
            c[a] =
               c[a] ||
               function () {
                  (c[a].q = c[a].q || []).push(arguments);
               };
            t = l.createElement(r);
            t.async = 1;
            t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
         })(window, document, "clarity", "script", "kuc8w5o9nt");
      </script>
   </head>

   <body>
      <!-- navbar -->
      <div class="border-bottom">
         <!-- <div class="bg-light py-1">
            <div class="container">
               <div class="row">
                  <div class="col-md-6 col-12 text-center text-md-start"><span>Discover Easy Chows, Enjoy Every Bite</span></div>
                
               </div>
            </div>
         </div> -->
         <div class="py-5 ">
            <div class="container ">
               <div class="row w-100 align-items-center gx-lg-2 gx-0 ">
                  <div class="col-xxl-2 col-lg-3 col-md-6 col-5 ">
                     <a class="navbar-brand d-none d-lg-block" href="/">
                        
                        <img src="{{url('assets/images/logo/easychows-logo.jpeg')}}" height='70px' width='100px' alt="EasyChow Logo" />
                     </a>
                     <div class="d-flex justify-content-between w-100 d-lg-none">
                        <a class="navbar-brand" href="/">
                           <img src="{{url('assets/images/logo/easychows-logo.jpeg')}}"  height='70px' width='100px' alt="EasyChow Logo" />
                        </a>
                     </div>
                  </div>
                  <div class="col-xxl-5 col-lg-5 d-none d-lg-block">
                     <form action="#">
                        <div class="input-group">
                           <input class="form-control rounded" type="search" placeholder="Search for menu / restaurant" />
                           <span class="input-group-append">
                              <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end" type="button">
                                 <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-search">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                 </svg>
                              </button>
                           </span>
                        </div>
                     </form>
                  </div>
                 
                  <div class="col-lg-2 col-xxl-2 text-end col-md-6 col-7">
                     <div class="list-inline">
                        
                        <div class="list-inline-item me-5">
                           <a href="/register" class="text-muted">
                              <svg
                                 xmlns="http://www.w3.org/2000/svg"
                                 width="20"
                                 height="20"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="feather feather-user">
                                 <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                 <circle cx="12" cy="7" r="4"></circle>
                              </svg>
                           </a>
                        </div>
                       
                        <div class="list-inline-item d-inline-block d-lg-none">
                           <!-- Button -->
                           <button
                              class="navbar-toggler collapsed"
                              type="button"
                              data-bs-toggle="offcanvas"
                              data-bs-target="#navbar-default"
                              aria-controls="navbar-default"
                              aria-label="Toggle navigation">
                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-text-indent-left text-primary" viewBox="0 0 16 16">
                                 <path
                                    d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                              </svg>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <nav class="navbar navbar-expand-lg navbar-light navbar-default py-0 pb-lg-4" aria-label="Offcanvas navbar large">
            <div class="container">
               <div class="offcanvas offcanvas-start" tabindex="-1" id="navbar-default" aria-labelledby="navbar-defaultLabel">
                  <div class="offcanvas-header pb-1">
                     <a href="/">
                     <img src="{{url('assets/images/logo/easychows-logo.jpeg')}}" height='70px' width='100px' alt="EasyChow Logo" />
                     
                     </a>
                     <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body">
                     <div class="d-block d-lg-none mb-4">
                        <form action="#">
                           <div class="input-group">
                              <input class="form-control rounded" type="search" placeholder="Search for menu / restaurant" />
                              <span class="input-group-append">
                                 <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end" type="button">
                                    <svg
                                       xmlns="http://www.w3.org/2000/svg"
                                       width="16"
                                       height="16"
                                       viewBox="0 0 24 24"
                                       fill="none"
                                       stroke="currentColor"
                                       stroke-width="2"
                                       stroke-linecap="round"
                                       stroke-linejoin="round"
                                       class="feather feather-search">
                                       <circle cx="11" cy="11" r="8"></circle>
                                       <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                 </button>
                              </span>
                           </div>
                        </form>
                        <div class="mt-2">
                           <button type="button" class="btn btn-outline-gray-400 text-muted w-100" data-bs-toggle="modal" data-bs-target="#locationModal">
                              <i class="feather-icon icon-map-pin me-2"></i>
                              Pick Location
                           </button>
                        </div>
                     </div>
                     <div class="d-block d-lg-none mb-4">
                        <a
                           class="btn btn-primary w-100 d-flex justify-content-center align-items-center"
                           data-bs-toggle="collapse"
                           href="/"
                           role="button">
                           <span class="me-2">
                              <svg
                                 xmlns="http://www.w3.org/2000/svg"
                                 width="16"
                                 height="16"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="feather feather-grid">
                                 <rect x="3" y="3" width="7" height="7"></rect>
                                 <rect x="14" y="3" width="7" height="7"></rect>
                                 <rect x="14" y="14" width="7" height="7"></rect>
                                 <rect x="3" y="14" width="7" height="7"></rect>
                              </svg>
                           </span>
                           Home
                        </a>
                    
                     </div>
                     <div class="dropdown me-3 d-none d-lg-block">
                        <a class="btn btn-primary px-6" type="button" href='/'>
                           <span class="me-1">
                              <svg
                                 xmlns="http://www.w3.org/2000/svg"
                                 width="16"
                                 height="16"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.2"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="feather feather-grid">
                                 <rect x="3" y="3" width="7" height="7"></rect>
                                 <rect x="14" y="3" width="7" height="7"></rect>
                                 <rect x="14" y="14" width="7" height="7"></rect>
                                 <rect x="3" y="14" width="7" height="7"></rect>
                              </svg>
                           </span>
                           Home
        </a>
                     
                     </div>
                     <div>
                        <ul class="navbar-nav align-items-center">
                           
                           <li class="nav-item dropdown w-100 w-lg-auto">
                              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                              <ul class="dropdown-menu">
                                 <li><a class="dropdown-item" href="/login">Sign in</a></li>
                                 <li><a class="dropdown-item" href="/register">Signup</a></li>
                                 <li><a class="dropdown-item" href="/forgot-password">Forgot Password</a></li>
                               
                              </ul>
                           </li>
                           <li class="nav-item w-100 w-lg-auto">
                              <a class="nav-link" href="/dashboard">Dashboard</a>
                           </li>
                           <li class="nav-item dropdown w-100 w-lg-auto dropdown-flyout">
                              <a class="nav-link" href="#" >About Us</a>
                             
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </nav>
      </div>

     

    

      <script src="assets/js/vendors/validation.js"></script>

      @yield('content')


      <!-- Modal -->
      <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-body p-8">
                  <div class="position-absolute top-0 end-0 me-3 mt-3">
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="row">
                     <div class="col-lg-6">
                        <!-- img slide -->
                        <div class="product productModal" id="productModal">
                           <div class="zoom" onmousemove="zoom(event)" style="background-image: url(assets/images/products/product-single-img-1.jpg)">
                              <!-- img -->
                              <img src="assets/images/products/product-single-img-1.jpg" alt="" />
                           </div>
                           <div>
                              <div class="zoom" onmousemove="zoom(event)" style="background-image: url(assets/images/products/product-single-img-2.jpg)">
                                 <!-- img -->
                                 <img src="assets/images/products/product-single-img-2.jpg" alt="" />
                              </div>
                           </div>
                           <div>
                              <div class="zoom" onmousemove="zoom(event)" style="background-image: url(assets/images/products/product-single-img-3.jpg)">
                                 <!-- img -->
                                 <img src="assets/images/products/product-single-img-3.jpg" alt="" />
                              </div>
                           </div>
                           <div>
                              <div class="zoom" onmousemove="zoom(event)" style="background-image: url(assets/images/products/product-single-img-4.jpg)">
                                 <!-- img -->
                                 <img src="assets/images/products/product-single-img-4.jpg" alt="" />
                              </div>
                           </div>
                        </div>
                        <!-- product tools -->
                        <div class="product-tools">
                           <div class="thumbnails row g-3" id="productModalThumbnails">
                              <div class="col-3" class="tns-nav-active">
                                 <div class="thumbnails-img">
                                    <!-- img -->
                                    <img src="assets/images/products/product-single-img-1.jpg" alt="" />
                                 </div>
                              </div>
                              <div class="col-3">
                                 <div class="thumbnails-img">
                                    <!-- img -->
                                    <img src="assets/images/products/product-single-img-2.jpg" alt="" />
                                 </div>
                              </div>
                              <div class="col-3">
                                 <div class="thumbnails-img">
                                    <!-- img -->
                                    <img src="assets/images/products/product-single-img-3.jpg" alt="" />
                                 </div>
                              </div>
                              <div class="col-3">
                                 <div class="thumbnails-img">
                                    <!-- img -->
                                    <img src="assets/images/products/product-single-img-4.jpg" alt="" />
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="ps-lg-8 mt-6 mt-lg-0">
                           <a href="#!" class="mb-4 d-block">Bakery Biscuits</a>
                           <h2 class="mb-1 h1">Napolitanke Ljesnjak</h2>
                           <div class="mb-4">
                              <small class="text-warning">
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-half"></i>
                              </small>
                              <a href="#" class="ms-2">(30 reviews)</a>
                           </div>
                           <div class="fs-4">
                              <span class="fw-bold text-dark">$32</span>
                              <span class="text-decoration-line-through text-muted">$35</span>
                              <span><small class="fs-6 ms-2 text-danger">26% Off</small></span>
                           </div>
                           <hr class="my-6" />
                           <div class="mb-4">
                              <button type="button" class="btn btn-outline-secondary">250g</button>
                              <button type="button" class="btn btn-outline-secondary">500g</button>
                              <button type="button" class="btn btn-outline-secondary">1kg</button>
                           </div>
                           <div>
                              <!-- input -->
                              <!-- input -->
                              <div class="input-group input-spinner">
                                 <input type="button" value="-" class="button-minus btn btn-sm" data-field="quantity" />
                                 <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field form-control-sm form-input" />
                                 <input type="button" value="+" class="button-plus btn btn-sm" data-field="quantity" />
                              </div>
                           </div>
                           <div class="mt-3 row justify-content-start g-2 align-items-center">
                              <div class="col-lg-4 col-md-5 col-6 d-grid">
                                 <!-- button -->
                                 <!-- btn -->
                                 <button type="button" class="btn btn-primary">
                                    <i class="feather-icon icon-shopping-bag me-2"></i>
                                    Add to cart
                                 </button>
                              </div>
                              <div class="col-md-4 col-5">
                                 <!-- btn -->
                                 <a class="btn btn-light" href="#" data-bs-toggle="tooltip" data-bs-html="true" aria-label="Compare"><i class="bi bi-arrow-left-right"></i></a>
                                 <a class="btn btn-light" href="#!" data-bs-toggle="tooltip" data-bs-html="true" aria-label="Wishlist"><i class="feather-icon icon-heart"></i></a>
                              </div>
                           </div>
                           <hr class="my-6" />
                           <div>
                              <table class="table table-borderless">
                                 <tbody>
                                    <tr>
                                       <td>Product Code:</td>
                                       <td>FBB00255</td>
                                    </tr>
                                    <tr>
                                       <td>Availability:</td>
                                       <td>In Stock</td>
                                    </tr>
                                    <tr>
                                       <td>Type:</td>
                                       <td>Fruits</td>
                                    </tr>
                                    <tr>
                                       <td>Shipping:</td>
                                       <td>
                                          <small>
                                             01 day shipping.
                                             <span class="text-muted">( Free pickup today)</span>
                                          </small>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- footer -->
      <footer class="footer">
         <div class="container">
           
            <div class="border-top py-4">
               <div class="row align-items-center">
                  <!-- <div class="col-lg-5 text-lg-start text-center mb-2 mb-lg-0">
                     <ul class="list-inline mb-0">
                        <li class="list-inline-item text-dark">Partners Vendors</li>
                        <li class="list-inline-item">
                           <a href="#!"><img src="assets/images/payment/amazonpay.svg" alt="" /></a>
                        </li>
                        <li class="list-inline-item">
                           <a href="#!"><img src="assets/images/payment/american-express.svg" alt="" /></a>
                        </li>
                        <li class="list-inline-item">
                           <a href="#!"><img src="assets/images/payment/mastercard.svg" alt="" /></a>
                        </li>
                        <li class="list-inline-item">
                           <a href="#!"><img src="assets/images/payment/paypal.svg" alt="" /></a>
                        </li>
                        <li class="list-inline-item">
                           <a href="#!"><img src="assets/images/payment/visa.svg" alt="" /></a>
                        </li>
                     </ul>
                  </div> -->
                  <div class="col-lg-7 mt-4 mt-md-0">
                     <ul class="list-inline mb-0 text-lg-end text-center">
                        <li class="list-inline-item mb-2 mb-md-0 text-dark">Get it delivered with EasyChow</li>
                        <li class="list-inline-item ms-4">
                           <a href="/register">
                            Register As A Vendor
                        </a>
                        </li>
                        <li class="list-inline-item">
                           <a href="https://wa.me/2348101187105">
                            
                          Contact Us
                        </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="border-top py-4">
               <div class="row align-items-center">
                  <div class="col-md-6">
                     <span class="small text-muted">
                        © 
                        <span id="copyright">
                           
                           <script>
                              document.getElementById("copyright").appendChild(document.createTextNode(new Date().getFullYear()));
                           </script>
                        </span>
                        <a href="/">EasyChows</a>. All rights reserved.
                        
                     </span>
                  </div>
                  <div class="col-md-6">
                     <ul class="list-inline text-md-end mb-0 small mt-3 mt-md-0">
                        <li class="list-inline-item text-muted">Follow us on</li>
                        <li class="list-inline-item me-1">
                           <a href="#!" class="btn btn-xs btn-social btn-icon">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                 <path
                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                              </svg>
                           </a>
                        </li>
                        <li class="list-inline-item me-1">
                           <a href="#!" class="btn btn-xs btn-social btn-icon">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                 <path
                                    d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                              </svg>
                           </a>
                        </li>
                        <li class="list-inline-item">
                           <a href="#!" class="btn btn-xs btn-social btn-icon">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                 <path
                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                              </svg>
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </footer>

      <!-- Javascript-->

      <!-- Libs JS -->
      <!-- <script src="./assets/libs/jquery/dist/jquery.min.js"></script> -->
      <script src="{{url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{url('assets/libs/simplebar/dist/simplebar.min.js')}}"></script>

      <!-- Theme JS -->
      <script src="{{url('assets/js/theme.min.js')}}"></script>

      <script src="{{url('assets/js/vendors/jquery.min.js')}}"></script>
      <script src="{{url('assets/js/vendors/countdown.js')}}"></script>
      <script src="{{url('assets/libs/slick-carousel/slick/slick.min.js')}}"></script>
      <script src="{{url('assets/js/vendors/slick-slider.js')}}"></script>
      <script src="{{url('assets/libs/tiny-slider/dist/min/tiny-slider.js')}}"></script>
      <script src="{{url('assets/js/vendors/tns-slider.js')}}"></script>
      <script src="{{url('assets/js/vendors/zoom.js')}}"></script>
      @yield('script')
   </body>

</html>
