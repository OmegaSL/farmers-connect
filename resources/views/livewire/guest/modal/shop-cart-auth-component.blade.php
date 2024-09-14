<div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title fs-3 fw-bold" id="userModalLabel">
                        {{ $this->signing_in ? 'Sign In' : 'Sign Up' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($this->signing_in)
                        <form wire:submit.prevent='loginSubmit'>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" wire:model="email"
                                    placeholder="Enter Email address" required="" />

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter Password"
                                    wire:model="password" required="" />
                                {{-- <small class="form-text">
                                    By Signup, you agree to our
                                    <a href="#!">Terms of Service</a>
                                    &
                                    <a href="#!">Privacy Policy</a>
                                </small> --}}

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </form>
                    @endif

                    @if ($this->signing_up)
                        <form wire:submit.prevent='signupSubmit'>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="fullName" placeholder="Enter Your Name"
                                    wire:model="name" required="" />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" wire:model='email'
                                    placeholder="Enter Email address" required="" />
                            </div>
                            <div class="mb-5">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter Password"
                                    wire:model='password' required="" />
                                {{-- <small class="form-text">
                                    By Signup, you agree to our
                                    <a href="#!">Terms of Service</a>
                                    &
                                    <a href="#!">Privacy Policy</a>
                                </small> --}}
                            </div>
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </form>
                    @endif
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    {{-- Already have an account? <a href="#">Sign in</a> --}}
                    {!! $this->signing_up
                        ? ' Already have an account? <a href="#" wire:click="signin">Sign in</a>'
                        : ' Don\'t have an account? <a href="#" wire:click="signup">Sign up</a>' !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Cart -->

</div>

@script
    <!-- close on livewire event -->
    <script>
        window.addEventListener('isLoggedIn', event => {
            $('#userModal').modal('hide');
        });
    </script>
@endscript
