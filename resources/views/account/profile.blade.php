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
                        <h2 class="title">Update Your profile</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Update</li>
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
                                <span class="sub-title">Update your account</span>
                                
                            </div>
                            
                            <form action="" method="POST">
                                @csrf
                                <div class="contact-form-wrap">
                                    <div class="form-grp">
                                        <input name="name" value="{{ $auth->name }}"  type="text" placeholder="Your Name *">
                                        @error('name')
                                        <div class="help-block">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-grp">
                                        <input name="email" value="{{ $auth->email }}" type="email" placeholder="Your Email *">
                                        @error('email')
                                        <div class="help-block">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-grp">
                                        <input name="phone" value="{{ $auth->phone }}" type="text" placeholder="Your phone *">
                                        @error('phone')
                                    <small class="help-block">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    
                                    <div class="form-grp">
                                        <input name="address" value="{{ $auth->address }}" type="text" placeholder="Your address *">
                                        @error('address')
                                    <small class="help-block">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="form-grp">
                                        <select name="gender" class="form-control">
                                            <option value="">Select One</option>
                                            <option value="1" {{ $auth->gender == 1 ? 'selected' : ''}}>Male</option>
                                            <option value="0"  {{ $auth->gender == 0 ? 'selected' : ''}}>Fe Male</option>
                                        </select>
                                        @error('gender')
                                    <small class="help-block">{{ $message }}</small>
                                    @enderror
                                    </div>

                                    <!-- <div class="form-grp">
                                        <input name="password" hidden type="password" value="{{$auth->password}}" placeholder="Your password *">
                                        @error('password')
                                            <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div> -->

                                    <button type="submit">Update Profile</button>
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
