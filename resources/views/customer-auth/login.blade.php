@extends('layouts.master')

@section('content')







<div class="wrapper" id="login-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" >
                <div class="bar login-div">
                    Login
                </div>
                <div class="well login-div">


                    <form method="POST" action="{{ route('customer.login') }}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" name="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="+8801515XXXXXX">
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter your password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit"  class="btn btn-primary btn-block">Log In</button>
                            </div>
                            <div class="col-md-4">
                                &nbsp;
                            </div>
                            <div class="col-md-4">
                                <a type="button"  class="btn btn-warning btn-block"  href="{{ route('customer.password.request') }}"> Forgot password? </a>
                            </div>
                        </div>
                        <hr>
                    Don't have an account? <a href="{{Route('customer.register')}}">Sign up.</a> 

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>








<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</body>
</html>


@endsection
