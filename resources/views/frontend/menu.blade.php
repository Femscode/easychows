@extends('frontend.master')

@section('header')

@endsection

@section('content')
<main>

   <section class="mb-lg-14 mb-8 mt-8">
      <div class="container">
         <!-- row -->
         <div class="row">
            <div class="col-12">
               <!-- card -->

               <div class="card">
                  <div class="row no-gutters">
                     <div class="col-md-4">
                        @if($rest->image !== null)

                        <img src='https://easychows.com/easychows_files/public/profilePic/{{$rest->image}}' class="card-img" style='width:100%;height:250px;border-radius:5px' class="mb-3 img-fluid lazyload" alt='vendor_pics'>

                        @else
                        <img src="{{ url('/assets/images/banner/banner2.jpg') }}" alt="Card Image">
                        @endif
                     </div>
                     <div class="col-md-8">
                        <div class="card-body">
                           <h1 class="fw-bold">{{$rest->name}}</h1>
                           <h4 class="mb-0">{{$rest->description}}</h4>
                           <a href='https://wa.me/234{{substr($rest->phone,1)}}' class='btn btn-info'>Customize Order</a>

                           <input type='hidden' id='appendmenuplate' value='1' />
                        </div>
                     </div>
                  </div>
               </div>

               <div class="card py-1 border-0 mb-8">

                  <div>

                  </div>
               </div>
            </div>
            <!-- row -->
            <div class="row">
               <div class="col-lg-8 col-md-8">
                  <div class="">
                     <!-- alert -->
                     <div class="alert alert-info p-2" role="alert">
                        Delivery is between
                        <a href="#!" class="alert-link">30 - 40 Min</a>
                     </div>
                     <ul class="list-group list-group-flush">
                        <!-- list group -->
                        @foreach($menus as $i =>$menu)
                        <li class="list-group-item ps-0">
                           <!-- row -->
                           <div class="row align-items-center">
                              <div class="col-8 col-md-8 col-lg-8">
                                 <div id='pepe{{$menu->category_id}}' class="d-flex">
                                    <div style='max-height: 100px;max-width:100px'>
                                    <img height="70px" width="100px" style="object-fit: cover; border-radius: 10px;" class="image-fluid"  src="https://easychows.com/easychows_files/public/foodimages/{{ $menu->image }}">
                                    </div>
                                    <div class="ms-3">
                                       <a href="#" class="text-inherit">
                                          <h6 class="mb-0">{{$menu->name}}</h6>
                                       </a>
                                       <span class="fw-bold">₦{{number_format($menu->price)}}</span>
                                    </div>
                                 </div>
                              </div>

                              <!-- input group -->
                              <div class="col-4 col-md-4 col-lg-4">
                                 <!-- input -->
                                 <!-- input -->

                                 <div class="input-group input-spinner">
                                    <input type="button" data-id="{{$menu->id}}" disabled id="deletefood{{ $menu->id }}" value="-" class="deletefood button-minus btn btn-md" style="font-size: 1.2rem; width: 40px; height: 40px; border-radius: 5px; background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24;" data-field="quantity" />
                                    <div id="currentfood{{$menu->id}}" value="0" class="cfood quantity-field form-control-sm form-input" style="font-size: 1.2rem; width: 40px; height: 40px; line-height: 40px; text-align: center; border: 1px solid #ced4da;">0</div>
                                    <input data-id="{{$menu->id}}" type="button" value="+" class="addmenu button-plus btn btn-md" style="font-size: 1.2rem; width: 40px; height: 40px; border-radius: 5px; background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724;" data-field="quantity" />
                                 </div>


                              </div>

                           </div>
                        </li>

                        @endforeach

                     </ul>
                     <!-- btn -->

                  </div>
               </div>

               <!-- sidebar -->
               <div class="col-12 col-lg-4 col-md-4">
                  <!-- card -->
                  <div class="mb-5 card mt-6">
                     <div class="card-body p-6">
                        <!-- heading -->
                        <h2 id='subcart' class="h5 mb-4">Order Summary</h2>

                        <div id='plate'>

                           <div class="platerow card-body pt-2">


                              <!--begin::Item-->
                              <div class="d-flex align-items-center mb-8">
                                 <!--begin::Bullet-->
                                 <span id='active1' class="allactive bullet bullet-vertical h-40px bg-danger" style='margin-right:20px'></span>
                                 <!--end::Bullet-->
                                 <!--begin::Checkbox-->

                                 <!--end::Checkbox-->
                                 <!--begin::Description-->

                                 <div class="menuplate flex-grow-1 text-gray-800 fw-bolder fs-6" data-id='1' id='dplate1' style='font-size:18px;cursor:pointer;'>
                                    Pack 1(<span id='1' data-id='1' class='plate_item m-1 cart_qty'>
                                       @if(Session::has('pack[1]'))
                                       {{ Session::get('pack[1]')}}
                                       @else
                                       0
                                       {{--
											{{session()->has('cart')?session()->get('cart')->totalQty:'0'}}
                                       --}}
                                       @endif
                                    </span>)



                                 </div>


                                 <!--end::Description-->

                              </div>

                              <!--end:Item-->
                              <!--begin::Item-->
                              @if($plate != null)


                              @for($i = 2;$i<= $plate;$i++) <div id='addedplate{{ $i }}' class="d-flex align-items-center mb-8">
                                 <span id='active{{$i}}' class="allactive bullet bullet-vertical h-40px bg-danger" style='margin-right:20px;display:none'></span>

                                 <div data-id='{{ $i }}' id='dplate{{ $i }}' class='menuplate flex-grow-1 text-gray-800 fw-bolder fs-6'>
                                    Pack {{ $i }}(<span class='plate_item m-1 cart_qty' data-id='{{ $i }}' id='{{ $i }}'>
                                       @if(Session::has('pack['.$i.']'))
                                       {{ Session::get('pack['.$i.']')}}
                                       @else
                                       0
                                       @endif
                                    </span>)
                                 </div>@if($i==$plate)
                                 <div class="mt-2 small lh-1">
                                    <a id='lastplate' data-id="{{ $i }}" style='cursor: pointer;color:red' class="deleteplate fs-8 fw-bolder">

                                       <span class="me-1 align-text-bottom">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger">
                                             <polyline points="3 6 5 6 21 6"></polyline>
                                             <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                             <line x1="10" y1="11" x2="10" y2="17"></line>
                                             <line x1="14" y1="11" x2="14" y2="17"></line>
                                          </svg>
                                       </span>
                                       <span class="text-danger">Remove</span>

                                    </a>
                                 </div>
                                 @endif
                           </div>

                           @endfor
                           @endif



                           <!--end:Item-->
                        </div>
                        <div class="d-grid mb-1 mt-4">
                           <!-- btn -->
                           <a href='/showcart' id='checkoutdesign' class="btn btn-primary btn-lg d-flex justify-content-between align-items-center" type="submit">
                              Proceed To Checkout
                              <span class="fw-bold">⇢</span>
                           </a>
                        </div>
                        <!-- text -->


                        <!-- heading -->
                        <div class="mt-8">
                           <h2 class="h5 mb-3">Manage Packs</h2>

                           <!-- btn -->
                           <div class="d-grid"><button id='addplate' type="submit" class="btn btn-outline-dark mb-1">Add New Pack</button></div>
                           <div class="d-grid"><button id='duplicatepack' type="submit" class="btn btn-outline-primary mb-1">Duplicate Pack</button></div>
                           <div class="d-grid"><button id='empty_cart' onclick='return confirm("Are you sure you want to empty cart?")' class="btn btn-outline-danger mb-1">Empty Cart</button></div>


                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
   </section>

