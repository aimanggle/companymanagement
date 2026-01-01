@extends('layout.index')
@section('title', 'Companies List')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2">
            <div>
                <h3 class="mb-0">Companies</h3>
                <small class="text-muted">Manage your companies — add, edit or remove entries.</small>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('companies.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-lg"></i> Add New
                </a>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">  
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>       
            </div>
            @endif

            @if($companies->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-briefcase fs-1 text-muted"></i>
                <h5 class="mt-3">No companies found</h5>
                <p class="text-muted">Click the button above to add your first company.</p>
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0"> 
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Website</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                        <tr>
                            <th scope="row">{{ $company->id }}</th>
                            <td class="align-middle" style="width:80px;">
                                @if($company->logo)
                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} logo" class="img-fluid rounded" style="max-width:64px; max-height:64px; object-fit:contain;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light border rounded" style="width:64px;height:64px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="align-middle">{{ $company->name }}</td>
                            <td class="align-middle">{{ $company->email }}</td>
                            <td class="align-middle">
                                @if($company->website)
                                    <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this company?');" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @endif
        </div>
    </div>
</div>
@endsection

