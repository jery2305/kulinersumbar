@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold">{{ isset($rating) ? 'Edit Rating' : 'Tambah Rating' }}</h1>

    {{-- Error message --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Flash success --}}
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form 
        action="{{ isset($rating) ? route('admin.rating.update', $rating) : route('admin.rating.store') }}" 
        method="POST">
        @csrf
        @if(isset($rating)) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Rating (1–5)</label>
            <input type="number" name="rating" class="form-control" min="1" max="5"
                value="{{ old('rating', $rating->rating ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Review</label>
            <textarea name="review" class="form-control" rows="4" required>{{ old('review', $rating->review ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Menu</label>
            <select name="menu_id" class="form-select" required>
                <option value="">-- Pilih Menu --</option>
                @foreach ($menus as $menu)
                    <option value="{{ $menu->id }}" {{ old('menu_id', $rating->menu_id ?? '') == $menu->id ? 'selected' : '' }}>
                        {{ $menu->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($rating) ? 'Update' : 'Simpan' }}</button>
        <a href="{{ route('admin.rating.index') }}" class="btn btn-outline-secondary ms-2">Kembali</a>
    </form>
</div>
@endsection
