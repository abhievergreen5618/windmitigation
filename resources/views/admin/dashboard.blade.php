@php
use App\Models\User;
use App\Models\RequestModel;
use Illuminate\Support\Facades\DB;

$total_inpspector= User::role('inspector')->count();
$total_agency=user::role('company')->count();

$total_pending_request=RequestModel::where('status','pending')->count();
$total_assigned_request=RequestModel::where('status','assigned')->count();
$total_underreview_request=RequestModel::where('status','underreview')->count();
$total_completed_request=RequestModel::where('status','completed')->count();

@endphp
@extends('layouts.app')
@section("content")

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard </li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-gradient-purple">
          <div class="inner">
            <h3>{{ $total_inpspector }}</h3>
            <p>Total Inspector</p>
          </div>
          <a href="{{route('admin.view.inspector')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-gradient-indigo">
          <div class="inner">
            <h3>{{ $total_agency }}</h3>
            <p>Total Agency</p>
          </div>
          <a href="{{route('admin.agency.agency-view')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner text-white">
            <h3>{{ $total_pending_request }}</h3>
            <p>Inspection Requests Received</p>
          </div>
          <a href="#" class="small-box-footer text-center">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $total_assigned_request }}</h3>
            <p>Inspection Requests Assigned</p>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{$total_underreview_request }}</h3>
            <p>Completed Inspections For Review</p>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

       <!-- ./col -->
       <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$total_completed_request }}</h3>
            <p>Completed & Delivered Inspections</p>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
       <!-- ./col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
