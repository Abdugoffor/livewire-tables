@extends('layouts.admin')
@section('content')
    <div>
        <h2 class="text-2xl font-bold text-dark-700 mb-4">Простой</h1>
            <livewire:create-prostoy />
            <livewire:prostoy-table />
    </div>
@endsection
