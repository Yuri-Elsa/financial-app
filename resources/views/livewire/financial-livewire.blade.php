<div class="cute-pink-bg" style="padding: 20px 0;">
    <!-- Awan-awan lucu -->
    <div class="cloud cloud-1"></div>
    <div class="cloud cloud-2"></div>
    <div class="cloud cloud-3"></div>
    <div class="cloud cloud-4"></div>

    <div class="mt-3 container">
        <div class="card cute-card">
            <div class="card-header cute-header d-flex align-items-center">
                <div class="flex-fill">
                    <h3 style="margin: 0; font-size: 1.75rem;">💰 Catatan Keuangan</h3>
                </div>
                <div>
                    <a href="{{ route('app.financial.statistics') }}" class="cute-btn-outline me-2">
                        <i class="bi bi-graph-up"></i> Statistik
                    </a>
                    <a href="{{ route('auth.logout') }}" class="cute-btn-secondary">
                        Keluar 👋
                    </a>
                </div>
            </div>
            <div class="card-body" style="padding: 30px;">
                {{-- Summary Cards --}}
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="cute-summary-card cute-hover-card" style="background: linear-gradient(135deg, #98FB98 0%, #90EE90 100%);">
                            <h6 style="color: #2F5233; font-weight: 600; margin-bottom: 10px;">💵 Total Pemasukan</h6>
                            <h3 style="color: #2F5233; font-weight: 700; margin: 0;">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="cute-summary-card cute-hover-card" style="background: linear-gradient(135deg, #FFB6C1 0%, #FFA6B6 100%);">
                            <h6 style="color: #8B2C3A; font-weight: 600; margin-bottom: 10px;">💸 Total Pengeluaran</h6>
                            <h3 style="color: #8B2C3A; font-weight: 700; margin: 0;">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="cute-summary-card cute-hover-card" style="background: linear-gradient(135deg, {{ $balance >= 0 ? '#ADD8E6 0%, #B0E0E6' : '#FFD700 0%, #FFC700' }} 100%);">
                            <h6 style="color: {{ $balance >= 0 ? '#1E5A6E' : '#8B6914' }}; font-weight: 600; margin-bottom: 10px;">💎 Saldo</h6>
                            <h3 style="color: {{ $balance >= 0 ? '#1E5A6E' : '#8B6914' }}; font-weight: 700; margin: 0;">Rp {{ number_format($balance, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>

                {{-- Filters --}}
                <div class="card cute-filter-card mb-3">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label" style="color: #FF69B4; font-weight: 600;">🔍 Pencarian</label>
                            <input type="text" class="form-control cute-input" wire:model.live.debounce.300ms="search" placeholder="Cari judul, kategori...">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" style="color: #FF69B4; font-weight: 600;">📋 Tipe</label>
                            <select class="form-select cute-input" wire:model.live="filterType">
                                <option value="all">Semua</option>
                                <option value="income">Pemasukan</option>
                                <option value="expense">Pengeluaran</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" style="color: #FF69B4; font-weight: 600;">🏷️ Kategori</label>
                            <select class="form-select cute-input" wire:model.live="filterCategory">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" style="color: #FF69B4; font-weight: 600;">📅 Tanggal Mulai</label>
                            <input type="date" class="form-control cute-input" wire:model.live="startDate">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" style="color: #FF69B4; font-weight: 600;">📅 Tanggal Akhir</label>
                            <input type="date" class="form-control cute-input" wire:model.live="endDate">
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button class="btn cute-btn-outline w-100" wire:click="resetFilters">Reset</button>
                        </div>
                    </div>
                </div>

                {{-- Action Button --}}
                <div class="d-flex mb-3 align-items-center">
                    <div class="flex-fill">
                        <h4 class="cute-text-gradient" style="margin: 0;">📝 Daftar Transaksi</h4>
                    </div>
                    <div>
                        <button class="cute-btn" data-bs-toggle="modal" data-bs-target="#addRecordModal">
                            ➕ Tambah Catatan
                        </button>
                    </div>
                </div>

                {{-- Table --}}
                <div class="table-responsive cute-table">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th wire:click="sortByColumn('transaction_date')" style="cursor: pointer;">
                                    📅 Tanggal
                                    @if ($sortBy === 'transaction_date')
                                        <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th wire:click="sortByColumn('title')" style="cursor: pointer;">
                                    📌 Judul
                                    @if ($sortBy === 'title')
                                        <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th>🏷️ Kategori</th>
                                <th>📊 Tipe</th>
                                <th wire:click="sortByColumn('amount')" style="cursor: pointer;">
                                    💰 Jumlah
                                    @if ($sortBy === 'amount')
                                        <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th>⚙️ Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($records as $key => $record)
                                <tr>
                                    <td>{{ $records->firstItem() + $key }}</td>
                                    <td>{{ $record->transaction_date->format('d/m/Y') }}</td>
                                    <td style="font-weight: 600;">{{ $record->title }}</td>
                                    <td><span class="cute-badge-secondary">{{ $record->category }}</span></td>
                                    <td>
                                        @if ($record->type === 'income')
                                            <span class="cute-badge-success">✅ Pemasukan</span>
                                        @else
                                            <span class="cute-badge-danger">❌ Pengeluaran</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold" style="color: {{ $record->type === 'income' ? '#2F5233' : '#8B2C3A' }};">
                                        {{ $record->type === 'income' ? '+' : '-' }} Rp {{ number_format($record->amount, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('app.financial.detail', ['record_id' => $record->id]) }}" class="btn btn-sm cute-btn-outline" style="padding: 5px 15px; margin-right: 5px;">
                                            👁️ Detail
                                        </a>
                                        <button wire:click="prepareEditRecord({{ $record->id }})" class="btn btn-sm cute-btn-secondary" style="padding: 5px 15px; margin-right: 5px;">
                                            ✏️ Edit
                                        </button>
                                        <button wire:click="prepareDeleteRecord({{ $record->id }})" class="btn btn-sm" style="background: linear-gradient(135deg, #FFB6C1 0%, #FFA6B6 100%); color: white; padding: 5px 15px; border: none; border-radius: 10px;">
                                            🗑️ Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center" style="padding: 40px; color: #888;">
                                        <div style="font-size: 3rem; margin-bottom: 10px;">📭</div>
                                        <p style="margin: 0;">Belum ada data transaksi.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-3 cute-pagination">
                    {{ $records->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    @include('components.modals.financial.add')
    @include('components.modals.financial.edit')
    @include('components.modals.financial.delete')
</div>