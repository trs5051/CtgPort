@extends('layouts.master')
@section('content')
<div class="wrapper" id="signup-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" >
                <div class="bar signup-div">
                    Sign Up
                </div>
                <div class="well signup-div">

                    <form method="POST" action="{{ route('customer.register') }}">
                      {{csrf_field()}}

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter your name">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="col-md-6 form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="you@example.com">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="row">

                         <div class="col-md-12 form-group">
                                <label>Mobile</label>
                                <input type="text" name="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="Ex: 018XXXXXXXX">
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Create a password">
                            &nbsp;
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                            <div class="col-md-4">
                                &nbsp;
                            </div>
                            <div class="col-md-4">
                                &nbsp;
                            </div>
                        </div>

                        <hr>

                        Already have an account? <a href="{{route('customer.login')}}">Log in.</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
