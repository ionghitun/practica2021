@extends('baseR')

@section('content')
@if(session()->has('message'))
    <div class="alert alert-success"> 
        {{ session()->get('message') }}
    </div> 
@endif 

@if ($errors->any())
        <div class="alert alert-danger">
            <ul style='
    padding-right: 20px;
'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


<div class="register-box">
  <div class="register-logo">
    <a href="{{route('login')}}"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>



      <form   action="{{route('register')}}" method="post">
      @csrf
        <div class="input-group mb-3">
          <input   name="txt_FullName" type="text" class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        @if ($errors->has('email'))
                    <div class="alert alert-danger">{{$errors->first('email')}}</div> @endif
        <div class="input-group mb-3">
          <input name="txt_Email" type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input  name="txt_Password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @if ($errors->has('register'))
                    <div class="alert alert-danger">{{$errors->first('register')}}</div> @endif
       
        <div class="input-group mb-3">
      
          <input name="txt_RetypePassword" type="password" class="form-control" placeholder="Retype password"> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
       
          <div class="col-4">
         
            <button  type="submit" class="btn btn-primary btn-block" onclick="return Validate()">Register</button> 
          </div>
       
        </div>
      </form>

      <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="{{route('login')}}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
@endsection
<!-- jQuery -->
