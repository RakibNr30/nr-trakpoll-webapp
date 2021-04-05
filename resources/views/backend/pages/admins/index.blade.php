@extends('backend.layouts.master')

@section('title')
    Admins | Admin Dashboard
@endsection

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admins</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.admins.index') }}">Admin List</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Admin List</h3>
          <p class="float-right mb-2">
            @if(Auth::guard('admin')->user()->can('admin.create'))
            <a class="btn btn-primary text-white" href="{{ route('admin.admins.create') }}">Create New Admin</a>
            @endif
        </p>
        @include('backend.partials.message');
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="5%">Sl</th>
                <th width="25%">Name</th>
                <th width="20%">Email</th>
                <th width="15%">Roles</th>
                <th width="15%">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        @foreach ($admin->roles as $role)
                            <span class="badge badge-info mr-1">
                                {{ $role->name }}
                            </span>
                        @endforeach
                    </td>
                   
                    <td style="text-align:center;">
                      <a class="btn btn-success text-white" href="{{ route('admin.admins.edit', $admin->id) }}">
                        <i class="fas fa-edit"></i></a>
                  
                    @if(Auth::guard('admin')->user()->can('admin.edit'))
                      <a class="btn btn-danger text-white" href="#delete-form{{ $admin->id }}" data-toggle="modal">
                        <i class="fas fa-trash"></i>
                        </a>
                    @endif
                    @if(Auth::guard('admin')->user()->can('admin.delete'))
                        <!--Delete Modal -->
                        <div id="delete-form{{ $admin->id }}" class="modal fade">
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
                                      <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST">
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
                <th width="25%">Name</th>
                <th width="20%">Email</th>
                <th width="15%">Roles</th>
                <th width="15%">Action</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
    </div><!-- /.card -->

</div><!-- /.content-wrapper -->

@endsection
