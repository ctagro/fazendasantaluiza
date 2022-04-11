<x-app-layout>
   <div>
      <div class="row">
         <div class="col-xl-3 col-lg-4">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">Foto</h4>
                  </div>
               </div>
               <div class="card-body">
                  <form action= "{{ route('profile.update') }}" method = "POST" enctype="multipart/form-data">
                     {!! csrf_field() !!}
                     <div class="form-group">
                        <div class="profile-img-edit position-relative">
                           <img class="profile-pic rounded avatar-100" src="{{asset('images/avatars/01.png')}}" alt="profile-pic">
                           <div class="upload-icone bg-primary">
                              <svg class="upload-button" width="14" height="14" viewBox="0 0 24 24">
                                 <path fill="#ffffff" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                              </svg>
                              <input class="file-upload" type="file" accept="image/*">
                           </div>
                        </div>
                        <div class="img-extension mt-3">
                           <div class="d-inline-block align-items-center">
                              <span>Only</span>
                              <a href="javascript:void();">.jpg</a>
                              <a href="javascript:void();">.png</a>
                              <a href="javascript:void();">.jpeg</a>
                              <span>allowed</span>
                           </div>
                        </div>
                     </div>

                  </form>
               </div>
            </div>
         </div>
         <div class="col-xl-9 col-lg-8">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">New User Information</h4>
                  </div>
               </div>
               <div class="card-body">
                  <div class="new-user-info">
                     <form action= "{{ route('profile.update') }}" method = "POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="row">
                           <div class="form-group">
                              <label class="form-label" for="fname">Name:</label>
                              <input type="text" value="{{ auth()->user()->name }}" class="form-control" id="name" name='name' placeholder="Nome">
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="fname">First Name:</label>
                              <input type="text" value="{{ auth()->user()->first_name }}" class="form-control" id="first_name" name='first_name' placeholder="First Name">
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="lname">Last Name:</label>
                              <input type="text" value="{{ auth()->user()->last_name }}" class="form-control" id="last_name" name='last_name'  placeholder="Last Name">
                           </div>
                           <div class="form-group col-md-6">
                              <label for="phone" class="form-label">Phone No.</label>
                              <input type="text" value="{{ auth()->user()->phone_number }}" class="form-control" id="phone_number" name='phone_number'  placeholder="Last Name">
                           </div>
                        </div>
                        <hr>
                        <h5 class="mb-3">Security</h5>
                        <div class="row">
                           <div class="form-group col-md-12">
                              <label class="form-label" for="uname">User Name:</label>
                              <input type="text" value="{{ auth()->user()->email }}" class="form-control" id="email" placeholder="User Name">
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="pass">Password:</label>
                              <input type="password" class="form-control" id="password" name='password' placeholder="Password">
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="rpass">Repeat Password:</label>
                              <input type="password" class="form-control" id="password_repeat" name='password_repeat'  placeholder="Repeat Password ">
                           </div>
                        </div>
           
                        <button type="submit" class="btn btn-primary">Save User</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</x-app-layout>