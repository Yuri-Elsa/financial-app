<div class="cute-pink-bg">
    <!-- Awan-awan lucu -->
    <div class="cloud cloud-1"></div>
    <div class="cloud cloud-2"></div>
    <div class="cloud cloud-3"></div>
    <div class="cloud cloud-4"></div>

    <div class="card mx-auto cute-card" style="max-width: 400px; position: relative; z-index: 2;">
        <div class="card-body" style="padding: 40px;">
            <form wire:submit.prevent="register">
                <div class="text-center">
                    <img src="/logo.png" alt="Logo" class="img-fluid mb-3 cute-logo mx-auto" style="max-width: 100px;">
                    <h2 class="cute-text-gradient" style="font-size: 2rem; margin-bottom: 10px;">Daftar 🌸</h2>
                    <p style="color: #FF69B4; margin-bottom: 30px;">Mari bergabung bersama kami!</p>
                </div>

                {{-- Nama --}}
                <div class="form-group mb-3">
                    <label style="color: #FF69B4; font-weight: 600;">Nama 👤</label>
                    <input type="text" class="form-control cute-input" wire:model="name" placeholder="Nama lengkap">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group mb-3">
                    <label style="color: #FF69B4; font-weight: 600;">Email ✉️</label>
                    <input type="email" class="form-control cute-input" wire:model="email" placeholder="email@example.com">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group mb-4">
                    <label style="color: #FF69B4; font-weight: 600;">Kata Sandi 🔒</label>
                    <input type="password" class="form-control cute-input" wire:model="password" placeholder="••••••••">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Tombol Daftar --}}
                <div class="form-group text-center">
                    <button type="submit" class="cute-btn w-100" style="font-size: 1rem; padding: 14px;">
                        Daftar ✨
                    </button>
                </div>
            </form>

            <hr style="margin: 30px 0; border-color: #FFE5F0;">
            <p class="text-center" style="color: #888;">
                Sudah memiliki akun? 
                <a href="{{ route('auth.login') }}" style="color: #FF69B4; font-weight: 600; text-decoration: none;">
                    Masuk di sini 💖
                </a>
            </p>
        </div>
    </div>
</div>
