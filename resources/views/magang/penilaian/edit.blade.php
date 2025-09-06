@extends('components.admin.layouts')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        @include('magang.penilaian.form', [
            'penilaian' => $penilaian,
            'action' => route('penilaian.update', [$magangId, $penilaian->id]),
            'method' => 'PUT',
            'magangs' => $datamagangs ?? [],
        ])
    </div>
@endsection
