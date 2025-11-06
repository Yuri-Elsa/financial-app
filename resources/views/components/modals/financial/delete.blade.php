<form wire:submit.prevent="deleteRecord">
    <div class="modal fade cute-modal" tabindex="-1" id="deleteRecordModal" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #FFB6C1 0%, #FFA6B6 100%);">
                    <h5 class="modal-title" style="margin: 0; font-weight: 700;">🗑️ Hapus Catatan Keuangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
                </div>
                <div class="modal-body">
                    <div class="cute-alert" style="background: linear-gradient(135deg, #FFF0F5 0%, #FFE5F0 100%); border-color: #FFB6C1;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="font-size: 3rem;">⚠️</div>
                            <div>
                                <p style="margin: 0; color: #8B2C3A; font-weight: 600; margin-bottom: 5px;">
                                    Apakah kamu yakin ingin menghapus catatan ini?
                                </p>
                                <p style="margin: 0; color: #8B2C3A;">
                                    Catatan dengan judul <strong>"{{ $deleteRecordTitle }}"</strong> akan dihapus permanen.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <p style="color: #888; margin-top: 15px; margin-bottom: 20px;">
                        ⚠️ Data yang sudah dihapus tidak dapat dikembalikan.
                    </p>
                    
                    <div class="mb-3">
                        <label class="form-label">📝 Ketik judul catatan untuk konfirmasi</label>
                        <input type="text" class="form-control cute-input" wire:model="deleteConfirmTitle" placeholder="Ketik judul catatan">
                        @error('deleteConfirmTitle')
                            <span class="text-danger" style="font-size: 0.875rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cute-btn-outline" data-bs-dismiss="modal">❌ Batal</button>
                    <button type="submit" class="btn" style="background: linear-gradient(135deg, #FFB6C1 0%, #FFA6B6 100%); color: white; border: none; border-radius: 20px; padding: 12px 30px; font-weight: 600;">
                        🗑️ Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>