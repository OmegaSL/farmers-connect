@section('title', 'Sign in')

<div>
    <!-- section -->
    <section class="my-lg-14 my-8">
        <div class="container">
            <!-- row -->
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                    <!-- img -->
                    <img src="{{ asset('assets/images/svg-graphics/signin-g.svg') }}" alt="" class="img-fluid" />
                </div>
                <!-- col -->
                <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                    @if ($this->sign_in)
                        <div class="mb-lg-9 mb-5">
                            <h1 class="mb-1 h2 fw-bold">Sign in to {{ config('app.name') }}</h1>
                            <p>Welcome back to {{ config('app.name') }}! Enter your email to get started.</p>
                        </div>
                        <form wire:submit.prevent='loginSubmit'>
                            <div class="row g-3">
                                <!-- row -->

                                <div class="col-12">
                                    <!-- input -->
                                    <label for="formSigninEmail" class="form-label visually-hidden">
                                        Email address
                                    </label>
                                    <input type="email" class="form-control" id="formSigninEmail" wire:model='email'
                                        placeholder="Email" required />

                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <!-- input -->
                                    <div class="password-field position-relative">
                                        <label for="formSigninPassword"
                                            class="form-label visually-hidden">Password</label>
                                        <div class="password-field position-relative">
                                            <input type="password" class="form-control fakePassword"
                                                id="formSigninPassword" wire:model='password' placeholder="*****"
                                                required />
                                            {{-- <span><i class="bi bi-eye-slash passwordToggler"></i></span> --}}
                                            {{-- <div class="text-danger">Please enter password.</div> --}}

                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <!-- form check -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            wire:model='remember' id="flexCheckDefault" />
                                        <!-- label -->
                                        <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                                    </div>
                                    <div>
                                        Forgot password?
                                        <a href="#!" wire:click='forgotPassword'>Reset It</a>
                                    </div>
                                </div>
                                <!-- btn -->
                                <div class="col-12 d-grid"><button type="submit" class="btn btn-primary">Sign
                                        In</button></div>
                                <!-- link -->
                                <div>
                                    Don’t have an account?
                                    <a href="#!">Sign Up</a>
                                </div>
                            </div>
                        </form>
                    @elseif ($this->reset_password)
                        <div class="mb-lg-9 mb-5">
                            <h1 class="mb-1 h2 fw-bold">Reset Password</h1>
                            <p>Please enter your email address. You will receive a code to reset your password.</p>
                        </div>
                        <form wire:submit.prevent='forgotPasswordSubmit'>
                            <!-- row -->
                            <div class="row g-3">
                                <!-- col -->
                                <div class="col-12">
                                    <!-- input -->
                                    <label for="formForgetEmail" class="form-label visually-hidden">Email
                                        address</label>
                                    <input type="email" class="form-control" id="formForgetEmail" placeholder="Email"
                                        wire:model='email' required />

                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- btn -->
                                <div class="col-12 d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Send Code</button>
                                    <a href="#!" wire:click='signIn' class="btn btn-light">Back</a>
                                </div>
                            </div>
                        </form>
                    @elseif ($this->enter_otp)
                        <div class="mb-lg-9 mb-5">
                            <h1 class="mb-1 h2 fw-bold">Enter OTP</h1>
                            <p>Please fill in the OTP code sent to your email address.</p>
                        </div>
                        <form wire:submit.prevent='resetPassword'>
                            <!-- row -->
                            <div class="row g-3">
                                <!-- col -->
                                <div class="col-12">
                                    <!-- input -->
                                    <label for="formForgetEmail" class="form-label visually-hidden">
                                        Email address
                                    </label>
                                    <input type="email" class="form-control" id="formForgetEmail" placeholder="Email"
                                        disabled readonly wire:model='email' required />

                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- col -->
                                <div class="col-12">
                                    <!-- input -->
                                    <label for="formOtpCode" class="form-label visually-hidden">
                                        OTP Code
                                    </label>
                                    <input type="number" class="form-control" id="formOtpCode"
                                        placeholder="Enter OTP Code" wire:model='otp_code' required />

                                    @error('otp_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- col -->
                                <div class="col-12">
                                    <!-- input -->
                                    <label for="formNewPassword" class="form-label visually-hidden">
                                        New Password
                                    </label>
                                    <input type="password" class="form-control" id="formNewPassword"
                                        placeholder="Password" wire:model='new_password' required />

                                    @error('new_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- col -->
                                <div class="col-12">
                                    <!-- input -->
                                    <label for="formConfirmPassword" class="form-label visually-hidden">
                                        Confirm Password
                                    </label>
                                    <input type="password" class="form-control" id="formConfirmPassword"
                                        placeholder="Password" wire:model='confirm_password' required />

                                    @error('confirm_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- btn -->
                                <div class="col-12 d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Reset Password</button>
                                    <a href="#!" wire:click='signIn' class="btn btn-light">Back</a>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
