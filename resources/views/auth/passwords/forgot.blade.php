@extends('site.include.assets')
@if(getSetting('recaptcha') == 1)
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
@endif

@section('meta_data')
    @php
		$meta_title = 'Forgot Password';			
	@endphp
@endsection

@section('content')
<section class="bg-home-75vh">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card form-signin p-4 rounded shadow">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show my-1" role="alert">
                                    {{ $error }}
                                    <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                                        <span class="">&times;</span>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <a href="{{url('/')}}">
                                <img src="{{ getBackendLogo(getSetting('app_logo')) }}" class="avatar avatar-small mb-4 d-block mx-auto" alt="">
                            </a>
                            <h5 class="mb-3 text-center">Reset your password</h5>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control  @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" name="email" value="{{ old('email') }}" required>
                                <label for="floatingInput">Email Address</label>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <button class="btn btn-primary w-100" type="submit">Send Instructions</button>
                            <div class="col-12 text-center mt-3">
                                <a href="{{ url('login')}}" class="text-dark">Already have an account?
                                </a>
                                <p class="mb-0 mt-3"><small class="text-dark me-2"></small> </p>
                            </div>
                            <p class="mb-0 text-muted mt-5 text-center">© <script>document.write(new Date().getFullYear())</script> {{ getSetting('app_name') }}</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

