@extends('homepage.layout.master')
@section('header')
<title>Toko Lestari - Jual Bahan Bangunan</title>

@endsection
@section('slide')

@endsection
@section('content')
<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
      <div class="col-md-7">
        <h1 class="h2">Register</h1>
      </div>
      <div class="col-md-5">
        <ul class="breadcrumb d-flex justify-content-end">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Register</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div id="content">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="box">
          <h2 class="text-uppercase">New account</h2>
          <p class="lead">Not our registered customer yet?</p>
          <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The
            whole process will not take you more than a minute!</p>
          <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact
              us</a>, our customer service center is working for you 24/7.</p>
          <hr>
          <form method="POST" action="{{ route('home.register') }}">
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Name</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required
                  autofocus>
  
                @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="name"">Username</label>
                                  <input id=" name" type="text" class="form-control" name="username"
                  value="{{ old('username') }}" required autofocus>
  
                  @if ($errors->has('username'))
                  <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                  </span>
                  @endif
              </div>
              <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="name">Phone</label>
                <input id="name" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required
                  autofocus>
  
                @if ($errors->has('phone'))
                <span class="help-block">
                  <strong>{{ $errors->first('phone') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="name">Address</label>
                {{-- <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required
                autofocus> --}}
                <textarea class="form-control" name="address" required autofocus></textarea>
                @if ($errors->has('address'))
                <span class="help-block">
                  <strong>{{ $errors->first('address') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group">
                <label for="firstname">Daerah</label>
                <select class="form-control" onchange="check()" id="city" name="village" required>
                  <option value="">Pilih Daerah</option>
                  @php
                  $daerah = daerah();
                  @endphp
                  @foreach($daerah as $d)
                  <option value="{{ $d['tujuan'] }}">{{ $d['tujuan'] }} </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                <label for="name">Gender</label>
                {{-- <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required
                autofocus> --}}
                <select name="gender" class="form-control">
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
  
                @if ($errors->has('gender'))
                <span class="help-block">
                  <strong>{{ $errors->first('gender') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                <label for="name">Birth day</label>
                <input id="name" type="date" class="form-control" name="birthday" value="{{ old('birthday') }}" required
                  autofocus>
  
                @if ($errors->has('birthday'))
                <span class="help-block">
                  <strong>{{ $errors->first('birthday') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-Mail Address</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
  
                @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
  
                @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group">
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
              <div class="form-group">
                <div class="">
                  <button type="submit" class="btn btn-primary">
                    Register
                  </button>
                </div>
              </div>
          </form>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="box">
          <h2 class="text-uppercase">Login</h2>
          <p class="lead">Already our customer?</p>
          <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
            egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
            sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
          <hr>
          <form action="{{ url('auth/login') }}" method="POST">
            {{ @csrf_field() }}
            <div class="form-group">
                <label for="email">Email</label>
              <input id="email_modal" type="text" placeholder="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
              <input id="password_modal" type="password" placeholder="password" class="form-control" name="password">
            </div>
            <p class="text-center">
              <button class="btn btn-template-outlined"><i class="fa fa-sign-in"></i> Log in</button>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')

@endsection
@show