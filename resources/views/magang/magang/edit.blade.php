@extends('components.admin.layouts')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        @include('magang.magang.form', [
            'magang' => $magang,
            'action' => route('magang.update', $magang->id),
            'method' => 'PUT',
            'profils' => $pesertas,
        ])
    </div>
@endsection
