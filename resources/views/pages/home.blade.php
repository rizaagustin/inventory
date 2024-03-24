@extends('layouts.dashboard')
@section('content')

<section class="content">
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Product</span>
            <span class="info-box-number" style="font-size: 30px">{{ $product }}</span>
        </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-truck"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Transaction IN</span>
            <span class="info-box-number" style="font-size: 30px">{{ $productin }}</span>
        </div>

        </div>

    </div>

    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-truck"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Transaction Out</span>
            <span class="info-box-number" style="font-size: 30px">{{ $productout }}</span>
        </div>

        </div>

    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Users</span>
            <span class="info-box-number" style="font-size: 30px">{{ $user }}</span>
        </div>

        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Transaction In</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Date</th>
                  <th>Product</th>
                  <th style="width: 40px">Qty</th>
                </tr>
                @foreach ($productindetails as $i => $productindetail)
                <tr>
                  <td>{{ $i + 1 }}</td>
                  <td>{{ $productindetail->productin->date }}</td>
                  <td>{{ $productindetail->product->name }}</td>
                  <td class="text-right"><span class="badge bg-blue">{{ $productindetail->qty }}</span></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Transaction Out</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>Date</th>
                  <th>Product</th>
                  <th style="width: 40px">Qty</th>
                </tr>
                @foreach ($productoutdetails as $i => $productoutdetail)
                <tr>
                  <td>{{ $i + 1 }}</td>
                  <td>{{ $productoutdetail->productout->date }}</td>
                  <td>{{ $productoutdetail->product->name }}</td>
                  <td class="text-right"><span class="badge bg-red">{{ $productoutdetail->qty }}</span></td>
                </tr>                    
                @endforeach
              </tbody>
            </table>
            </div>
        </div>
    </div>

</div>
</section>    
@endsection