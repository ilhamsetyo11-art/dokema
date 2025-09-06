@extends('components.admin.layouts')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        @include('magang.penilaian.form', [
            'penilaian' => null,
            'action' => route('penilaian.store', $magangId),
            'method' => 'POST',
            'magangs' => $datamagangs ?? [],
        ])
    </div>
@endsection
