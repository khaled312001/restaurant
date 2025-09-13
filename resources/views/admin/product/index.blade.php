@extends('admin.layout')

@php
$selLang = App\Models\Language::where('code', request()->input('language'))->first();
@endphp
@if(!empty($selLang) && $selLang->rtl == 1)
@section('styles')
<style>
    form:not(.modal-form) input,
    form:not(.modal-form) textarea,
    form:not(.modal-form) select,
    select[name='language'] {
        direction: rtl;
    }
    form:not(.modal-form) .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@endif

@section('content')
  <div class="page-header">
    <h4 class="page-title">Items</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('admin.dashboard')}}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Items Management</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Items</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card-title d-inline-block">Items</div>
                </div>
                <div class="col-lg-3">
                    @if (!empty($langs))
                        <select name="language" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>Select a Language</option>
                            @foreach ($langs as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                    <a href="{{route('admin.product.create') . '?language=' . request()->input('language')}}" class="btn btn-primary float-right btn-sm"><i class="fas fa-plus"></i> Add Item</a>
                    <button class="btn btn-success float-right btn-sm mr-2" onclick="exportProducts()"><i class="fas fa-download"></i> Export</button>
                    <button class="btn btn-info float-right btn-sm mr-2" onclick="toggleSearch()"><i class="fas fa-search"></i> Search</button>
                    <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="{{route('admin.product.bulk.delete')}}"><i class="flaticon-interface-5"></i> Delete</button>
                </div>
            </div>
        </div>
        <div class="card-body">
          <!-- Search Bar -->
          <div class="row mb-3" id="searchBar" style="display: none;">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <input type="text" class="form-control" id="searchTitle" placeholder="Search by title...">
                    </div>
                    <div class="col-md-2">
                      <select class="form-control" id="searchCategory">
                        <option value="">All Categories</option>
                        @if(isset($categories))
                          @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="col-md-2">
                      <select class="form-control" id="searchStatus">
                        <option value="">All Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <select class="form-control" id="searchFeatured">
                        <option value="">All Featured</option>
                        <option value="1">Featured</option>
                        <option value="0">Not Featured</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <select class="form-control" id="searchSpecial">
                        <option value="">All Special</option>
                        <option value="1">Special</option>
                        <option value="0">Not Special</option>
                      </select>
                    </div>
                    <div class="col-md-1">
                      <button class="btn btn-primary btn-sm" onclick="applySearch()"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-lg-12">
              @if (count($products) == 0)
                <h3 class="text-center">NO PRODUCT FOUND</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                            <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col">Title & Description</th>
                        <th scope="col">Prices ({{$be->base_currency_text}})</th>
                        <th scope="col">Category</th>
                        <th scope="col">Status</th>
                        <th scope="col">Featured</th>
                        <th scope="col">Special</th>
                        <th scope="col" width="15%">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($products as $key => $product)
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="{{$product->id}}">
                          </td>
                          <td>
                            <div class="product-info">
                              <h6 class="mb-1 font-weight-bold text-primary">
                                {{convertUtf8(strlen($product->title)) > 50 ? convertUtf8(substr($product->title, 0, 50)) . '...' : convertUtf8($product->title)}}
                              </h6>
                              <p class="mb-1 text-muted small">
                                {{convertUtf8(strlen($product->summary)) > 100 ? convertUtf8(substr($product->summary, 0, 100)) . '...' : convertUtf8($product->summary)}}
                              </p>
                              @if($product->product_type)
                                <span class="badge badge-info">{{$product->product_type}}</span>
                              @endif
                              <div class="mt-1">
                                <small class="text-muted">
                                  <i class="fas fa-calendar-alt"></i> {{$product->created_at->format('d/m/Y')}}
                                  @if($product->updated_at != $product->created_at)
                                    <br><i class="fas fa-edit"></i> {{$product->updated_at->format('d/m/Y')}}
                                  @endif
                                </small>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="price-info">
                              <div class="current-price mb-1">
                                <strong class="text-success">{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{$product->current_price}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</strong>
                                <small class="text-muted">Current</small>
                              </div>
                              @if($product->previous_price && $product->previous_price > $product->current_price)
                                <div class="previous-price mb-1">
                                  <del class="text-danger">{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{$product->previous_price}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</del>
                                  <small class="text-muted">Previous</small>
                                </div>
                              @endif
                              @if($product->price_seul)
                                <div class="price-seul mb-1">
                                  <small class="text-info">{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{$product->price_seul}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</small>
                                  <small class="text-muted">Seul</small>
                                </div>
                              @endif
                              @if($product->price_menu)
                                <div class="price-menu mb-1">
                                  <small class="text-warning">{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{$product->price_menu}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</small>
                                  <small class="text-muted">Menu</small>
                                </div>
                              @endif
                            </div>
                          </td>
                          <td>
                            @if($product->product_type)
                              <span class="badge badge-primary">{{$product->product_type}}</span>
                            @elseif ($product->category && $product->category->name)
                              <span class="badge badge-secondary">{{convertUtf8($product->category->name)}}</span>
                            @else
                              <span class="badge badge-warning">No Category</span>
                            @endif
                            @if ($product->subcategory && $product->subcategory->name)
                              <br><small class="text-muted">{{convertUtf8($product->subcategory->name)}}</small>
                            @endif
                          </td>
                          <td>
                            <span class="badge {{$product->status == 1 ? 'badge-success' : 'badge-danger'}}">
                              {{$product->status == 1 ? 'Active' : 'Inactive'}}
                            </span>
                          </td>
                          <td>
                            <form id="featureForm{{$product->id}}" action="{{route('admin.product.feature')}}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <select name="feature" id="" class="form-control-sm text-white
                                  @if($product->is_feature == 1)
                                  bg-success
                                  @elseif ($product->is_feature == 0)
                                  bg-danger
                                  @endif
                                " onchange="document.getElementById('featureForm{{$product->id}}').submit();">
                                    <option value="1" {{$product->is_feature == 1 ? 'selected' : ''}}>Yes</option>
                                    <option value="0" {{$product->is_feature == 0 ? 'selected' : ''}}>No</option>
                                </select>
                            </form>
                          </td>
                          <td>
                            <form id="specialForm{{$product->id}}" action="{{route('admin.product.special')}}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <select name="special" id="" class="form-control-sm text-white
                                  @if($product->is_special == 1)
                                  bg-success
                                  @elseif ($product->is_special == 0)
                                  bg-danger
                                  @endif
                                " onchange="document.getElementById('specialForm{{$product->id}}').submit();">
                                    <option value="1" {{$product->is_special == 1 ? 'selected' : ''}}>Yes</option>
                                    <option value="0" {{$product->is_special == 0 ? 'selected' : ''}}>No</option>
                                </select>
                            </form>
                          </td>
                          <td width="15%">
                            <a class="btn btn-secondary btn-sm p-2" href="{{route('admin.product.edit', $product->id) . '?language=' . request()->input('language')}}">
                              <i class="fas fa-edit"></i>
                            </a>
                            <form class="deleteform d-inline-block" action="{{route('admin.product.delete')}}" method="post">
                              @csrf
                              <input type="hidden" name="product_id" value="{{$product->id}}">
                              <button type="submit" class="btn btn-danger btn-sm deletebtn p-2">
                                <i class="fas fa-trash"></i>
                              </button>
                            </form>
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

      </div>
    </div>
  </div>

@endsection

@section('styles')
<style>
    .product-info h6 {
        font-size: 0.9rem;
        line-height: 1.2;
    }
    
    .product-info p {
        font-size: 0.8rem;
        line-height: 1.3;
    }
    
    .price-info {
        font-size: 0.85rem;
    }
    
    .price-info .current-price strong {
        font-size: 1rem;
    }
    
    .price-info .previous-price del {
        font-size: 0.8rem;
    }
    
    .price-info .price-seul,
    .price-info .price-menu {
        font-size: 0.75rem;
    }
    
    .table td {
        vertical-align: middle;
        padding: 0.75rem 0.5rem;
    }
    
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 1rem 0.5rem;
    }
    
    .badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }
    
    .img-thumbnail {
        border: 2px solid #dee2e6;
        transition: all 0.3s ease;
    }
    
    .img-thumbnail:hover {
        border-color: #007bff;
        transform: scale(1.05);
    }
    
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0,0,0,.02);
    }
    
    .table tbody tr:hover {
        background-color: rgba(0,123,255,.1);
    }
    
    .form-control-sm {
        font-size: 0.8rem;
        padding: 0.25rem 0.5rem;
    }
    
    .btn-sm {
        font-size: 0.8rem;
        padding: 0.25rem 0.5rem;
    }
    
    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #495057;
    }
    
    .table-responsive {
        border-radius: 0.375rem;
        overflow: hidden;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
    }
    
    .price-info div {
        border-left: 3px solid transparent;
        padding-left: 0.5rem;
        margin-bottom: 0.25rem;
    }
    
    .current-price {
        border-left-color: #28a745 !important;
    }
    
    .previous-price {
        border-left-color: #dc3545 !important;
    }
    
    .price-seul {
        border-left-color: #17a2b8 !important;
    }
    
    .price-menu {
        border-left-color: #ffc107 !important;
    }
    
