@extends('layouts.app')

@section('content')
<div class="card">
<div class="card-body row mb-2">
    <div class="col-sm-6">
        <h4>Role Management</h4>
    </div>
    <div class="col-sm-6">
        <div class="float-right">
        @can('role-create')
        <a class="btn btn-primary" href="{{ route('roles.create') }}"> Create New Role </a>
        @endcan
        </div>
    </div>
    </div>
</div>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="col-lg-12">
    <div class="card">
      <div class="card-body pt-2">
        <table id="rolestable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Sno.</th>
              <th>Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
{{-- <table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>

{!! $roles->render() !!} --}}

@endsection