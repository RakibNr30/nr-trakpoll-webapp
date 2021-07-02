@extends('backend.layouts.master')

@section('title')
    Role Edit Page | Admin Dashboard
@endsection

@section('styles')
<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Role Edit - {{ $role->name }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Role </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- form start -->
            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                @method('PUT')
                @csrf
            <div class="card-body">
                <div class="form-group">
                <label for="exampleInputEmail1">Role Name</label>
                <input type="text" name="name" value="{{ $role->name }}" class="form-control" id="exampleInputEmail1" placeholder="Enter Role Name">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Permissions</label>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkpermissionAll" value="1" {{ \App\Models\User::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }}>
                        <label class="form-check-label" for="checkPermissionAll">All</label>
                    </div>
                    <hr>
                    @php   $i = 1;     @endphp
                    @foreach ($permission_groups as $group)
                        <div class="row mt-3">
                            @php
                                $permissions = \App\Models\User::getpermissionsByGroupName($group->name);
                                $j = 1;
                            @endphp
                            <div class="col-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" {{ \App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="checkpermission">{{ $group->name }}</label>
                                </div>
                            </div>
                            <div class="col-9 role-{{ $i }}-management-checkbox">

                                @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})" name="permissions[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                    <label class="form-check-label" for="checkpermission{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                                @php   $j++;     @endphp
                                @endforeach
                            </div>
                        </div>
                        @php   $i++;     @endphp
                    @endforeach
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Role</button>
            </div>
            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

</div>
<!-- /.content-wrapper -->

@endsection

@section('scripts')
    @include('backend.pages.roles.partials.scripts');
@endsection
