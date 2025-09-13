@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus-circle"></i> Gestion des Add-ons et Personnalisations
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.customizations.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Ajouter un Add-on
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif

                    @foreach($groupedAddons as $category => $data)
                        @if($data['items']->count() > 0)
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">
                                    <i class="fas fa-tags"></i> {{ $data['label'] }}
                                    <span class="badge badge-light">{{ $data['items']->count() }}</span>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($data['items'] as $addon)
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="card h-100 {{ $addon->is_active ? 'border-success' : 'border-secondary' }}">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <h5 class="card-title mb-0">{{ $addon->name }}</h5>
                                                    <div class="btn-group btn-group-sm">
                                                        <button class="btn btn-outline-{{ $addon->is_active ? 'success' : 'secondary' }} btn-sm" 
                                                                onclick="toggleStatus({{ $addon->id }})">
                                                            <i class="fas fa-{{ $addon->is_active ? 'check' : 'times' }}"></i>
                                                        </button>
                                                        <a href="{{ route('admin.customizations.edit', $addon->id) }}" 
                                                           class="btn btn-outline-primary btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button class="btn btn-outline-danger btn-sm" 
                                                                onclick="deleteAddon({{ $addon->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="mb-2">
                                                    <span class="badge badge-info">€{{ number_format($addon->price, 2) }}</span>
                                                    @if($addon->sort_order)
                                                        <span class="badge badge-secondary">Ordre: {{ $addon->sort_order }}</span>
                                                    @endif
                                                </div>
                                                
                                                @if($addon->description)
                                                <p class="card-text text-muted small">{{ $addon->description }}</p>
                                                @endif
                                                
                                                @if($addon->product_types && count($addon->product_types) > 0)
                                                <div class="mb-2">
                                                    <small class="text-muted">Types de produits:</small><br>
                                                    @foreach($addon->product_types as $type)
                                                        <span class="badge badge-light">{{ \App\Models\Addon::PRODUCT_TYPES[$type] ?? $type }}</span>
                                                    @endforeach
                                                </div>
                                                @endif
                                                
                                                @if($addon->icon)
                                                <div class="mb-2">
                                                    <i class="{{ $addon->icon }}"></i>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cet add-on ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function deleteAddon(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet add-on ?')) {
        fetch(`/admin/customizations/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => {
            if (response.ok) {
                location.reload();
            }
        });
    }
}

function toggleStatus(id) {
    fetch(`/admin/customizations/${id}/toggle-status`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}
</script>
@endsection 