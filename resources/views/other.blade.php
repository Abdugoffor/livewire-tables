@extends('layouts.admin')
@section('content')
    <div>
        <h1 class="text-2xl font-bold text-dark-700 mb-4">Другие расходы</h1>
        <livewire:create-othe-expense />
        <livewire:othe-expense-table />
    </div>
@endsection
