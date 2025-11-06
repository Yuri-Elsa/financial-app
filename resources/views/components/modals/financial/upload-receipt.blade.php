<form wire:submit.prevent="uploadReceipt">
    <div class="modal fade" tabindex="-1" id="uploadReceiptModal" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content" style="border: 3px solid #ffb6c1; border-radius: 20px;">
                <div class="modal-header" style="background: linear-gradient(135deg, #FF69B4 0%, #FFB6C1 100%); border-radius: 17px 17px 0 0;">
                    <h5 class="modal-title" style="margin: 0; font-weight: 700; color: white;">📤 Upload Bukti Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" style="color: #FF69B4; font-weight: 600;">📸 Pilih Gambar Bukti Transaksi</label>
                        <input type="file" class="form-control cute-input" wire:model="uploadReceiptFile" accept="image/*">
                        @error('uploadReceiptFile')
                            <span class="text-danger" style="font-size: 0.875rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($uploadReceiptFile)
                        <div class="mb-3">
                            <label class="form-label" style="color: #FF69B4; font-weight: 600;">👀 Preview:</label>
                            <div style="border: 2px solid #ffb6c1; border-radius: 10px; padding: 10px; background: #fff;">
                                <img src="{{ $uploadReceiptFile->temporaryUrl() }}" class="img-fluid rounded" style="max-height: 300px;">
                            </div>
                        </div>
                    @endif

                    <div class="alert" style="background: #fff7fa; border: 2px solid #ffe5f0; border-radius: 10px; color: #ff69b4;">
                        <small>
                            <strong>📌 Catatan:</strong>
                            <ul class="mb-0" style="margin-top: 5px;">
                                <li>Format file: JPG, PNG, atau JPEG</li>
                                <li>Ukuran maksimal: 2MB</li>
                            </ul>
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cute-btn-outline" data-bs-dismiss="modal">❌ Batal</button>
                    <button type="submit" class="cute-btn" @if (!$uploadReceiptFile) disabled @endif>
                        ✨ Upload
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>