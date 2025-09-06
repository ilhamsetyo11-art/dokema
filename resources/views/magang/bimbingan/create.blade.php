@extends('components.admin.layouts')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        @include('magang.bimbingan.form', [
            'logBimbingan' => null,
            'action' => route('bimbingan.store', $magangId),
            'method' => 'POST',
            'magangs' => $datamagangs ?? [],
        ])
    </div>
@endsection
