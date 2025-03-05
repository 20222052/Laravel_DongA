@extends('master.main')

@section('main')
 <!-- main-area -->
 <main>
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Login</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Login</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- contact-area -->
    <section class="contact-area">

        <div class="contact-wrap">
            <div class="container ">
                <div class="row align-items-center justify-content-center">
                    <div class="text-center col-lg-6">
                        <div class="contact-content">
                            <div class="section-title mb-15">
                                <span class="sub-title">----------------------------Login-------------------------------</span>
                                <h2 class="title">Login <span>Account</span></h2>
                            </div>
                            <form action="" method="POST">
                                @csrf
                                <div class="contact-form-wrap">

                                    <div class="form-grp">
                                        <input name="email" type="email" placeholder="Your Email *">
                                        @error('email')
                                        <small class="help-block">{{ $message }}</small>
                                         @enderror
                                    </div>

                                    <div class="form-grp">
                                        <input name="password" type="password" placeholder="Your password *">
                                        @error('password')
                                        <small class="help-block">{{ $message }}</small>
                                         @enderror
                                    </div>

                                    <button type="submit">Login</button>
                                    <a style="display: block; text-align: center; margin-top: 15px" href="{{ route('account.register') }}">Click here to create new account</a>
                                    <a style="display: block; text-align: center; margin-top: 15px" href="{{ route('account.forgot_password') }}">Forgot password</a>
                                </div>
                            </form>
                            <p class="ajax-response mb-0"></p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

</main>
<!-- main-area-end -->

@stop()
