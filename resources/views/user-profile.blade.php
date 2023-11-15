@extends('layouts/main');

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
    @endif 

    @if ($errors->has('password'))
        <div class="alert alert-danger">
            @error('password')
                {{ $message }}
            @enderror
        </div>
    @endif

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="@if($profile){{ asset('storage/' . $image->img_name) }} @endif" alt="Profile" class="rounded-circle">
              <h2>{{$user->name}}</h2>
              <h3>@if($profile){{ $design->name }} @endif</h3>
            </div>
          </div>

        </div>

      
        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">                 
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{$user->name}}</div>
                  </div>

                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">NRIC No.</div>
                    <div class="col-lg-9 col-md-8">@if($profile){{ $profile->nric_no }} @endif</div>
                  </div>
                 

                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone No.</div>
                    <div class="col-lg-9 col-md-8">@if($profile){{ $profile->phone_no }} @endif</div>
                  </div>
                 

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Designation</div>
                    <div class="col-lg-9 col-md-8">@if($profile){{ $design->name }} @endif</div>
                  </div>

                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">@if($profile){{ $profile->address }}@endif</div>
                  </div>
                  

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{$user->email}}</div>
                  </div>

                </div>


                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="{{ route('store.profile', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        
                        <img src=" @if($profile){{ asset('storage/' . $image->img_name) }} @endif" alt="Profile"> 
                        
                        <div class="pt-2">
                          @if ($profile)
                          <input type="file" name="user-image" accept=".png,.jpg,.jpeg" class="form-control"  >    
                          @else
                          <input type="file" name="user-image" accept=".png,.jpg,.jpeg" class="form-control" required >    
                          @endif
                          
                                             
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="{{$user->name}}" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="nric" class="col-md-4 col-lg-3 col-form-label">NRIC No.</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nric" type="text" class="form-control" id="nric" value="@if($profile) {{ $profile->nric_no }} @endif" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone No.</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="@if($profile) {{ $profile->phone_no }} @endif" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Designation</label>
                      <div class="col-md-8 col-lg-9">
                        <select name="designation" class="form-select"  required>

                          @if ($profile)
                              <option value="{{ $design->id }}">{{ $design->name }}</option>
                              @foreach($designation as $design2)
                              @if($design2->id !== $design->id)
                              <option value=" {{ $design2->id }}">{{ $design2->name }}</option>
                              @endif
                              @endforeach
                          @else
                              <option value="" selected disabled>Select Designation</option>
                              @foreach($designation as $design2)
                        
                              <option value=" {{ $design2->id }}">{{ $design2->name }}</option>
                            
                              @endforeach  

                          @endif
                      </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="address" class="form-control" style="height: 100px" id="validationCustom03" required>@if($profile) {{ $profile->address }} @endif</textarea>
                      </div>
                      
                    </div>
                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="{{$user->email}}">
                      </div>
                    </div>


                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">



                </div>
               


                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="{{ route('change.password', Auth::user()->id) }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="current_password" id="current_password"type="password" class="form-control" id="currentPassword">
                        @error('current_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" id="new_password" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password_confirmation" id="new_password_confirmation" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->