</style>
@endsection

@section('scripts')
<script>
function toggleSearch() {
    try {
        const searchBar = document.getElementById('searchBar');
        if (searchBar.style.display === 'none') {
            searchBar.style.display = 'block';
        } else {
            searchBar.style.display = 'none';
        }
    } catch (error) {
        console.log('Toggle search error:', error);
    }
}

function applySearch() {
    try {
        const title = document.getElementById('searchTitle').value;
        const category = document.getElementById('searchCategory').value;
        const status = document.getElementById('searchStatus').value;
        const featured = document.getElementById('searchFeatured').value;
        const special = document.getElementById('searchSpecial').value;
        
        // Build URL with search parameters
        let url = new URL(window.location);
        url.searchParams.set('search_title', title);
        url.searchParams.set('search_category', category);
        url.searchParams.set('search_status', status);
        url.searchParams.set('search_featured', featured);
        url.searchParams.set('search_special', special);
        
        window.location.href = url.toString();
    } catch (error) {
        console.log('Search error:', error);
        alert('Error applying search. Please try again.');
    }
}

function exportProducts() {
    try {
        // Create CSV content
        let csvContent = "Title,Description,Current Price,Previous Price,Price Seul,Price Menu,Category,Status,Featured,Special,Created Date\n";
        
        // Get all table rows (skip header)
        const rows = document.querySelectorAll('#basic-datatables tbody tr');
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length > 0) {
            const title = cells[1].querySelector('h6') ? cells[1].querySelector('h6').textContent.trim() : '';
            const description = cells[1].querySelector('p') ? cells[1].querySelector('p').textContent.trim() : '';
            const currentPrice = cells[2].querySelector('.current-price strong') ? cells[2].querySelector('.current-price strong').textContent.trim() : '';
            const previousPrice = cells[2].querySelector('.previous-price del') ? cells[2].querySelector('.previous-price del').textContent.trim() : '';
            const priceSeul = cells[2].querySelector('.price-seul small') ? cells[2].querySelector('.price-seul small').textContent.trim() : '';
            const priceMenu = cells[2].querySelector('.price-menu small') ? cells[2].querySelector('.price-menu small').textContent.trim() : '';
            const category = cells[3].querySelector('.badge') ? cells[3].querySelector('.badge').textContent.trim() : '';
            const status = cells[4].querySelector('.badge') ? cells[4].querySelector('.badge').textContent.trim() : '';
            const featured = cells[5].querySelector('select') ? (cells[5].querySelector('select').value === '1' ? 'Yes' : 'No') : 'No';
            const special = cells[6].querySelector('select') ? (cells[6].querySelector('select').value === '1' ? 'Yes' : 'No') : 'No';
            const createdDate = cells[1].querySelector('.mt-1 small') ? cells[1].querySelector('.mt-1 small').textContent.split(' ')[1] : '';
            
            csvContent += `"${title}","${description}","${currentPrice}","${previousPrice}","${priceSeul}","${priceMenu}","${category}","${status}","${featured}","${special}","${createdDate}"\n`;
            }
        });
        
        // Download CSV
        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'products_export_' + new Date().toISOString().split('T')[0] + '.csv';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
    } catch (error) {
        console.log('Export error:', error);
        alert('Error exporting products. Please try again.');
    }
}

// Initialize DataTable with enhanced features
$(document).ready(function() {
    try {
        // Check if DataTable is already initialized
        if ($.fn.DataTable.isDataTable('#basic-datatables')) {
            $('#basic-datatables').DataTable().destroy();
        }
        
        $('#basic-datatables').DataTable({
            "pageLength": 25,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "order": [[0, "desc"]],
        "columnDefs": [
            { "orderable": false, "targets": [0, 4, 5, 6] }
        ],
            "language": {
                "search": "Search products:",
                "lengthMenu": "Show _MENU_ products per page",
                "info": "Showing _START_ to _END_ of _TOTAL_ products",
                "infoEmpty": "No products available",
                "infoFiltered": "(filtered from _MAX_ total products)"
            }
        });
    } catch (error) {
        console.log('DataTable initialization error:', error);
        // Fallback to basic table if DataTable fails
        $('#basic-datatables').addClass('table table-striped');
    }
});
</script>
@endsection
