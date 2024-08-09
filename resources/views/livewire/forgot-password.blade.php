<div class="card">
    <div class="card-header">Forgot Password</div>
    <div class="card-body">
        @if($showOtpForm && !$showpassword)
        <div>
            <form wire:submit.prevent="verifyOtp">
                <div class="mb-3 row">
                    <label for="otp" class="col-md-4 col-form-label text-md-end text-start">Enter OTP</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('otp') is-invalid @enderror" id="otp" wire:model="otp">
                        @error('otp') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <button type="submit" class="col-md-3 offset-md-5 btn btn-primary">Verify OTP</button>
                </div>
            </form>
        </div>
        @endif

        @if(!$showOtpForm)
        <form wire:submit.prevent="sendOtp">
            <div class="mb-3 row">
                <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                <div class="col-md-6">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model="email">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <button type="submit" class="col-md-3 offset-md-5 btn btn-primary">
                    Send OTP
                </button>
            </div>
        </form>
        @endif

        @if($showpassword )
        <div>
            <form wire:submit.prevent="resetPassword">
                <div class="mb-3 row">
                    <label for="newPassword" class="col-md-4 col-form-label text-md-end text-start">New Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control @error('newPassword') is-invalid @enderror" id="newPassword" wire:model.defer="newPassword" required>
                        @error('newPassword') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="confirmPassword" class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror" id="confirmPassword" wire:model.defer="confirmPassword" required>
                        @error('confirmPassword') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                @if($successMessage)
                <div class="alert alert-success" role="alert">
                    {{ $successMessage }}
                </div>
                @endif
                
                <div class="mb-3 row">
                    <button type="submit" class="col-md-3 offset-md-5 btn btn-primary">Reset Password</button>
                </div>
            </form>
        </div>
        @endif

    </div>
</div>