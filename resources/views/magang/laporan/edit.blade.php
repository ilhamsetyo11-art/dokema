@extends('components.admin.layouts')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        @include('magang.laporan.form', [
            'laporan' => $laporan,
            'action' => route('laporan.update', [$magangId, $laporan->id]),
            'method' => 'PUT',
            'magangs' => $dataMagangList,
        ])
    </div>
@endsection
