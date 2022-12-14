@push('header_extras')
<style>
    .others {
        margin-left: 10px !important;
    }

    .profile-pic {
        color: transparent;
        transition: all 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        transition: all 0.3s ease;
    }

    .profile-pic input {
        display: none;
    }

    .profile-pic img {
        position: absolute;
        object-fit: cover;
        width: 165px;
        height: 165px;
        box-shadow: 0 0 10px 0 rgba(255, 255, 255, .35);
        border-radius: 100px;
        z-index: 0;
    }

    .profile-pic .-label {
        cursor: pointer;
        height: 165px;
        width: 165px;
    }

    .profile-pic:hover .-label {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, .8);
        z-index: 10000;
        color: #fafafa;
        transition: background-color 0.2s ease-in-out;
        border-radius: 100px;
        margin-bottom: 0;
    }

    .profile-pic span {
        display: inline-flex;
        padding: 0.2em;
        height: 2em;
    }
</style>
@endpush
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Website Email Template Configuration') }}</h3>
        </div>
    </div>
</div>
<!--Email verfication Template -->
<div class="col-lg-12">
    <div class="card card-danger collapsed-card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Email Verification Template') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body" style="display: none;">

            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Attributes</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" value="[first_name]" disabled>
                           </div>
                        </div>

                    </div>

                </div>

                <div class="col-md-9">
                    <form action="{{route('admin.portal.emailVerify')}}" method='POST'  enctype="multipart/form-data">
                    @csrf
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="card-title">{{__('Edit Email Template')}}</div>
                        </div>
                        <div class="card-body">
                         <div class="form-group">
                         <textarea id="textarea-summernote" class="form-control summernote" style="height: 700px" name="verification_message">{{$data['verification_message']}}</textarea>
                         </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Assigned Email Template -->
<div class="col-lg-12">
    <div class="card card-lightblue collapsed-card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Requests Assign Email Template') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body" style="display: none;">

            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Attributes</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                           <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" value="[first_name]" disabled>
                           </div>
                           <div class="form-group">
                            <label>Assigned Inspector</label>
                            <input type="text" class="form-control" value="[inspector_name]" disabled>
                           </div>
                           <div class="form-group">
                            <label>Company</label>
                            <input type="text" class="form-control" value="[company_name]" disabled>
                           </div>
                           <div class="form-group">
                            <label>Company Location</label>
                            <input type="text" class="form-control" value="[company_location]" disabled>
                           </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-9">
                    <form action="{{route('admin.portal.emailAssign')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="card-title">{{__('Edit Email Template')}}</div>
                        </div>
                        <div class="card-body">
                         <div class="form-group">
                         <textarea id="textarea-summernote" class="form-control summernote" style="height: 700px" name="requestassign_message">{{$data['requestassign_message']}}</textarea>
                         </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Scheduled Email Template -->
<div class="col-lg-12">
    <div class="card card-info collapsed-card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Requests Scheduled Email Template') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body" style="display: none;">

            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Attributes</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" value="[first_name]" disabled>
                           </div>
                           <div class="form-group">
                            <label>Assigned Inspector</label>
                            <input type="text" class="form-control" value="[inspector_name]" disabled>
                           </div>
                           <div class="form-group">
                            <label>Company</label>
                            <input type="text" class="form-control" value="[company_name]" disabled>
                           </div>
                           <div class="form-group">
                            <label>Company Location</label>
                            <input type="text" class="form-control" value="[company_location]" disabled>
                           </div>
                        </div>

                    </div>

                </div>

                <div class="col-md-9">
                    <form action="{{route('admin.portal.emailScheduled')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="card-title">{{__('Edit Email Template')}}</div>
                        </div>
                        <div class="card-body">
                         <div class="form-group">
                         <textarea id="textarea-summernote" class="form-control summernote" style="height: 700px" name="requestscheduled_message">{{$data['requestscheduled_message']}}</textarea>
                         </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!--Underreview Request Template -->
<div class="col-lg-12">
    <div class="card card-secondary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Requests Review Email Template') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body" style="display: none;">

            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Attributes</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" value="[first_name]" disabled>
                           </div>
                           <div class="form-group">
                            <label>Assigned Inspector</label>
                            <input type="text" class="form-control" value="[inspector_name]" disabled>
                           </div>
                           <div class="form-group">
                            <label>Company</label>
                            <input type="text" class="form-control" value="[company_name]" disabled>
                           </div>
                           <div class="form-group">
                            <label>Company Location</label>
                            <input type="text" class="form-control" value="[company_location]" disabled>
                           </div>
                        </div>

                    </div>

                </div>

                <div class="col-md-9">
                    <form action="{{route('admin.portal.emailUnderreview')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="card-title">{{__('Edit Email Template')}}</div>
                        </div>
                        <div class="card-body">
                         <div class="form-group">
                         <textarea id="textarea-summernote" class="form-control summernote" style="height: 700px" name="requestunderreview_message">{{$data['requestunderreview_message']}}</textarea>
                         </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!--Completed Request Template -->
<div class="col-lg-12">
    <div class="card card-success collapsed-card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Requests Completed Email Template') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body" style="display: none;">

            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Attributes</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" value="[first_name]" disabled>
                           </div>
                           <div class="form-group">
                            <label>Assigned Inspector</label>
                            <input type="text" class="form-control" value="[inspector_name]" disabled>
                           </div>
                           <div class="form-group">
                            <label>Company</label>
                            <input type="text" class="form-control" value="[company_name]" disabled>
                           </div>
                           <div class="form-group">
                            <label>Company Location</label>
                            <input type="text" class="form-control" value="[company_location]" disabled>
                           </div>
                        </div>

                    </div>

                </div>

                <div class="col-md-9">
                    <form action="{{route('admin.portal.emailCompleted')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="card-title">{{__('Edit Email Template')}}</div>
                        </div>
                        <div class="card-body">
                         <div class="form-group">
                         <textarea id="textarea-summernote" class="form-control summernote" style="height: 700px" name="requestcompleted_message">{{$data['requestcompleted_message']}}</textarea>
                         </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('footer_extras')
<script>
 $('.summernote').summernote();
</script>
@endpush