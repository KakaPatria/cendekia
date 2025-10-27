    @extends('layouts.siswa.master')
    @section('title') Dashboard @endsection
    @section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text-css" />
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text-css" />
    <style>
        :root {
            --primary-red: #980000;
            --primary-yellow: #E2B602;
            --bs-success-rgb: 40, 167, 69;
            --bs-info-rgb: 23, 162, 184;
            --bs-warning-rgb: 255, 193, 7;
        }
        
        /* [IMPROVE] Kartu Statistik */
        .stat-card {
            border-radius: 1rem;
            border: none;
            color: white;
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .stat-card .card-body {
            position: relative;
            z-index: 2;
        }
        .stat-card .stat-icon {
            font-size: 3rem;
            opacity: 0.8;
        }
        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
        }
        .stat-card .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        .stat-card::before { /* Efek overlay ikon */
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 100px;
            height: 100px;
            font-family: 'remixicon' !important;
            font-size: 7rem;
            opacity: 0.15;
            transform: rotate(-15deg);
            z-index: 1;
        }
        .stat-card.card-completed::before { content: "\EB82"; }
        .stat-card.card-average::before { content: "\F14B"; }
        .stat-card.card-rank::before { content: "\F1AB"; }

        /* [IMPROVE] Kartu Tryout */
        .tryout-card {
            border-radius: 1rem; border: 1px solid #e9ebec;
            transition: transform 0.3s ease, box-shadow 0.3s ease; overflow: hidden;
        }
        .tryout-card:hover {
            transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        .tryout-card .card-img-top { height: 160px; object-fit: cover; }
        .tryout-card .card-body { padding: 1.25rem; }
        .tryout-card .materi-tags .badge { font-size: 0.7rem; padding: 0.4em 0.7em; }
        .tryout-card .card-footer { background-color: #f8f9fa; border-top: 1px solid #e9ebec; }
        .btn-daftar-tryout {
            background: var(--primary-red); color: white; font-weight: 600; border: none;
        }
        .btn-daftar-tryout:hover { background: #800000; color: white; }

        /* [IMPROVE] Styling umum card */
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid #f0f0f0;
        }

        /* [UPDATED] Recent Accesses Styling */
        .recent-link-wrapper {
            display: block;
            text-decoration: none;
            color: inherit;
            margin-bottom: 1rem;
            border-radius: 0.8rem;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .recent-link-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(41, 43, 50, 0.08);
        }
        .recent-link-wrapper:hover .recent-title {
            color: var(--primary-red);
        }
        .recent-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 1rem;
            border-radius: 0.8rem;
            background: #fff;
            border: 1px solid #eef0f3;
            width: 100%;
        }
        .recent-thumb {
            width: 80px;
            height: 55px;
            object-fit: cover;
            border-radius: 6px;
            flex-shrink: 0;
            background: #f5f6f8;
        }
        .recent-title {
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }
        .recent-sub {
            color: #8a8f98;
            font-size: 0.85rem;
            margin-top: 2px;
        }
        .recent-tags {
            margin-top: 8px;
        }
        .recent-tags .badge {
            background: #f0f2f5;
            color: #555;
            font-weight: 500;
            font-size: 0.7rem;
            padding: 0.3em 0.6em;
        }
        .recent-continue .btn {
            white-space: nowrap;
            transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
        }
        .recent-link-wrapper:hover .recent-continue .btn {
            background-color: var(--primary-red);
            border-color: var(--primary-red);
            color: #fff;
        }

        /* Empty State */
        .empty-state {
            text-align: center; padding: 4rem 2rem; background-color: #fdfdff;
            border-radius: 1rem; border: 2px dashed #e9ebec;
        }
        .empty-state i { font-size: 3rem; color: var(--primary-red); margin-bottom: 1rem; }

        
    </style>
    @endsection

    @section('content')

    @include('components.message')

    <div class="row">
        <div class="col">

            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Selamat Datang, {{ strtok(Auth::user()->name, " ") }}!</h4>
                                <p class="text-muted mb-0">Siap untuk menaklukkan tantangan hari ini?</p>
                            </div>

                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card stat-card card-completed" style="background: #28a745;">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <p class="stat-label mb-0">Tryout Selesai</p>
                                        <h3 class="stat-value mb-0">{{ $riwayat_pengerjaan->count() ?? 0 }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card stat-card card-average" style="background: #17a2b8;">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <p class="stat-label mb-0">Nilai Rata-rata</p>
                                        <h3 class="stat-value mb-0">{{ $riwayat_pengerjaan->count() > 0 ? round($riwayat_pengerjaan->avg('nilai_akhir'), 1) : 0 }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card stat-card card-rank" style="background: #ffc107;">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <p class="stat-label mb-0">Peringkat Terbaik</p>
                                        <h3 class="stat-value mb-0">#1</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card stat-card" style="background: #007bff;">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <p class="stat-label mb-0">Tryout Aktif</p>
                                        <h3 class="stat-value mb-0">{{ $tryout->count() ?? 0 }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row-->

                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    @if(isset($riwayat_pengerjaan) && $riwayat_pengerjaan->count() > 0)
                                        <div id="line_chart_datalabel" data-colors='["#980000"]' class="apex-charts" dir="ltr"></div>
                                    @else
                                        <div class="text-center p-4">
                                            <p class="text-muted">Belum ada data perkembangan nilai.</p>
                                        </div>
                                    @endif
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-4 col-md-6">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Riwayat Tryout Selesai</h4>

                            </div><!-- end card header -->
                            <div class="card-body">
                                @if(isset($riwayat_pengerjaan) && $riwayat_pengerjaan->count() > 0)
                                    <div class="table-responsive table-card">
                                        <table class="table align-middle table-borderless table-centered table-nowrap mb-0">
                                            <thead class="text-muted table-light">
                                                <tr>
                                                    <th scope="col" style="width: 62;">Nama Tryout</th>
                                                    <th scope="col">Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($riwayat_pengerjaan->take(5) as $item)
                                                <tr>
                                                    <td>
                                                        {{ Str::limit($item->masterTryout->tryout_judul, 30) }}
                                                    </td>
                                                    <td class="text-center"> {{ $item->nilai_akhir }}</td>
                                                </tr><!-- end -->
                                                 @endforeach
                                            </tbody><!-- end tbody -->
                                        </table><!-- end table -->
                                    </div><!-- end -->
                                @else
                                    <div class="text-center p-4">
                                        <p class="text-muted">Belum ada riwayat tryout.</p>
                                    </div>
                                @endif
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>

                <div class="row mt-4">
                    <div class="col-lg-12">
                        @if(isset($recent_tryouts) && $recent_tryouts->count() > 0)
                        <div class="mb-4">
                            <h5 class="fs-18 mb-3">Baru Diakses</h5>

                            @foreach($recent_tryouts as $recent)
                                @php
                                    if(isset($recent->tryout_id)) {
                                        $t = $recent;
                                        $accessedAt = null;
                                    } elseif(isset($recent->masterTryout)) {
                                        $t = $recent->masterTryout;
                                        $accessedAt = $recent->updated_at ?? $recent->created_at ?? null;
                                    } else {
                                        $t = null;
                                        $accessedAt = null;
                                    }
                                @endphp

                                @if($t)
                                <a href="{{ route('siswa.tryout.show', $t->tryout_id) }}" class="recent-link-wrapper">
                                    <div class="recent-item">
                                        <img src="{{ $t->tryout_banner ? Storage::url($t->tryout_banner) : URL::asset('/assets/images/default-thumb.png') }}" alt="thumbnail" class="recent-thumb">

                                        <div class="flex-grow-1">
                                            <h6 class="recent-title mb-0">{{ Str::limit($t->tryout_judul, 70) }}</h6>
                                            {{-- [CHANGE] Tampilkan hanya jika ada tanggal --}}
                                            @if($accessedAt)
                                                <div class="recent-sub">{{ \Carbon\Carbon::parse($accessedAt)->diffForHumans() }}</div>
                                            @endif

                                            <div class="recent-tags">
                                                @if(isset($t->materi) && count($t->materi) > 0)
                                                    @foreach(collect($t->materi)->take(2) as $m)
                                                        <span class="badge">{{ $m->refMateri->ref_materi_judul }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="ms-3 recent-continue">
                                            <span class="btn btn-sm btn-outline-primary">Lanjutkan</span>
                                        </div>
                                    </div>
                                </a>
                                @endif
                            @endforeach
                        </div>
                        @endif

                        <h4 class="fs-18 mb-3">Tryout Terbaru Untukmu</h4>
                        <div class="row">
                            @forelse($tryout as $data)
                            <div class="col-md-6 mb-4">
                                <div class="card tryout-card h-100 {{ $data->is_can_register ? 'disabled' : '' }}">
                                    <img src="{{Storage::url($data->tryout_banner)}}" alt="{{$data->tryout_judul}}" class="card-img-top">
                                    <div class="card-body d-flex flex-column">
                                        <div class="materi-tags mb-2 d-flex flex-wrap gap-1">
                                            @foreach(collect($data->materi)->take(2) as $materi)
                                            <span class="badge badge-soft-info">{{ $materi->refMateri->ref_materi_judul}}</span>
                                            @endforeach
                                            @if(count($data->materi) > 2)
                                            <span class="badge badge-soft-secondary">+{{ count($data->materi) - 2 }}</span>
                                            @endif
                                        </div>
                                        <h5 class="card-title mb-2 fs-16 text-dark flex-grow-1">{{ $data->tryout_judul}}</h5>
                                        <ul class="list-unstyled text-muted small mb-0">
                                            <li><i class="ri-calendar-2-fill text-danger align-middle me-1"></i> Deadline: {{ \Carbon\Carbon::parse($data->tryout_register_due)->format('d M Y')}}</li>
                                        </ul>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 fs-14">
                                                <i class="ri-group-fill text-primary align-bottom me-1"></i>
                                                <span class="fw-medium">{{ $data->peserta_count ?? 0 }} Peserta</span>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <a href="{{ route('siswa.tryout.show', $data->tryout_id) }}" class="btn btn-sm btn-daftar-tryout">
                                                    Lihat Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <div class="empty-state">
                                    <i class="ri-folder-zip-line"></i>
                                    <h4 class="fs-18">Oops! Belum Ada Tryout</h4>
                                    <p class="text-muted">Saat ini belum ada tryout yang tersedia untuk Anda.</p>
                                </div>
                            </div>
                            @endforelse
                        </div>
                        @if ($tryout->hasPages()) <div class="mt-2">{{ $tryout->links() }}</div> @endif
                    </div>
                </div>

            </div> <!-- end .h-100-->

        </div> <!-- end col -->


    </div>

    @endsection
    @section('script')
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(isset($riwayat_pengerjaan) && $riwayat_pengerjaan->count() > 0)
                const categories = @json($riwayat_pengerjaan->pluck('masterTryout.tryout_judul'));
                const seriesData = @json($riwayat_pengerjaan->pluck('nilai_akhir'));
                
                var options = {
                    series: [{ name: 'Nilai', data: seriesData }],
                    chart: { height: 350, type: 'line', zoom: { enabled: false }, toolbar: { show: false } },
                    dataLabels: { enabled: true, },
                    stroke: { curve: 'smooth', width: 3 },
                    colors: ['#980000'],
                    xaxis: { categories: categories },
                    yaxis: { min: 0, max: 100 },
                    tooltip: { y: { formatter: function (val) { return val } } },
                };
                var chart = new ApexCharts(document.querySelector("#line_chart_datalabel"), options);
                chart.render();
            @endif
        });
    </script>
    @endsection