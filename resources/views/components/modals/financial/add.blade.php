<form wire:submit.prevent="addRecord">
    <div class="modal fade cute-modal" tabindex="-1" id="addRecordModal" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="margin: 0; font-weight: 700;">➕ Tambah Catatan Keuangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">📊 Tipe Transaksi <span class="text-danger">*</span></label>
                        <select class="form-select cute-input" wire:model="addType">
                            <option value="">Pilih Tipe</option>
                            <option value="income">💵 Pemasukan</option>
                            <option value="expense">💸 Pengeluaran</option>
                        </select>
                        @error('addType')
                            <span class="text-danger" style="font-size: 0.875rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">📌 Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control cute-input" wire:model="addTitle" placeholder="Contoh: Gaji Bulanan">
                        @error('addTitle')
                            <span class="text-danger" style="font-size: 0.875rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">🏷️ Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control cute-input" wire:model="addCategory" placeholder="Contoh: Gaji, Makan, Transport">
                        @error('addCategory')
                            <span class="text-danger" style="font-size: 0.875rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">💰 Jumlah (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control cute-input" wire:model="addAmount" placeholder="0" step="0.01" min="0">
                        @error('addAmount')
                            <span class="text-danger" style="font-size: 0.875rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">📅 Tanggal Transaksi <span class="text-danger">*</span></label>
                        <input type="date" class="form-control cute-input" wire:model="addTransactionDate">
                        @error('addTransactionDate')
                            <span class="text-danger" style="font-size: 0.875rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">📝 Deskripsi</label>
                        <textarea class="form-control cute-input" rows="3" wire:model="addDescription" placeholder="Catatan tambahan (opsional)"></textarea>
                        @error('addDescription')
                            <span class="text-danger" style="font-size: 0.875rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cute-btn-outline" data-bs-dismiss="modal">❌ Batal</button>
                    <button type="submit" class="cute-btn">✨ Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>