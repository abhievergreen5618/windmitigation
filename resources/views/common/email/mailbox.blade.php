@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Inbox</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Inbox</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-3">
      @include('common.email.sidebar')
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">Inbox</h3>

          <!-- <div class="card-tools">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" placeholder="Search Mail">
              <div class="input-group-append">
                <div class="btn btn-primary">
                  <i class="fas fa-search"></i>
                </div>
              </div>
            </div>
          </div> -->
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <!-- <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
            </button> -->
            <!-- <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm">
                <i class="far fa-trash-alt"></i>
              </button>
              <button type="button" class="btn btn-default btn-sm">
                <i class="fas fa-reply"></i>
              </button>
              <button type="button" class="btn btn-default btn-sm">
                <i class="fas fa-share"></i>
              </button>
            </div> -->
            <!-- /.btn-group -->
            <!-- <button type="button" class="btn btn-default btn-sm">
              <i class="fas fa-sync-alt"></i>
            </button> -->
            <!-- <div class="float-right"> -->
              <!-- 1-{{isset($sent) ? $sentmailcount : $draftmailcount}}/{{isset($sent) ? $sentmailcount : $draftmailcount}} -->
              <!-- <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-chevron-right"></i>
                </button>
              </div> -->
              <!-- /.btn-group -->
            <!-- </div> -->
            <!-- /.float-right -->
          </div>
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tbody>
                @forelse($sentmail as $value)
                <tr>
                  <!-- <td>
                    <div class="icheck-primary">
                      <input type="checkbox" value="" id="check1">
                      <label for="check1"></label>
                    </div>
                  </td> -->
                  <!-- <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td> -->
                  <td class="mailbox-name"><a href="{{route('mailbox.readmail',['id'=>encrypt($value->id)])}}">
                    @php
                    if(!empty($value->mailto))
                    {
                      echo implode(',',$value->mailto);
                    }
                    else
                    {
                       echo "empty";
                    }
                    @endphp
                  </a></td>
                  <td class="mailbox-subject">{{(!empty($value->subject) ? $value->subject : 'No Subject' )}}</td>
                  <td class="mailbox-attachment">@if(!empty($value->attachments))<i class="fas fa-paperclip"></i>@endif</td>
                  <td class="mailbox-date">{{$value->updated_at->diffForHumans()}}</td>
                </tr>
                @empty
                <tr>
                  <td class="text-center"><b class="fs-5">No Mail Founded</b></td>
                </tr>
                @endforelse
              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer p-0">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <!-- <button type="button" class="btn btn-default btn-sm checkbox-toggle">
              <i class="far fa-square"></i>
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm">
                <i class="far fa-trash-alt"></i>
              </button>
              <button type="button" class="btn btn-default btn-sm">
                <i class="fas fa-reply"></i>
              </button>
              <button type="button" class="btn btn-default btn-sm">
                <i class="fas fa-share"></i>
              </button> -->
            <!-- </div> -->
            <!-- /.btn-group -->
            <!-- <button type="button" class="btn btn-default btn-sm">
              <i class="fas fa-sync-alt"></i>
            </button> -->
            <!-- <div class="float-right">
                1-{{isset($sent) ? $sentmailcount : $draftmailcount}}/{{isset($sent) ? $sentmailcount : $draftmailcount}}
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-chevron-right"></i>
                </button>
              </div>
              /.btn-group
            </div> -->
            <!-- /.float-right -->
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

@endsection