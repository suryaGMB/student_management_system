<div>
    <form wire:submit="verifyOtp">
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
