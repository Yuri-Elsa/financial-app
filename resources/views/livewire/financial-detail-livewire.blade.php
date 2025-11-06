<div class="cute-pink-bg" style="padding: 20px 0; min-height: 100vh;">
    <!-- Awan-awan lucu -->
    <div class="cloud cloud-1"></div>
    <div class="cloud cloud-2"></div>
    <div class="cloud cloud-3"></div>
    <div class="cloud cloud-4"></div>

    <div class="mt-3 container">
        <div class="card cute-card">
            <div class="card-header cute-header d-flex" style="border-bottom: 2px solid #ffe5f0;">
                <div class="flex-fill">
                    <a href="{{ route('app.financial.index') }}" class="text-decoration-none" style="color: #ff69b4;">
                        <small style="font-weight: 600;">← Kembali</small>
                    </a>
                    <h3 class="mt-2 cute-text-gradient" style="margin: 0; font-size: 1.75rem;">{{ $record->title }}</h3>
                </div>
                <div>
                    @if ($record->receipt)
                        <button class="btn" style="background: linear-gradient(135deg, #FFB6C1 0%, #FFA6B6 100%); color: white; border: none; border-radius: 15px; padding: 8px 20px; font-weight: 600;" wire:click="deleteReceipt" wire:confirm="Yakin ingin menghapus bukti transaksi?">
                            🗑️ Hapus Bukti
                        </button>
                    @else
                        <button class="cute-btn" data-bs-target="#uploadReceiptModal" data-bs-toggle="modal">
                            📤 Upload Bukti
                        </button>
                    @endif
                </div>
            </div>
            <div class="card-body" style="padding: 30px;">
                {{-- Receipt Image --}}
                @if ($record->receipt)
                    <div class="mb-4">
                        <label class="form-label" style="color: #FF69B4; font-weight: 600; font-size: 1.1rem;">📸 Bukti Transaksi:</label>
                        <div style="border: 3px solid #ffb6c1; border-radius: 15px; padding: 10px; background: #fff;">
                            <img src="{{ asset('storage/' . $record->receipt) }}" alt="Receipt" class="img-fluid rounded" style="max-width: 100%; max-height: 500px;">
                        </div>
                    </div>
                    <hr style="border-color: #ffe5f0; border-width: 2px;">
                @endif

                {{-- Details --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" style="color: #FF69B4; font-weight: 600;">📊 Tipe Transaksi:</label>
                        <div>
                            @if ($record->type === 'income')
                                <span class="cute-badge-success" style="font-size: 1rem;">✅ Pemasukan</span>
                            @else
                                <span class="cute-badge-danger" style="font-size: 1rem;">❌ Pengeluaran</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color: #FF69B4; font-weight: 600;">🏷️ Kategori:</label>
                        <div>
                            <span class="cute-badge-secondary" style="font-size: 1rem;">{{ $record->category }}</span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" style="color: #FF69B4; font-weight: 600;">💰 Jumlah:</label>
                        <div>
                            <h4 style="color: {{ $record->type === 'income' ? '#2F5233' : '#8B2C3A' }}; font-weight: 700;">
                                {{ $record->type === 'income' ? '+' : '-' }} Rp {{ number_format($record->amount, 0, ',', '.') }}
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color: #FF69B4; font-weight: 600;">📅 Tanggal Transaksi:</label>
                        <div>
                            <p class="fs-5" style="margin: 0; color: #333;">{{ $record->transaction_date->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" style="color: #FF69B4; font-weight: 600;">📝 Deskripsi:</label>
                    <div class="p-3 rounded" style="background: #fff7fa; border: 2px solid #ffe5f0;">
                        <p style="font-size: 16px; white-space: pre-wrap; margin: 0; color: #333;">{{ $record->description ?: 'Tidak ada deskripsi' }}</p>
                    </div>
                </div>

                <hr style="border-color: #ffe5f0; border-width: 2px;">

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label" style="color: #FF69B4; font-weight: 600;">🕐 Dibuat pada:</label>
                        <p style="color: #666;">{{ $record->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color: #FF69B4; font-weight: 600;">🕐 Terakhir diubah:</label>
                        <p style="color: #666;">{{ $record->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Upload Receipt --}}
        @include('components.modals.financial.upload-receipt')
    </div>
</div>