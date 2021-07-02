@extends('backend.layouts.master')

@section('title')
    Profile | Admin Dashboard
@endsection

@section('admin_content')
<section class="content">
    <div class="card">
      <div class="row">
        <div class="col-2"></div>

        <div class="col-10">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center mt-3">
                <img class="profile-user-img img-fluid img rounded-circle"
                     src="{{URL::To('backend/img/user2-160x160.png')}}"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{ $admin->name }}</h3>

              <p class="text-muted text-center">Profile</p>

              <ul class="list-group list-group-unbordered mt-3">
                <li class="list-group-item">
                  <b>Email Address</b> <a class="float-right">{{ $admin->email }}</a>
                </li>
                <li class="list-group-item">
                    <b>Username</b> <a class="float-right">{{ $admin->username }}</a>
                  </li>
              </ul>

              {{-- <a href="{{ route('user.profile') }}" class="btn btn-primary btn-block text-center"><b>Update Information</b></a> --}}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->


      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