</main>

<div class="footer py-4 d-flex flex-lg-column my-auto col-md-12 container gap-7 gap-lg-10 bg-primary" style='display:none !important;position:fixed;bottom:0;right:0px;left:0px;height:50px;color:white;text-align:center;border-radius:0px' id="kt_footer">
   <!--begin::Container-->
   <div class='container'>
      <a href='#subcart' style='font-size:20px;color:white'>
         <span class="svg-icon svg-icon-white svg-icon-2x">
            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Shopping/Cart1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
               <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <rect x="0" y="0" width="24" height="24" />
                  <path d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z" fill="#000000" opacity="0.3" />
                  <path d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z" fill="#000000" />
               </g>
            </svg>
            <!--end::Svg Icon-->
         </span>
         Checkout (
         <span id='maincart' class='text-white'>
            ₦{{number_format(session()->has('cart')?session()->get('cart')->totalPrice:'0')}}
         </span>
         )
      </a>

   </div>

</div>


@endsection

@section('script')
<script src="{{url('cdn/sweetalert.min.js')}}" crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
<script src="{{asset('cdn/jquery-3.6.0.js')}}" crossorigin="anonymous"></script>


<script>
   $(document).ready(function() {


      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });


      $('body').on('click', '.addmenu', function() {

         id = $(this).data('id');
         good = $('#appendmenuplate').val();
         ra = [id, good];
         console.log(ra);
         $.get("{{route('addToCart2')}}?data=" + ra, function(data) {
            console.log(data, 'here is the price');
            $("#maincart").text("₦" + data[1].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"))
            var nvalue = $.trim($("#currentfood" + id).text());
            console.log(nvalue, 'the very n value')
            if (!nvalue || isNaN(nvalue)) {
               rvalue = 0

            } else {
               rvalue = parseInt(nvalue)
            }
            $("#currentfood" + id).show()
            $("#currentfood" + id).text(rvalue + 1)
            $("#deletefood" + id).attr("disabled", false)
            $("#deletefood" + id).show()
            gvalue = $("#" + good).text()
            console.log(good, gvalue, 'hh g value')
            if (!gvalue) {
               $("#currentfood" + id).hide()
               $("#deletefood" + id).hide()
               pvalue = 0
            } else {
               pvalue = parseInt(gvalue)
            }
            cplate = $("#" + good).attr('id');
            cplate = $("#" + good).text(pvalue + 1);
            console.log(cplate, 'the current plate')
            sessionStorage.setItem('pack' + good, pvalue + 1);
         });
         //  $(".cfood").show()
         $("#kt_footer").show()





      });
      $('body').on('click', '.menuplate', function() {
         $(this).css('color', 'green');
         var id = $(this).data('id')

         // $(".deletefood").hide()
         $.get("{{ route('menuplate') }}?id=" + id, function(data) {
            console.log(data, 'myA data')
            $(".cfood").text('')
            //this will loop throught the returned array and check the particular quantity of the current plate
            $.each(data, function(index, value) {
               console.log(value, 'the valud daye')
               the_plates = value.plate
               console.log(the_plates, 'the plagtes')
               quantity = $.grep(the_plates, function(elem) {
                  return elem === id
               }).length;
               console.log(quantity, 'the auw', value.id, 'the value id')
               $("#currentfood" + value.id).text(quantity);
               $("#currentfood" + value.id).show();
               $("#deletefood" + value.id).show();

            });


         })
         $("#appendmenuplate").val(id);
         $(".allactive").hide()

         $("#active" + id).show();

         // $(".cfood").show()

      })
      $('body').on('click', '.deleteplate', function() {
         $(".cfood").hide()

         var id = $(this).data('id');
         id2 = id - 1

         $.get("{{ route('deleteplate') }}?id=" + id, function(data) {

            console.log(data, id, 'the data gotten is here');
            $("#maincart").text("₦" + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"))
            $("#addedplate" + id).remove()
            $("#addedplate" + id2).append(`

 <div class="mt-2 small lh-1">
                                         <a id="lastplate" data-id="${id2}" style="color:red;cursor:pointer" class="deleteplate fs-8 fw-bolder">
                                             <span class="me-1 align-text-bottom">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger">
                                                   <polyline points="3 6 5 6 21 6"></polyline>
                                                   <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                   <line x1="10" y1="11" x2="10" y2="17"></line>
                                                   <line x1="14" y1="11" x2="14" y2="17"></line>
                                                </svg>
                                             </span>
                                             <span class="text-danger">Remove</span>
                                          </a>
                                       </div>

					`)
            // $("#ddel"+id).remove()
            console.log(id2, 'the second id')
            $(".allactive").hide()
            $(".deletefood").attr('disabled', true)
            $("#active" + id2).show()
            $('#appendmenuplate').val(id2);
         })
         //this will get the value of the previous plate and populate the quantity of food of the previous plates
         $.get("{{ route('menuplate') }}?id=" + id2, function(data) {
            console.log(data, 'myA data')
            $(".cfood").text('')
            //this will loop throught the returned array and check the particular quantity of the current plate
            $.each(data, function(index, value) {
               console.log(value, 'the valud daye')
               the_plates = value.plate
               console.log(the_plates, 'the plagtes')
               quantity = $.grep(the_plates, function(elem) {
                  return elem === id2
               }).length;
               console.log(quantity, 'the auw', value.id, 'the value id of deleted')
               $("#currentfood" + value.id).text(quantity);
               $("#deletefood" + value.id).attr('disabled', false)
            });
         })
         $(".cfood").show()



      })

      $('body').on('click', '#addplate', function() {

         var id = $("#plate .plate_item").last().attr('id');
         rid = parseInt(id) + 1;

         $(".deletefood").hide()
         // alert(id)
         if (rid == 16) {
            Swal.fire("Opps", "Sorry, you cannot add more than 15 plates", 'error')
         } else {

            $(".cfood").text('')
            $.get("{{route('addPlate')}}", function(data) {
               console.log(data, rid, 'the data');
            });
            $("#lastplate").hide()
            $("#lastplate").attr('id', 'previousplate')
            $(".allactive").hide()
            $(".platerow").append(`
				<div id='addedplate${rid}' class="d-flex align-items-center mb-8">
																	
					<span id='active${rid}'
						class="allactive bullet bullet-vertical h-40px bg-danger" style='margin-right:20px'></span>
					
					
					
					<div class="menuplate flex-grow-1 text-gray-800 fw-bolder fs-6"
						data-id='${rid}' id='dplate${rid}'>
						Pack ${rid}(<span id='${rid}' data-id='${rid}'
							class='plate_item m-1 cart_qty'>
							@if(Session::has('pack[${rid}]'))
							{{ Session::get('pack[${rid}]')}}
							@else
							0
							@endif
						</span>)
					</div>

               <div class="mt-2 small lh-1">
                                            
					<a id="lastplate" data-id="${rid}" style='cursor:pointer;color:red'
						class="deleteplate fs-8 fw-bolder">
                                             <span class="me-1 align-text-bottom">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger">
                                                   <polyline points="3 6 5 6 21 6"></polyline>
                                                   <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                   <line x1="10" y1="11" x2="10" y2="17"></line>
                                                   <line x1="14" y1="11" x2="14" y2="17"></line>
                                                </svg>
                                             </span>
                                             <span class="text-danger">Remove</span>
                                          </a>
                                       </div>
           


				</div>
				`)
            $('#appendmenuplate').val(rid);
         }
      })

      $('body').on('click', '#duplicatepack', function() {

         var id = $("#plate .plate_item").last().attr('id');
         rid = parseInt(id) + 1;
         r_session = $(".plate_item").last().text()

         // 			$(".deletefood").attr('disabled',true)
         // alert(id)
         if (rid == 16) {
            Swal.fire("Opps", "Sorry, you cannot add more than 15 plates", 'error')
         } else {

            // $(".cfood").text('')
            $.get("{{route('multiplyplate')}}?current=" + rid, function(data) {
               console.log(data, rid, 'the data');
               $("#maincart").text("₦" + data[1].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"))

            });
            $("#lastplate").hide()
            $("#lastplate").attr('id', 'previousplate')
            $(".allactive").hide()
            $(".platerow").append(`
				<div id='addedplate${rid}' class="d-flex align-items-center mb-8">
																	
					<span id='active${rid}'
						class="allactive bullet bullet-vertical h-40px bg-danger" style='margin-right:20px'></span>
					
					
					
					<div class="menuplate flex-grow-1 text-gray-800 fw-bolder fs-6"
						data-id='${rid}' id='dplate${rid}'>
						Pack ${rid}(<span id='${rid}' data-id='${rid}'
							class='plate_item m-1 cart_qty'>
							${r_session}
						</span>)
					</div>

<div class="mt-2 small lh-1">
                                            
					<a id="lastplate" data-id="${rid}" style="color:red;cursor:pointer"
						class="deleteplate fs-8 fw-bolder">
                                             <span class="me-1 align-text-bottom">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger">
                                                   <polyline points="3 6 5 6 21 6"></polyline>
                                                   <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                   <line x1="10" y1="11" x2="10" y2="17"></line>
                                                   <line x1="14" y1="11" x2="14" y2="17"></line>
                                                </svg>
                                             </span>
                                             <span class="text-danger">Remove</span>
                                          </a>
                                       </div>
					


				</div>
				`)
            $('#appendmenuplate').val(rid);
         }
      })

      $('body').on('click', '.deletefood', function() {
         var id = $(this).data('id')
         qty = parseInt($("#currentfood" + id).text());
         plate = parseInt($("#appendmenuplate").val());
         console.log(id, 'the id', qty, 'the qty', plate, 'the plate')
         value = [id, qty, plate]
         $.get("{{ route('removeMenu2') }}?value=" + value, function(data) {
            console.log(data)

            if ($("#currentfood" + id).text() == 1) {
               // $("#deletefood" + id).hide()
               // $("#currentfood" + id).hide()
               $("#maincart").text("₦" + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));

               var nvalue = $("#currentfood" + id).text();
               rvalue = parseInt(nvalue)
               console.log(rvalue, 'the n value')
               $("#currentfood" + id).empty()
               // $("#currentfood" + id).text(rvalue - 1)

               gvalue = $("#" + plate).text()
               console.log(plate, gvalue, 'hh g value')
               if (!gvalue) {
                  pvalue = 0
               } else {
                  pvalue = parseInt(gvalue)
               }
               cplate = $("#" + plate).attr('id');
               cplate = $("#" + plate).text(pvalue - 1);
               console.log(cplate, 'the current plate')
               sessionStorage.setItem('pack' + plate, pvalue - 1);

            } else {
               $("#maincart").text("₦" + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));

               var nvalue = $("#currentfood" + id).text();
               rvalue = parseInt(nvalue)
               console.log(rvalue, 'the n value')
               $("#currentfood" + id).text(rvalue - 1)

               gvalue = $("#" + plate).text()
               console.log(plate, gvalue, 'hh g value')
               if (!gvalue) {
                  pvalue = 0
               } else {
                  pvalue = parseInt(gvalue)
               }
               cplate = $("#" + plate).attr('id');
               cplate = $("#" + plate).text(pvalue - 1);
               console.log(cplate, 'the current plate')
               sessionStorage.setItem('pack' + plate, pvalue - 1);
            }


         });



      })
      @if(session('message'))
      Swal.fire("{{ session('message') }}");
      @endif
      $("#empty_cart").click(function() {
         $.get("{{ route('cancelcart') }}", function(data) {
            console.log(data)
            window.location.reload()
         })
      })

   })
</script>
{{-- <script src="{{asset('cdn/jquery-slim.js')}}" crossorigin="anonymous"></script> --}}
<script src="{{asset('cdn/popper.js')}}" crossorigin="anonymous"></script>
<script src="{{asset('cdn/bootstrap.js')}}" crossorigin="anonymous"></script>
<script src='/assets/js/professionallocker.js'></script>
<script>
   $("#r_review").on('click', function() {
      Swal.fire('Opps', 'There are no reviews for this restaurant yet, want to drop one?', 'info')
   })
</script>


@endsection