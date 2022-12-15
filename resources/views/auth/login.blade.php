@extends('admin.layouts.layout2')

@section('title','Login')

@section('content')

<div class="wrapper wrapper-login">
    <div class="container container-login animated fadeIn">
        <img src="{{asset('assets')}}/images/logo/someah-logo.png" alt=""
            style="display: block;  margin-left: auto;  margin-right: auto; margin-bottom: 24px; max-width: 260px;">
        <h3 class="text-center">Sign In</h3>
        <div class="login-form">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group form-floating-label">
					<input
					id="email" name="email" type="email" value="{{ old('email') }}"
                        class="form-control input-border-bottom" required>
                    <label for="email" class="placeholder">Email</label>
                </div>
                <div class="form-group form-floating-label">
                    <input id="password" name="password" type="password" class="form-control input-border-bottom"
                        required>
                    <label for="password" class="placeholder">Password</label>
                    <div class="show-password">
                        <i class="icon-eye"></i>
                    </div>
                </div>
                <div class="row form-sub m-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Remember Me</label>
                    </div>

                </div>
                <div class="form-action">
                    <button type="submit" class="btn btn-success btn-rounded btn-login">Sign In</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
