@extends('newdashboard.master')
@section('header')
@endsection
@section('content')


<div class="container-fluid">



    <div class="row">
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->

                    <!--end::Search-->
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <!--begin::Flatpickr-->
                    <div class='d-flex'>
                        <div class="input-group w-250px">

                            <h4>{{ $user->name }} Wallet Balance (<span id='total_order'>NGN{{ number_format($user->balance,2)}}</span>)
                            </h4>
                        </div>
                    </div>
                    <!--end::Flatpickr-->

                    <!--begin::Add product-->
                    <!--<a href="../catalog/add-product.html" class="btn btn-primary">Add Order</a>-->
                    <!--end::Add product-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                @if(Session::has('message'))
                <div class='alert alert-danger'> {{ Session::get('message') }}</div>

                @endif
              <form method='post' action='/manual_withdraw'>@csrf 
                <label>Amount To Withdraw</label>
                <input type='hidden' name='user_id' value='{{ $user->id }}'/>
                <input type='number' name='amount' class='form-control'/>
                <input type='submit' value='Withdraw Funds' class='btn btn-success'/>
              </form>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>

    </div>
</div>
<!-- end row -->



<!-- end row -->
</div>
@section('script')

@endsection
@endsection