@extends('layout.index')

@section('title', 'Edit Company')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Company</h1>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('companies.update', $company->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $company->email }}">
                </div>

                <div class="mb-3">
                    <label for="website" class="form-label">Website</label>
                    <input type="url" class="form-control" id="website" name="website" value="{{ $company->website }}">
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label">Logo (optional)</label>
                    <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                    <small class="form-text text-muted">Minimum size: 100x100px. Max size: 2MB.</small>
                    <div id="logo-feedback" class="text-danger small mt-1 d-none"></div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('companies.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    (function(){
        const input = document.getElementById('logo');
        const feedback = document.getElementById('logo-feedback');
        const form = input ? input.closest('form') : null;
        const submit = form ? form.querySelector('button[type="submit"]') : null;

        function showError(msg){
            feedback.textContent = msg;
            feedback.classList.remove('d-none');
            if(submit) submit.disabled = true;
        }

        function clearError(){
            feedback.textContent = '';
            feedback.classList.add('d-none');
            if(submit) submit.disabled = false;
        }

        if(!input) return;

        input.addEventListener('change', function(e){
            clearError();
            const file = this.files && this.files[0];
            if(!file) return;

            // Check file size (2MB)
            const maxBytes = 2 * 1024 * 1024;
            if(file.size > maxBytes){
                showError('Logo must be 2MB or smaller.');
                return;
            }

            // Check image dimensions
            const url = URL.createObjectURL(file);
            const img = new Image();
            img.onload = function(){
                if(img.naturalWidth < 100 || img.naturalHeight < 100){
                    showError('Logo dimensions must be at least 100x100 pixels.');
                } else {
                    clearError();
                }
                URL.revokeObjectURL(url);
            };
            img.onerror = function(){
                showError('Unable to read image file.');
                URL.revokeObjectURL(url);
            };
            img.src = url;
        });
    })();
</script>
@endsection