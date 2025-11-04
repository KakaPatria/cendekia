@extends('layouts.panel.master')
@section('title', 'Edit Kelas Cendekia')

@section('content')
@component('components.breadcrumb')
@slot('li_1') Kelas @endslot
@slot('title') Edit Kelas Cendekia @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Kelas: {{ $kelas->kelas_cendekia_nama }}</h5>
            </div>
            <div class="card-body">
                {{-- Form ini akan mengirim ke fungsi update() --}}
                <form action="{{ route('panel.kelas_cendekia.update', $kelas->kelas_cendekia_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Nama kelas</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="kelas_cendekia_nama" 
                                   value="{{ old('kelas_cendekia_nama', $kelas->kelas_cendekia_nama) }}" required />
                        </div>
                    </div>
                    
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Jenjang</label>
                        <div class="col-md-9">
                            <select class="form-control" name="jenjang" required>
                                <option value="SD" {{ $kelas->jenjang == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ $kelas->jenjang == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA" {{ $kelas->jenjang == 'SMA' ? 'selected' : '' }}>SMA</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Kelas</label>
                        <div class="col-md-9">
                            {{-- Anda bisa menggunakan logika JS yang sama dari index.blade.php jika perlu --}}
                            <input type="text" class="form-control" name="kelas" 
                                   value="{{ old('kelas', $kelas->kelas) }}" required />
                        </div>
                    </div>
                    
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Keterangan</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="kelas_cendekia_keterangan" rows="5">{{ old('kelas_cendekia_keterangan', $kelas->kelas_cendekia_keterangan) }}</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Status</label>
                        <div class="col-md-9">
                            <select class="form-control" name="status" required>
                                <option value="Aktif" {{ $kelas->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak Aktif" {{ $kelas->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="{{ route('panel.kelas_cendekia.index') }}" class="btn btn-light">Batal</a>
                        <button typeT="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection