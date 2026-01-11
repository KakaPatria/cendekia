 @extends('layouts.panel.master')
 @section('title') Pembayaran Tryout @endsection
 @section('css')

 @endsection
 @section('content')
 @component('components.breadcrumb')
 @slot('li_1') Tryout @endslot
 @slot('title') Daftar Pembayaran @endslot
 @endcomponent

 @include('components.message')

 <div class="row">
     <div class="col-lg-12">
         <div class="card" id="">
             <div class="card-body bg-soft-light border border-dashed border-start-0 border-end-0">
                 <form>
                     <div class="row g-3">
                        <div class="col-xxl-5 col-sm-12">
                             <div class="search-box">
                                 {{-- Tambah atribut name dan value agar input manual dikirim saat submit dan nilai dipertahankan --}}
                                 <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control search bg-light border-light" placeholder="Cari...">
                                 <i class="ri-search-line search-icon"></i>
                             </div>
                         </div>
                         <!--end col-->
                         <div class="col-xxl-3 col-sm-4">
                             <div class="input-light">
                                 <select class="form-control" name="status" id="idStatus">
                                     <option value="">All</option>
                                     <option value="2" {{request('status') == '2' ? 'selected'  :''}}>Menunggu Pembayaran</option>
                                     <option value="1" {{request('status') == '1' ? 'selected'  :''}}>Lunas</option>
                                 </select>
                             </div>
                         </div>
                         <!--end col-->

                         <div class="col-lg-2 col-sm-4">
                             <a href="{{ route('panel.invoices.index')}}" class="btn btn-danger w-100"> <i class="ri-restart-line  me-1 align-bottom"></i>
                                 Reset
                             </a>
                         </div>
                         <div class="col-lg-2 col-sm-4">
                             <button type="submit" class="btn btn-primary w-100"> <i class="ri-search-line me-1 align-bottom"></i>
                                 Cari
                             </button>
                         </div>
                     </div>
                     <!--end row-->
                 </form>
             </div>
             <div class="card-body">


                 <!-- Striped Rows -->
                 <table class="table table-striped">
                     <thead class="table-light">
                         <tr>
                             <th scope="col">Nomor Transaksi</th>
                             <th scope="col" class="col-2"> Tryout</th>
                             <th scope="col" class="col-1">Siswa</th>
                             <th scope="col">Harga</th>
                             <th scope="col">Diskon</th>
                             <th scope="col">Total</th>
                             <th scope="col">Tanggal Transaksi</th>
                             <th scope="col">Due Date</th>
                             <th scope="col">Status</th>
                             <th scope="col">Tanggal Bayar</th>
                             <th scope="col" class="text-center">Action</th>
                         </tr>
                     </thead>
                    <tbody>
                        @forelse($invoices as $invoice)
                        <tr>
                            <td>#{{ $invoice->inv_id }}</td>
                            <td>{{ $invoice->tryout->tryout_judul ?? '' }}</td>
                            <td>{{ $invoice->peserta->tryout_peserta_name??'' }}</td>
                            <td>Rp.{{ $invoice->amount_rp }}</td>
                            <td>Rp.{{ $invoice->discount_rp }}</td>
                            <td>Rp.{{ $invoice->total_invoice_rp }}</td>
                            <td>{{ $invoice->inv_date_format }}</td>
                            <td>{{ $invoice->due_date_format }}</td>
                            <td>{!! $invoice->status_badge !!}</td>
                            <td>{{ $invoice->inv_paid_format }}</td>
                            <td class="text-center">
                                <a href="{{ route('panel.invoices.show',$invoice->inv_id)}}" class="btn rounded-pill btn-primary btn-sm">
                                    <i class="fa fa-edit"></i> Detail</a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center py-4">
                                @if(request('keyword'))
                                    Tidak ada data untuk kata kunci: "<strong>{{ request('keyword') }}</strong>".
                                @elseif(request('status') !== null && request('status') !== '')
                                    Tidak ada data untuk filter status saat ini.
                                @else
                                    Belum ada data pembayaran.
                                @endif
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                 </table>
                 {{ $invoices->withQueryString()->links() }}
             </div>
         </div>
     </div>
     <!--end col-->
 </div>



 @endsection
 @section('script')
 @endsection