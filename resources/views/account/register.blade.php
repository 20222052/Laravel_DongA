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
                        <h2 class="title">Register</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Regiser</li>
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
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6">
                        <div class="contact-content">
                            <div class="section-title mb-15">
                                <span class="sub-title">WELLCOME TO OUT PAGE </span>
                                <h2 class="title">Create your <span>account</span></h2>
                            </div>
                            <form action="" method="POST">
                                @csrf
                                <div class="contact-form-wrap">
                                    <div class="form-grp">
                                        <input name="name" type="text" placeholder="Your Name *" >
                                        @error('name')
                                        <small class="help-block">{{ $message }}</small>
                                         @enderror
                                    </div>
                                    <div class="form-grp">
                                        <input name="email" type="email" placeholder="Your Email *">
                                        @error('email')
                                        <small class="help-block">{{ $message }}</small>
                                         @enderror
                                    </div>
                                    <div class="form-grp">
                                        <input name="phone" type="text" placeholder="Your phone *">
                                        @error('phone')
                                        <small class="help-block">{{ $message }}</small>
                                         @enderror
                                    </div>
                                    <div class="form-grp">
                                        <input name="address" type="text" placeholder="Your address *">
                                        @error('address')
                                        <small class="help-block">{{ $message }}</small>
                                         @enderror
                                    </div>
                                    <div class="form-grp">
                                        <select name="gender" class="form-control">
                                            <option value="" >Gender</option>
                                            <option value="1">Male</option>
                                            <option value="0">FeMale</option>
                                        </select>
                                        @error('gender')
                                        <small class="help-block">{{ $message }}</small>
                                         @enderror
                                    </div>
                                    <div class="form-grp">
                                        <input name="password" type="password" placeholder="Your password *">
                                    </div>
                                    @error('password')
                                    <small class="help-block">{{ $message }}</small>
                                    @enderror
                                    <div class="form-grp">
                                        <input name="confirm_password" type="password" placeholder="Your confirm password *">
                                    </div>
                                    @error('confirm_password')
                                    <small class="help-block">{{ $message }}</small>
                                    @enderror
                                    <button type="submit">Create accout</button>
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
