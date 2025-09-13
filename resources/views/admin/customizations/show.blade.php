@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-eye"></i> Détails de l'Add-on: {{ $addon->name }}
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.customizations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Nom (Anglais)</th>
                                    <td>{{ $addon->name }}</td>
                                </tr>
                                <tr>
                                    <th>Catégorie</th>
                                    <td>
                                        <span class="badge badge-primary">{{ $addon->category_label }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Prix</th>
                                    <td><strong>€{{ number_format($addon->price, 2) }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Statut</th>
                                    <td>
                                        <span class="badge badge-{{ $addon->is_active ? 'success' : 'secondary' }}">
                                            {{ $addon->is_active ? 'Actif' : 'Inactif' }}
                                        </span>
                                    </td>
                                </tr>
                                @if($addon->sort_order)
                                <tr>
                                    <th>Ordre d'affichage</th>
                                    <td>{{ $addon->sort_order }}</td>
                                </tr>
                                @endif
                                @if($addon->icon)
                                <tr>
                                    <th>Icône</th>
                                    <td><i class="{{ $addon->icon }}"></i> {{ $addon->icon }}</td>
                                </tr>
                                @endif
                                @if($addon->description)
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $addon->description }}</td>
                                </tr>
                                @endif
                                @if($addon->product_types && count($addon->product_types) > 0)
                                <tr>
                                    <th>Types de produits</th>
                                    <td>
                                        @foreach($addon->product_types as $type)
                                            <span class="badge badge-light">{{ \App\Models\Addon::PRODUCT_TYPES[$type] ?? $type }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Créé le</th>
                                    <td>{{ $addon->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Modifié le</th>
                                    <td>{{ $addon->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Actions</h5>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('admin.customizations.edit', $addon->id) }}" 
                                       class="btn btn-primary btn-block mb-2">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <button class="btn btn-{{ $addon->is_active ? 'warning' : 'success' }} btn-block mb-2" 
                                            onclick="toggleStatus({{ $addon->id }})">
                                        <i class="fas fa-{{ $addon->is_active ? 'pause' : 'play' }}"></i> 
                                        {{ $addon->is_active ? 'Désactiver' : 'Activer' }}
                                    </button>
                                    <button class="btn btn-danger btn-block" 
                                            onclick="deleteAddon({{ $addon->id }})">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                window.location.href = '/admin/customizations';
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