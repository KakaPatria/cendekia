@extends('layouts.siswa.master')
@section('title') Invoice @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Invoice @endslot
@slot('title') Detail Invoice @endslot
@endcomponent

@include('components.message')
<div class="row justify-content-center">
    <div class="col-xxl-9">
        <div class="card" id="demo">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-header border-bottom-dashed p-4">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <img src="{{ URL::asset('assets/images/logo-cendikia.png') }}" class="card-logo card-logo-dark" alt="logo dark" height="40">
                                <img src="{{ URL::asset('assets/images/logo-cendikia.png') }}" class="card-logo card-logo-light" alt="logo light" height="40">

                            </div>
                            {{--<div class="flex-shrink-0 mt-sm-0 mt-3">
                                <div class="mt-sm-5 mt-4">
                                    <h6 class="text-muted text-uppercase fw-semibold">Alamat</h6>
                                    <p class="text-muted mb-1" id="address-details">Jl. Tinalan No.7, Prenggan, </p>
                                    <p class="text-muted mb-1" id="address-details">Kec. Kotagede, Kota Yogyakarta,</p>
                                    <p class="text-muted mb-1" id="address-details">Daerah Istimewa Yogyakarta </p>
                                    <p class="text-muted mb-0" id="zip-code"><span>Kode POS:</span> 55172</p>

                                </div>
                            </div>--}}
                        </div>
                    </div>
                    <!--end card-header-->
                </div>
                <!--end col-->
                <div class="col-lg-12">
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-lg-3 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Invoice No</p>
                                <h5 class="fs-14 mb-0">#<span id="invoice-no">{{ $inv->inv_id}}</span></h5>
                            </div>
                            <!--end col-->
                            <div class="col-lg-2 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Tanggal</p>
                                <h5 class="fs-14 mb-0"><span id="invoice-date">{{ $inv->inv_date_format}}</span> </h5>
                            </div>
                            <div class="col-lg-2 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Expired</p>
                                <h5 class="fs-14 mb-0"><span id="invoice-date">{{ $inv->due_date_format}}</span> </h5>
                            </div>
                            <!--end col-->
                            <div class="col-lg-2 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold"> Status Invoice</p>
                                {!! $inv->status_badge !!}

                            </div>
                            <!--end col-->
                            <div class="col-lg-3 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Total</p>
                                <h5 class="fs-14 mb-0">Rp. <span id="total-amount">{{ $inv->total_invoice_rp }}</span></h5>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end col-->
                <div class="col-lg-12">
                    <div class="card-body p-4 border-top border-top-dashed">
                        <div class="row g-3">
                            <div class="col-6">
                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Alamat Tagih</h6>
                                <p class="fw-medium mb-2" id="billing-name">{{ optional($inv->peserta)->tryout_peserta_name }}</p>
                                <p class="text-muted mb-1" id="billing-address-line-1">{{ optional($inv->peserta)->tryout_peserta_alamat }}</p>
                                <p class="text-muted mb-1"><span>No Telepon: </span><span id="billing-phone-no">{{ optional($inv->peserta)->tryout_peserta_telpon }}</span></p>
                                <p class="text-muted mb-0"><span>Email: </span><span id="billing-tax-no">{{ optional($inv->peserta)->tryout_peserta_email }} </span> </p>
                            </div>

                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end col-->
                <div class="col-lg-12">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                <thead>
                                    <tr class="table-active">
                                        <th scope="col" style="width: 50px;">#</th>
                                        <th scope="col">Detail</th>
                                        <th scope="col" class="text-end">Nominal</th>
                                    </tr>
                                </thead>
                                <tbody id="products-list">
                                    <tr>
                                        <th scope="row">01</th>
                                        <td class="text-start">
                                            <span class="fw-medium">{{ $inv->keterangan}}</span>

                                        </td>
                                        <td class="text-end">Rp. {{ $inv->amount_rp }}</td>
                                    </tr>

                                </tbody>
                            </table>
                            <!--end table-->
                        </div>
                        <div class="border-top border-top-dashed mt-2">
                            <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                <tbody>

                                    @if($inv->discount_rp)
                                    <tr class="border-top border-top-dashed fs-15">
                                        <th scope="row">Diskon</th>
                                        <th class="text-end text-danger">- Rp. {{ $inv->discount_rp}}</th>
                                    </tr>
                                    @endif
                                    <tr class="border-top border-top-dashed fs-15">
                                        <th scope="row">Total</th>
                                        <th class="text-end">Rp. {{ $inv->total_invoice_rp}}</th>
                                    </tr>
                                </tbody>
                            </table>
                            </table>
                            <!--end table-->
                        </div>

                        @if($inv->status == 0)

                        <div class="text-center d-print-none mt-4">
                            <a href="javascript:void(0);" id="bayar-btn" class="btn btn-warning">Bayar Sekarang</a>
                        </div>
                        @endif
                    </div>
                    <!--end card-body-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection
@section('script')
<script src="{{ URL::asset('/assets/js/pages/invoicedetails.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    $('#nav-tryout').addClass('active')

    <?php if ($inv->status == 0) { ?>

        $('#bayar-btn').click(function() {
            console.log('Tombol bayar diklik');
            
            $.ajax({
                url: "{{ route('siswa.payment.snapToken') }}",
                type: 'POST',
                data: {
                    inv_id: "{{ $inv->inv_id }}",
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    console.log('Response dari server:', data);
                    
                    if (data.snap_token) {
                        console.log('Snap token diterima:', data.snap_token);
                        
                        // Cek apakah snap tersedia
                        if (typeof snap !== 'undefined') {
                            snap.pay(data.snap_token, {
                                onSuccess: function(result) {
                                    console.log('Pembayaran berhasil:', result);
                                    alert("Pembayaran berhasil!");
                                    location.reload();
                                },
                                onPending: function(result) {
                                    console.log('Pembayaran pending:', result);
                                    alert("Menunggu pembayaran!");
                                    location.reload();
                                },
                                onError: function(result) {
                                    console.error('Error pembayaran:', result);
                                    alert("Pembayaran gagal!");
                                    location.reload();
                                },
                                onClose: function() {
                                    console.log('Popup ditutup tanpa menyelesaikan pembayaran');
                                }
                            });
                        } else {
                            console.error('Snap.js tidak terload!');
                            alert('Error: Midtrans Snap tidak terload. Silakan refresh halaman.');
                        }
                    } else {
                        console.error('Snap token tidak ada dalam response');
                        alert('Error: Gagal mendapatkan snap token');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.error('Response:', xhr.responseText);
                    alert('Error: Gagal menghubungi server. ' + error);
                }
            });

        });
    <?php  } ?>
</script>
@endsection