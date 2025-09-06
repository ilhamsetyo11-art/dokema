@extends('components.admin.layouts')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        @include('magang.bimbingan.form', [
            'logBimbingan' => $log,
            'action' => route('bimbingan.update', [$magangId, $log->id]),
            'method' => 'PUT',
            'magangs' => $datamagangs ?? [],
        ])
    </div>
@endsection
