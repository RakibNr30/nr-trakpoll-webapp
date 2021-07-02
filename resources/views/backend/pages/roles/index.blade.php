@extends('backend.layouts.master')

@section('title')
    Role Page | Admin Dashboard
@endsection

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Roles</h1>
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
          <h3 class="card-title">Roles List</h3>
          <p class="float-right mb-2">
            @if(Auth::guard('admin')->user()->can('role.create'))
            <a class="btn btn-primary text-white" href="{{ route('admin.roles.create') }}">Create New Role</a>
            @endif
        </p>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped" style="text-transform: capitalize;">
            <thead>
            <tr>
              <th width="5%" style="text-align:center;">Sl</th>
              <th width="10%" style="text-align:center;">Name</th>
              <th width="60%" style="text-align:center;">Permissions</th>
              @if(Auth::guard('admin')->user()->can('role.edit'))
              <th width="15%" style="text-align:center;">Action</th>
              @endif
            </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td style="text-align:center;">{{ $loop->index+1 }}</td>
                    <td style="text-align:center;">{{ $role->name }}</td>
                    <td>
                      @foreach ($role->permissions as $perm)
                          <span class="badge badge-info mr-1">
                              {{ $perm->name }}
                          </span>
                      @endforeach
                    </td>
                    @if(Auth::guard('admin')->user()->can('role.edit'))
                    <td style="text-align:center;">
                        <a class="btn btn-success text-white" href="{{ route('admin.roles.edit', $role->id) }}">
                          <i class="fas fa-edit"></i>
                        </a>
                      @endif
                      @if(Auth::guard('admin')->user()->can('role.delete'))
                        <a class="btn btn-danger text-white" href="#delete-form{{ $role->id }}" data-toggle="modal">
                          <i class="fas fa-trash"></i>
                        </a>

                        <!--Delete Modal -->
                        <div id="delete-form{{ $role->id }}" class="modal fade">
                          <div class="modal-dialog modal-confirm">
                              <div class="modal-content">
                                  <div class="modal-header flex-column">
                                      <div class="icon-box">
                                          <i class="material-icons">&#xE5CD;</i>
                                      </div>
                                      <h4 class="modal-title w-100">Are you sure?</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                      <p>Do you really want to delete these records? This process cannot be undone.</p>
                                  </div>
                                  <div class="modal-footer justify-content-center">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                      <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                  </div>
                              </div>
                          </div>
                      </div>

                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th width="5%">Sl</th>
              <th width="10%">Name</th>
              <th width="60%">Permissions</th>
              @if(Auth::guard('admin')->user()->can('role.edit'))
              <th width="15%" style="text-align:center;">Action</th>
              @endif
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

</div>
<!-- /.content-wrapper -->

@endsection
