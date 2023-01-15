<!DOCTYPE html>
<html lang="en">

@include('web.layouts.head')

<body class="">
    <main class="main-content main-content-bg mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-start">
                                    <h3 class="font-weight-bolder text-info text-gradient">Ostaz Dashboard</h3>
                                    <h4 class="font-weight-bolder ">Welcome back</h4>

                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <!-- Email Address -->
                                        <div >
                                            <label> {{ __('Email') }}</label>
                                            @error('email')
                                                <br><label style="color: red">{{ $message }}</label>
                                            @enderror
                                            <input class="form-control mb-0" id="email" type="email" name="email"
                                                value="{{ old('email') }}" required autofocus />

                                        </div>

                                        <!-- Password -->
                                        <div class="mt-4">
                                            <label> {{ __('Password') }}</label>
                                            @error('password')
                                                <br><label style="color: red">{{ $message }}</label>
                                            @enderror
                                            <input id="password" class="form-control mb-0" type="password"
                                                name="password" required autocomplete="current-password" />
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="block mt-4">
                                            <label for="remember_me" class="inline-flex items-center">
                                                <input id="remember_me" type="checkbox"
                                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    name="remember">
                                                <span
                                                    class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                            </label>
                                        </div>

                                        <div class="flex items-center justify-end mt-4">
                                            <button class="btn bg-gradient-info w-100 mb-0">
                                                {{ __('Log in') }}
                                            </button>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('{{ URL::asset('assets/img/curved-images/curved14.jpg') }}')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    @include('web.layouts.scripts')
</body>

</html>
