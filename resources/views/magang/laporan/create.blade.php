@extends('components.admin.layouts')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        @include('magang.laporan.form', [
            'laporan' => null,
            'action' => route('laporan.store'),
            'method' => 'POST',
            'magangs' => $dataMagangList,
        ])
    </div>
@endsection
