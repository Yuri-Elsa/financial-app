<div class="cute-pink-bg" style="padding: 20px 0; min-height: 100vh;">
    <!-- Awan-awan lucu -->
    <div class="cloud cloud-1"></div>
    <div class="cloud cloud-2"></div>
    <div class="cloud cloud-3"></div>
    <div class="cloud cloud-4"></div>

    <div class="mt-3 container">
        <div class="card cute-card">
            <div class="card-header cute-header d-flex align-items-center" style="border-bottom: 2px solid #ffe5f0;">
                <div class="flex-fill">
                    <a href="{{ route('app.financial.index') }}" class="text-decoration-none" style="color: #ff69b4;">
                        <small style="font-weight: 600;">← Kembali</small>
                    </a>
                    <h3 class="mt-2 cute-text-gradient" style="margin: 0; font-size: 1.75rem;">📊 Statistik Keuangan</h3>
                </div>
            </div>
            <div class="card-body" style="padding: 30px;">
                {{-- Filter --}}
                <div class="card cute-filter-card mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label" style="color: #FF69B4; font-weight: 600;">📅 Tahun</label>
                            <select class="form-select cute-input" wire:model.live="selectedYear">
                                @for ($year = date('Y'); $year >= 2020; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color: #FF69B4; font-weight: 600;">📅 Bulan (untuk kategori)</label>
                            <select class="form-select cute-input" wire:model.live="selectedMonth">
                                @for ($month = 1; $month <= 12; $month++)
                                    <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                        {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Summary Cards --}}
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="cute-summary-card cute-hover-card" style="background: linear-gradient(135deg, #98FB98 0%, #90EE90 100%);">
                            <h6 style="color: #2F5233; font-weight: 600; margin-bottom: 10px;">💵 Total Pemasukan ({{ $selectedYear }})</h6>
                            <h3 style="color: #2F5233; font-weight: 700; margin: 0;">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="cute-summary-card cute-hover-card" style="background: linear-gradient(135deg, #FFB6C1 0%, #FFA6B6 100%);">
                            <h6 style="color: #8B2C3A; font-weight: 600; margin-bottom: 10px;">💸 Total Pengeluaran ({{ $selectedYear }})</h6>
                            <h3 style="color: #8B2C3A; font-weight: 700; margin: 0;">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="cute-summary-card cute-hover-card" style="background: linear-gradient(135deg, {{ ($totalIncome - $totalExpense) >= 0 ? '#ADD8E6 0%, #B0E0E6' : '#FFD700 0%, #FFC700' }} 100%);">
                            <h6 style="color: {{ ($totalIncome - $totalExpense) >= 0 ? '#1E5A6E' : '#8B6914' }}; font-weight: 600; margin-bottom: 10px;">💎 Saldo ({{ $selectedYear }})</h6>
                            <h3 style="color: {{ ($totalIncome - $totalExpense) >= 0 ? '#1E5A6E' : '#8B6914' }}; font-weight: 700; margin: 0;">Rp {{ number_format($totalIncome - $totalExpense, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>

                {{-- Monthly Trend Chart --}}
                <div class="card cute-card mb-4" style="border: 2px solid #ffb6c1;">
                    <div class="card-body">
                        <h5 style="color: #ff69b4; font-weight: 700; margin-bottom: 20px;">📈 Tren Bulanan {{ $selectedYear }}</h5>
                        <div id="monthlyTrendChart"></div>
                    </div>
                </div>

                <div class="row mb-4">
                    {{-- Income by Category --}}
                    <div class="col-md-6">
                        <div class="card cute-card" style="border: 2px solid #ffb6c1;">
                            <div class="card-body">
                                <h5 style="color: #ff69b4; font-weight: 700; margin-bottom: 20px;">💵 Pemasukan per Kategori</h5>
                                <div id="incomeCategoryChart"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Expense by Category --}}
                    <div class="col-md-6">
                        <div class="card cute-card" style="border: 2px solid #ffb6c1;">
                            <div class="card-body">
                                <h5 style="color: #ff69b4; font-weight: 700; margin-bottom: 20px;">💸 Pengeluaran per Kategori</h5>
                                <div id="expenseCategoryChart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Top Categories Tables --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card cute-card" style="border: 2px solid #ffb6c1;">
                            <div class="card-body">
                                <h5 style="color: #ff69b4; font-weight: 700; margin-bottom: 20px;">🏆 Top 5 Kategori Pemasukan</h5>
                                <div class="table-responsive cute-table">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kategori</th>
                                                <th class="text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($topIncomeCategories as $cat)
                                                <tr>
                                                    <td style="font-weight: 600;">{{ $cat->category }}</td>
                                                    <td class="text-end fw-bold" style="color: #2F5233;">Rp {{ number_format($cat->total, 0, ',', '.') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-center" style="padding: 40px; color: #888;">
                                                        <div style="font-size: 2rem; margin-bottom: 10px;">📭</div>
                                                        <p style="margin: 0;">Belum ada data</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card cute-card" style="border: 2px solid #ffb6c1;">
                            <div class="card-body">
                                <h5 style="color: #ff69b4; font-weight: 700; margin-bottom: 20px;">🏆 Top 5 Kategori Pengeluaran</h5>
                                <div class="table-responsive cute-table">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kategori</th>
                                                <th class="text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($topExpenseCategories as $cat)
                                                <tr>
                                                    <td style="font-weight: 600;">{{ $cat->category }}</td>
                                                    <td class="text-end fw-bold" style="color: #8B2C3A;">Rp {{ number_format($cat->total, 0, ',', '.') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-center" style="padding: 40px; color: #888;">
                                                        <div style="font-size: 2rem; margin-bottom: 10px;">📭</div>
                                                        <p style="margin: 0;">Belum ada data</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('livewire:init', () => {
        // Monthly Trend Chart
        const monthlyData = @json($monthlyData);
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        
        const incomeData = Array(12).fill(0);
        const expenseData = Array(12).fill(0);
        
        monthlyData.forEach(item => {
            incomeData[item.month - 1] = parseFloat(item.total_income);
            expenseData[item.month - 1] = parseFloat(item.total_expense);
        });

        const monthlyOptions = {
            series: [{
                name: 'Pemasukan',
                data: incomeData
            }, {
                name: 'Pengeluaran',
                data: expenseData
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: months,
            },
            yaxis: {
                title: {
                    text: 'Jumlah (Rp)'
                },
                labels: {
                    formatter: function (val) {
                        return 'Rp ' + val.toLocaleString('id-ID');
                    }
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return 'Rp ' + val.toLocaleString('id-ID');
                    }
                }
            },
            colors: ['#28a745', '#dc3545']
        };

        const monthlyChart = new ApexCharts(document.querySelector("#monthlyTrendChart"), monthlyOptions);
        monthlyChart.render();

        // Income Category Chart
        const categoryData = @json($categoryData);
        const incomeCategories = categoryData.filter(item => item.type === 'income');
        const expenseCategories = categoryData.filter(item => item.type === 'expense');

        if (incomeCategories.length > 0) {
            const incomeOptions = {
                series: incomeCategories.map(item => parseFloat(item.total)),
                chart: {
                    type: 'pie',
                    height: 350
                },
                labels: incomeCategories.map(item => item.category),
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return 'Rp ' + val.toLocaleString('id-ID');
                        }
                    }
                }
            };

            const incomeChart = new ApexCharts(document.querySelector("#incomeCategoryChart"), incomeOptions);
            incomeChart.render();
        } else {
            document.querySelector("#incomeCategoryChart").innerHTML = '<p class="text-center text-muted">Belum ada data pemasukan</p>';
        }

        // Expense Category Chart
        if (expenseCategories.length > 0) {
            const expenseOptions = {
                series: expenseCategories.map(item => parseFloat(item.total)),
                chart: {
                    type: 'donut',
                    height: 350
                },
                labels: expenseCategories.map(item => item.category),
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return 'Rp ' + val.toLocaleString('id-ID');
                        }
                    }
                }
            };

            const expenseChart = new ApexCharts(document.querySelector("#expenseCategoryChart"), expenseOptions);
            expenseChart.render();
        } else {
            document.querySelector("#expenseCategoryChart").innerHTML = '<p class="text-center text-muted">Belum ada data pengeluaran</p>';
        }
    });
</script>
@endpush