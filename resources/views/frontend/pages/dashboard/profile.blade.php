@extends('frontend.pages.layouts.master')

@section('title')
    Profile | User Dashboard
@endsection

@section('user_content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-3"></div>
        <div class="col-md-9">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center mt-3">
                <img class="profile-user-img img-fluid img rounded-circle"
                     src="{{URL::To('backend/img/user2-160x160.jpg')}}"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{ $user->fname. ' '.$user->lname }}</h3>

              <p class="text-muted text-center">Genarel User</p>

              <ul class="list-group list-group-unbordered mt-3">
                <li class="list-group-item">
                  <b>Email Address</b> <a class="float-right">{{ $user->email }}</a>
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

