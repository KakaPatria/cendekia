 @extends('layouts.panel.master')
 @section('title') Pendafataran @endsection
 @section('css')

 @endsection
 @section('content')
 @component('components.breadcrumb')
 @slot('li_1') Pembayaran @endslot
 @slot('title') Detail @endslot
 @endcomponent

 @include('components.message')
 <div class="d-flex justify-content-sm-end gap-2 ">
     <a href="#" class="btn btn-primary btn-sm mb-2"><i class="  ri-printer-line   align-bottom me-1"></i> Cetak</a>

     <div>
         <a href="{{ route('panel.invoices.index')}}" class="btn btn-success btn-sm mb-2"><i class=" ri-arrow-left-line  align-bottom me-1"></i> Kembali</a>
     </div>
 </div> 
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
                                 <h5 class="fs-14 mb-0">#<span id="invoice-no">{{ $invoice->inv_id}}</span></h5>
                             </div>
                             <!--end col-->
                             <div class="col-lg-2 col-6">
                                 <p class="text-muted mb-2 text-uppercase fw-semibold">Tanggal</p>
                                 <h5 class="fs-14 mb-0"><span id="invoice-date">{{ $invoice->inv_date_format}}</span> </h5>
                             </div>
                             <div class="col-lg-2 col-6">
                                 <p class="text-muted mb-2 text-uppercase fw-semibold">Expired</p>
                                 <h5 class="fs-14 mb-0"><span id="invoice-date">{{ $invoice->due_date_format}}</span> </h5>
                             </div>
                             <!--end col-->
                             <div class="col-lg-2 col-6">
                                 <p class="text-muted mb-2 text-uppercase fw-semibold"> Status Invoice</p>
                                 {!! $invoice->status_badge !!}

                             </div>
                             <!--end col-->
                             <div class="col-lg-3 col-6">
                                 <p class="text-muted mb-2 text-uppercase fw-semibold">Total</p>
                                 <h5 class="fs-14 mb-0">Rp. <span id="total-amount">{{ $invoice->total_invoice_rp }}</span></h5>
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
                                 <p class="fw-medium mb-2" id="billing-name">{{ $invoice->peserta->tryout_peserta_name}}</p>
                                 <p class="text-muted mb-1" id="billing-address-line-1">{{ $invoice->peserta->tryout_peserta_alamat}}</p>
                                 <p class="text-muted mb-1"><span>No Telepon: </span><span id="billing-phone-no">{{ $invoice->peserta->tryout_peserta_telpon}}</span></p>
                                 <p class="text-muted mb-0"><span>Email: </span><span id="billing-tax-no">{{ $invoice->peserta->tryout_peserta_email}} </span> </p>
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
                                             <span class="fw-medium">{{ $invoice->keterangan}}</span>

                                         </td>
                                         <td class="text-end">Rp. {{ $invoice->amount_rp }}</td>
                                     </tr>

                                 </tbody>
                             </table>
                             <!--end table-->
                         </div>
                         <div class="border-top border-top-dashed mt-2">
                             <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                 <tbody>

                                     @if($invoice->discount_rp)
                                     <tr class="border-top border-top-dashed fs-15">
                                         <th scope="row">Diskon</th>
                                         <th class="text-end text-danger">- Rp. {{ $invoice->discount_rp}}</th>
                                     </tr>
                                     @endif
                                     <tr class="border-top border-top-dashed fs-15">
                                         <th scope="row">Total</th>
                                         <th class="text-end">Rp. {{ $invoice->total_invoice_rp}}</th>
                                     </tr>
                                 </tbody>
                             </table>
                             </table>
                             <!--end table-->
                         </div>


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
     <div class="row">
         <div class="col-xl-6">
             <div class="card">
                 <div class="card-header">
                     <h5 class="card-title mb-0">Detail Pembayaran</h5>
                 </div>
                 <div class="card-body">
                     <div class="d-flex align-items-center mb-2">
                         <div class="flex-shrink-0">
                             <p class="text-muted mb-0">Metode Pembayaran:</p>
                         </div>
                         <div class="flex-grow-1 ms-2">
                             <h6 class="mb-0"> {{ ucwords(str_replace('_', ' ', $invoice->payment_type)) }}</h6>
                         </div>
                     </div>
                     <div class="d-flex align-items-center mb-2">
                         <div class="flex-shrink-0">
                             <p class="text-muted mb-0">Bank:</p>
                         </div>
                         <div class="flex-grow-1 ms-2">
                             <h6 class="mb-0  ">{{ strtoupper($invoice->bank) }}</h6>
                         </div>
                     </div>
                     <div class="d-flex align-items-center mb-2">
                         <div class="flex-shrink-0">
                             <p class="text-muted mb-0">Nomor VA:</p>
                         </div>
                         <div class="flex-grow-1 ms-2">
                             <h6 class="mb-0">{{ $invoice->va_number }}</h6>
                         </div>
                     </div>
                     <div class="d-flex align-items-center mb-2">
                         <div class="flex-shrink-0">
                             <p class="text-muted mb-0">Total:</p>
                         </div>
                         <div class="flex-grow-1 ms-2">
                             <h6 class="mb-0">Rp.{{ $invoice->total_invoice_rp}}</h6>
                         </div>
                     </div>
                     <div class="d-flex align-items-center mb-2">
                         <div class="flex-shrink-0">
                             <p class="text-muted mb-0">Status:</p>
                         </div>
                         <div class="flex-grow-1 ms-2">
                             <h6 class="mb-0">{!! $invoice->status_badge !!}</h6>
                         </div>
                     </div>
                     <div class="d-flex align-items-center mb-2">
                         <div class="flex-shrink-0">
                             <p class="text-muted mb-0">Tanggal Bayar:</p>
                         </div>
                         <div class="flex-grow-1 ms-2">
                             <h6 class="mb-0">{{ $invoice->inv_paid_format}}</h6>
                         </div>
                     </div>
                     <div class="d-flex align-items-center mb-2">
                         <div class="flex-shrink-0">
                             <p class="text-muted mb-0">Notes:</p>
                         </div>
                         <div class="flex-grow-1 ms-2">
                             <h6 class="mb-0">{{ $invoice->remark}}</h6>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-xl-6">
             <div class="card">
                 <div class="card-header">
                     <h5 class="card-title mb-0">Detail Peserta</h5>
                 </div>
                 <div class="card-body">
                     <div class="d-flex align-items-center mb-2">
                         <div class="flex-shrink-0">
                             <p class="text-muted mb-0">Nama Peserta:</p>
                         </div>
                         <div class="flex-grow-1 ms-2">
                             <h6 class="mb-0"> {{ $invoice->peserta->tryout_peserta_name??'' }}</h6>
                         </div>
                     </div>
                     <div class="d-flex align-items-center mb-2">
                         <div class="flex-shrink-0">
                             <p class="text-muted mb-0">Nomor Telpon:</p>
                         </div>
                         <div class="flex-grow-1 ms-2">
                             <h6 class="mb-0  ">{{ $invoice->peserta->tryout_peserta_telpon??'' }}</h6>
                         </div>
                     </div>
                     <div class="d-flex align-items-center mb-2">
                         <div class="flex-shrink-0">
                             <p class="text-muted mb-0">Email:</p>
                         </div>
                         <div class="flex-grow-1 ms-2">
                             <h6 class="mb-0">{{ $invoice->peserta->tryout_peserta_email }}</h6>
                         </div>
                     </div>
                     <div class="d-flex align-items-center mb-2">
                         <div class="flex-shrink-0">
                             <p class="text-muted mb-0">Alamat:</p>
                         </div>
                         <div class="flex-grow-1 ms-2">
                             <h6 class="mb-0">Rp.{{ $invoice->peserta->tryout_peserta_alamat}}</h6>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 @endsection
 @section('script')
 @endsection