<div class="cute-pink-bg">
    <!-- Awan-awan lucu -->
    <div class="cloud cloud-1"></div>
    <div class="cloud cloud-2"></div>
    <div class="cloud cloud-3"></div>
    <div class="cloud cloud-4"></div>

    <form wire:submit.prevent="login">
        <div class="card mx-auto cute-card" style="max-width: 400px;">
            <div class="card-body" style="padding: 40px;">
                <div>
                    <div class="text-center">
                        <img src="/logo.png" alt="Logo" class="img-fluid mb-3 cute-logo mx-auto" style="max-width: 100px;">
                        <h2 class="cute-text-gradient" style="font-size: 2rem; margin-bottom: 10px;">Masuk 💕</h2>
                        <p style="color: #FF69B4; margin-bottom: 30px;">Selamat datang kembali!</p>
                    </div>
                    
                    {{-- Alamat Email --}}
                    <div class="form-group mb-3">
                        <label style="color: #FF69B4; font-weight: 600; margin-bottom: 8px;">Email ✉️</label>
                        <input type="email" class="form-control cute-input" wire:model="email" placeholder="email@example.com">
                        @error('email')
                            <span class="text-danger" style="font-size: 0.875rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    {{-- Kata Sandi --}}
                    <div class="form-group mb-4">
                        <label style="color: #FF69B4; font-weight: 600; margin-bottom: 8px;">Kata Sandi 🔒</label>
                        <input type="password" class="form-control cute-input" wire:model="password" placeholder="••••••••">
                        @error('password')
                            <span class="text-danger" style="font-size: 0.875rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Kirim --}}
                    <div class="form-group text-center">
                        <button type="submit" class="cute-btn w-100" style="font-size: 1rem; padding: 14px;">
                            Masuk ✨
                        </button>
                    </div>

                    <hr style="margin: 30px 0; border-color: #FFE5F0;">
                    <p class="text-center" style="color: #888;">
                        Belum memiliki akun? 
                        <a href="{{ route('auth.register') }}" style="color: #FF69B4; font-weight: 600; text-decoration: none;">
                            Daftar di sini 💖
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>