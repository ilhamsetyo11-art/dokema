@extends('components.admin.layouts')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        @include('magang.magang.form', [
            'magang' => null,
            'action' => route('magang.store'),
            'method' => 'POST',
            'profils' => $pesertas,
        ])
    </div>
@endsection
