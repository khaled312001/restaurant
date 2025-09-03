@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Customizations Management</h3>
                    <div class="card-tools">
                        <span class="badge badge-primary">{{ $customizations->total() }} Total</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Type</th>
                                    <th>Meat Choice</th>
                                    <th>Vegetables</th>
                                    <th>Drink</th>
                                    <th>Sauces</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customizations as $customization)
                                <tr>
                                    <td>{{ $customization->id }}</td>
                                    <td>
                                        <strong>{{ $customization->product_name }}</strong>
                                        @if($customization->orderItem)
                                            @if(isset($customization->is_json) && $customization->is_json)
                                                <br><small class="text-muted">Order: #{{ $customization->orderItem->product_order_id }}</small>
                                            @else
                                                <br><small class="text-muted">Order: #{{ $customization->orderItem->order_id ?? $customization->orderItem->product_order_id }}</small>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $customization->product_type }}</span>
                                    </td>
                                    <td>
                                        @if($customization->meat_choice)
                                            <span class="badge badge-danger">{{ ucfirst($customization->meat_choice) }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($customization->vegetables && count($customization->vegetables) > 0)
                                            <span class="badge badge-success">{{ $customization->vegetables_text }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($customization->drink_choice)
                                            <span class="badge badge-primary">{{ $customization->drink_text }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($customization->sauces && count($customization->sauces) > 0)
                                            <span class="badge badge-warning">{{ $customization->sauces_text }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-secondary">{{ $customization->quantity }}</span>
                                    </td>
                                    <td>
                                        <strong>€{{ number_format($customization->price, 2) }}</strong>
                                    </td>
                                    <td>
                                        <small>{{ $customization->created_at->format('d/m/Y H:i') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if(!isset($customization->is_json) || !$customization->is_json)
                                                <a href="{{ route('admin.customizations.show', $customization->id) }}" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" 
                                                        onclick="deleteCustomization({{ $customization->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @else
                                                <span class="text-muted">View in Order</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        {{ $customizations->links() }}
                    </div>
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
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this customization?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function deleteCustomization(id) {
    if (confirm('Are you sure you want to delete this customization?')) {
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
</script>
@endsection 