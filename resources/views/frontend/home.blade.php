@extends('frontend.master')

@section('header')

@endsection

@section('content')
<main>
   <section class="mt-8">
      <div class="container">
         <div class="hero-slider">
            <div style="background: url(assets/images/banner/suprisebanner.jpg) no-repeat; background-size: cover; border-radius: 0.5rem; background-position: center">
               <div class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center">
                  
                  <h2 style='background-color: rgba(255, 193, 7, 0.5) !important;' class=" text-bg-warning text-dark display-5 fw-bold mt-4">EasyChows For Everyone</h2>
                  <p class="badge text-bg-warning">From The Kitchen - To Your Doorstep.</p><br>
                  <a href="#!" class="btn btn-dark mt-3">
                     Order Now
                     <i class="feather-icon icon-arrow-right ms-1"></i>
                  </a>
               </div>
            </div>
            <div style="background: url(assets/images/banner/suprisebanner.jpg) no-repeat; background-size: cover; border-radius: 0.5rem; background-position: center">
               <div class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center">
                 <h2 style='background-color: rgba(225,193, 7, 0.5) !important;' class=" text-bg-warning text-dark display-5 fw-bold mt-4">
                     Get Your Food In
                     <span class="text-primary">Zero</span> Minute
                  </h2>
                  <p class="badge text-bg-warning">Got a craving? We deliver it in a matter of seconds!</p>
                  <a href="#!" class="btn btn-dark mt-3">
                     Order Now
                     <i class="feather-icon icon-arrow-right ms-1"></i>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </section>

   <!-- Popular Products Start-->
   <section class="my-lg-14 my-8">
      <div class="container">
         <div class="row">
            <div class="col-12 mb-6">
               <h3 class="mb-0">Available Vendors</h3>
            </div>
         </div>

         <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3">
            @foreach($restaurants as $rest)
            @if ($rest->isOpenNow(now()->format("H:i:s")) == 1)
            <div class="col">
               <div class="card card-product">
                  <div class="card-body">
                     <div class="text-center position-relative">
                        <div class="position-absolute top-0 start-0">
                           <span class="badge bg-success">Open</span>
                        </div>
                        <a href='/{{$rest->slug}}'>
                           @if($rest->image !== null)

                           <img src='https://easychows.com/easychows_files/public/profilePic/{{$rest->image}}' style='width:350px;height:120px;border-radius:5px' class="mb-3 img-fluid lazyload" width='300px' height='150px' alt='vendor_pics'>

                           @else
                           <img src="{{ asset('profilePic/normal.webp') }}" class="mb-3 img-fluid lazyload" style='width:350px;height:120px;border-radius:5px' width='300px' height='150px' alt='vendor_image' />
                           @endif


                        </a>


                     </div>
                     <div class="text-small mb-1">
                        <a href="#!" class="text-decoration-none text-muted"><small>{{$rest->description }}</small></a>
                     </div>
                     <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                           <h2 class="fs-6"><a href="pages/shop-single.html" class="text-inherit text-decoration-none">{{$rest->name}}</a></h2>
                           <div>
                              <small class="text-warning">
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-half"></i>
                              </small>

                           </div>
                        </div>

                        <div>
                           <a href='/{{$rest->slug}}' class="btn btn-primary btn-sm">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                 <line x1="12" y1="5" x2="12" y2="19"></line>
                                 <line x1="5" y1="12" x2="19" y2="12"></line>
                              </svg>
                              Order
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            @else 
            <div class="col">
               <div class="card card-product">
                  <div class="card-body">
                     <div class="text-center position-relative">
                        <div class="position-absolute top-0 start-0">
                           <span class="badge bg-secondary">Closed</span>
                        </div>
                        <a href=''>
                           @if($rest->image !== null)

                           <img src='https://easychows.com/easychows_files/public/profilePic/{{$rest->image}}' style='width:350px;height:120px;border-radius:5px;opacity:0.5' class="mb-3 img-fluid lazyload" width='300px' height='150px' alt='vendor_pics'>

                           @else
                           <img src="{{ asset('profilePic/normal.webp') }}" class="mb-3 img-fluid lazyload" style='width:350px;height:120px;border-radius:5px;opacity:0.5' width='300px' height='150px' alt='vendor_image' />
                           @endif

                           <div class='order-title lazyload'
									style='color:#fff;font-size:30px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);text-shadow:1px 1px 1px #856404'>
									CLOSED
								</div>

                        </a>


                     </div>
                     <div class="text-small mb-1">
                        <a href="" class="text-decoration-none text-muted"><small>{{$rest->description }}</small></a>
                     </div>
                     <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                           <h2 class="fs-6"><a href="pages/shop-single.html" class="text-inherit text-decoration-none">{{$rest->name}}</a></h2>
                           <div>
                              <small class="text-warning">
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-half"></i>
                              </small>

                           </div>
                        </div>

                        <div>
                           <a  class="btn btn-secondary btn-sm">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                 <line x1="12" y1="5" x2="12" y2="19"></line>
                                 <line x1="5" y1="12" x2="19" y2="12"></line>
                              </svg>
                              Closed
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            @endif
            @endforeach

         </div>
      </div>
   </section>


   <section>
      <div class="container">
         <div class="row">
            <div class="col-12 col-md-6 mb-3 mb-lg-0">
               <div>
                  <div class="py-10 px-8 rounded" style="background: url(assets/images/banner/grocery-banner.png) no-repeat; background-size: cover; background-position: center">
                     <div>
                        <h3 class="fw-bold mb-1">Fruits & Vegetables</h3>
                        <p class="mb-4">
                           Get Upto
                           <span class="fw-bold">30%</span>
                           Off
                        </p>
                        <a href="#!" class="btn btn-dark">Order Now</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div>
                  <div class="py-10 px-8 rounded" style="background: url(assets/images/banner/grocery-banner-2.jpg) no-repeat; background-size: cover; background-position: center">
                     <div>
                        <h3 class="fw-bold mb-1">Freshly Baked Buns</h3>
                        <p class="mb-4">
                           Get Upto
                           <span class="fw-bold">25%</span>
                           Off
                        </p>
                        <a href="#!" class="btn btn-dark">Order Now</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Popular Products End-->
   <!-- <section>
      <div class="container">
         <div class="row">
            <div class="col-md-12 mb-6">
               <h3 class="mb-0">Daily Best Sells</h3>
            </div>
         </div>
         <div class="table-responsive-lg pb-6">
            <div class="row row-cols-lg-4 row-cols-1 row-cols-md-2 g-4 flex-nowrap">
               <div class="col">
                  <div class="pt-8 px-6 px-xl-8 rounded" style="background: url(assets/images/banner/banner-deal.jpg) no-repeat; background-size: cover; height: 470px">
                     <div>
                        <h3 class="fw-bold text-white">100% Organic Coffee Beans.</h3>
                        <p class="text-white">Get the best deal before close.</p>
                        <a href="#!" class="btn btn-primary">
                           Shop Now
                           <i class="feather-icon icon-arrow-right ms-1"></i>
                        </a>
                     </div>
                  </div>
               </div>
               <div class="col">
                  <div class="card card-product">
                     <div class="card-body">
                        <div class="text-center position-relative">
                           <a href="pages/shop-single.html"><img src="assets/images/products/product-img-11.jpg" alt="Grocery Ecommerce Template" class="mb-3 img-fluid" /></a>

                           <div class="card-product-action">
                              <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                 <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"></i>
                              </a>
                              <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Wishlist"><i class="bi bi-heart"></i></a>
                              <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Compare"><i class="bi bi-arrow-left-right"></i></a>
                           </div>
                        </div>
                        <div class="text-small mb-1">
                           <a href="#!" class="text-decoration-none text-muted"><small>Tea, Coffee & Drinks</small></a>
                        </div>
                        <h2 class="fs-6"><a href="pages/shop-single.html" class="text-inherit text-decoration-none">Roast Ground Coffee</a></h2>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                           <div>
                              <span class="text-dark">$13</span>
                              <span class="text-decoration-line-through text-muted">$18</span>
                           </div>
                           <div>
                              <small class="text-warning">
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-half"></i>
                              </small>
                              <span><small>4.5</small></span>
                           </div>
                        </div>
                        <div class="d-grid mt-2">
                           <a href="#!" class="btn btn-primary">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                 <line x1="12" y1="5" x2="12" y2="19"></line>
                                 <line x1="5" y1="12" x2="19" y2="12"></line>
                              </svg>
                              Add to cart
                           </a>
                        </div>
                        <div class="d-flex justify-content-start text-center mt-3">
                           <div class="deals-countdown w-100" data-countdown="2028/10/10 00:00:00"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col">
                  <div class="card card-product">
                     <div class="card-body">
                        <div class="text-center position-relative">
                           <a href="pages/shop-single.html"><img src="assets/images/products/product-img-12.jpg" alt="Grocery Ecommerce Template" class="mb-3 img-fluid" /></a>
                           <div class="card-product-action">
                              <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                 <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"></i>
                              </a>
                              <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Wishlist"><i class="bi bi-heart"></i></a>
                              <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Compare"><i class="bi bi-arrow-left-right"></i></a>
                           </div>
                        </div>
                        <div class="text-small mb-1">
                           <a href="#!" class="text-decoration-none text-muted"><small>Fruits & Vegetables</small></a>
                        </div>
                        <h2 class="fs-6"><a href="pages/shop-single.html" class="text-inherit text-decoration-none">Crushed Tomatoes</a></h2>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                           <div>
                              <span class="text-dark">$13</span>
                              <span class="text-decoration-line-through text-muted">$18</span>
                           </div>
                           <div>
                              <small class="text-warning">
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-half"></i>
                              </small>
                              <span><small>4.5</small></span>
                           </div>
                        </div>
                        <div class="d-grid mt-2">
                           <a href="#!" class="btn btn-primary">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                 <line x1="12" y1="5" x2="12" y2="19"></line>
                                 <line x1="5" y1="12" x2="19" y2="12"></line>
                              </svg>
                              Add to cart
                           </a>
                        </div>
                        <div class="d-flex justify-content-start text-center mt-3 w-100">
                           <div class="deals-countdown w-100" data-countdown="2028/12/9 00:00:00"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col">
                  <div class="card card-product">
                     <div class="card-body">
                        <div class="text-center position-relative">
                           <a href="pages/shop-single.html"><img src="assets/images/products/product-img-13.jpg" alt="Grocery Ecommerce Template" class="mb-3 img-fluid" /></a>
                           <div class="card-product-action">
                              <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                 <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"></i>
                              </a>
                              <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Wishlist"><i class="bi bi-heart"></i></a>
                              <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Compare"><i class="bi bi-arrow-left-right"></i></a>
                           </div>
                        </div>
                        <div class="text-small mb-1">
                           <a href="#!" class="text-decoration-none text-muted"><small>Fruits & Vegetables</small></a>
                        </div>
                        <h2 class="fs-6"><a href="pages/shop-single.html" class="text-inherit text-decoration-none">Golden Pineapple</a></h2>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                           <div>
                              <span class="text-dark">$13</span>
                              <span class="text-decoration-line-through text-muted">$18</span>
                           </div>
                           <div>
                              <small class="text-warning">
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-fill"></i>
                                 <i class="bi bi-star-half"></i>
                              </small>
                              <span><small>4.5</small></span>
                           </div>
                        </div>
                        <div class="d-grid mt-2">
                           <a href="#!" class="btn btn-primary">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                 <line x1="12" y1="5" x2="12" y2="19"></line>
                                 <line x1="5" y1="12" x2="19" y2="12"></line>
                              </svg>
                              Add to cart
                           </a>
                        </div>
                        <div class="d-flex justify-content-start text-center mt-3">
                           <div class="deals-countdown w-100" data-countdown="2028/11/11 00:00:00"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section> -->
   <!-- <section class="my-lg-14 my-8">
      <div class="container">
         <div class="row">
            <div class="col-md-6 col-lg-3">
               <div class="mb-8 mb-xl-0">
                  <div class="mb-6"><img src="assets/images/icons/clock.svg" alt="" /></div>
                  <h3 class="h5 mb-3">10 minute delivery time</h3>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="mb-8 mb-xl-0">
                  <div class="mb-6"><img src="assets/images/icons/gift.svg" alt="" /></div>
                  <h3 class="h5 mb-3">Best Prices & Offers</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="mb-8 mb-xl-0">
                  <div class="mb-6"><img src="assets/images/icons/package.svg" alt="" /></div>
                  <h3 class="h5 mb-3">Wide Menu List</h3>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="mb-8 mb-xl-0">
                  <div class="mb-6"><img src="assets/images/icons/refresh-cw.svg" alt="" /></div>
                  <h3 class="h5 mb-3">Easy Ordering</h3>
                 
               </div>
            </div>
         </div>
      </div>
   </section> -->
</main>


@endsection

@section('script')

@endsection