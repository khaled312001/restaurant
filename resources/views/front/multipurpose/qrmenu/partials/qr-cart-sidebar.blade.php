<div class="cart-sidebar">
    <div id="refreshDiv">
    <div class="cart-sidebar-loader-container show">
        <div class="cart-sidebar-loader"></div>
    </div>
    <div class="cart-header">
       <h3>{{__('Cart')}}</h3>
       <span class="close">
        <i class="fas fa-times"></i>
       </span>
    </div>
    <div class="cart-body">

            @if($cart != null)
            @foreach ($cart as $key => $item)
            @php
            $id = $item["id"];
            $product = App\Models\Product::findOrFail($id);
            @endphp
            <div class="cart-item">
               <div class="details">
                  <h4 class="title mb-0">
                     <a>{{convertUtf8($item['name'])}}</a>
                  </h4>
                  
                  <!-- Customization Details -->
                  <div class="customization-details">
                      @if(isset($item['customizations']))
                          @php
                              $customizations = $item['customizations'];
                          @endphp
                          
                          <!-- Meat Choice -->
                          @if(isset($customizations['meatChoice']) && $customizations['meatChoice'])
                              <div class="customization-item">
                                  <strong><i class="fas fa-drumstick-bite text-danger"></i> Viande:</strong>
                                  <span class="badge badge-primary">{{ ucfirst($customizations['meatChoice']) }}</span>
                              </div>
                          @endif
                          
                          <!-- Vegetables -->
                          @if(isset($customizations['vegetables']) && is_array($customizations['vegetables']) && count($customizations['vegetables']) > 0)
                              <div class="customization-item">
                                  <strong><i class="fas fa-leaf text-success"></i> Légumes:</strong>
                                  @foreach($customizations['vegetables'] as $vegetable)
                                      <span class="badge badge-success">{{ ucfirst(str_replace('-', ' ', $vegetable)) }}</span>
                                  @endforeach
                              </div>
                          @endif
                          
                          <!-- Drinks -->
                          @if(isset($customizations['drinkChoice']) && $customizations['drinkChoice'])
                              <div class="customization-item">
                                  <strong><i class="fas fa-glass-whiskey text-info"></i> Boisson:</strong>
                                  <span class="badge badge-info">{{ ucfirst(str_replace('-', ' ', $customizations['drinkChoice'])) }}</span>
                              </div>
                          @endif
                          
                          <!-- Sauces -->
                          @if(isset($customizations['sauces']) && is_array($customizations['sauces']) && count($customizations['sauces']) > 0)
                              <div class="customization-item">
                                  <strong><i class="fas fa-fire text-warning"></i> Sauces:</strong>
                                  @foreach($customizations['sauces'] as $sauce)
                                      <span class="badge badge-warning">{{ ucfirst(str_replace('-', ' ', $sauce)) }}</span>
                                  @endforeach
                              </div>
                          @endif
                      @else
                          <!-- Fallback to old variations/addons system -->
                          @if (!empty($item["variations"]))
                              <div class="customization-item">
                                  <strong><i class="fas fa-cog text-primary"></i> Variations:</strong>
                                  @php
                                      $variations = $item["variations"];
                                  @endphp
                                  @foreach ($variations as $vKey => $variation)
                                      <span class="badge badge-primary">{{str_replace("_"," ",$vKey)}}: {{$variation["name"]}}</span>
                                      @if (!$loop->last) @endif
                                  @endforeach    
                              </div>
                          @endif
                          
                          @if (!empty($item["addons"]))
                              <div class="customization-item">
                                  <strong><i class="fas fa-plus text-success"></i> Suppléments:</strong>
                                  @php
                                      $addons = $item["addons"];
                                  @endphp
                                  @foreach ($addons as $addon)
                                      <span class="badge badge-success">{{$addon["name"]}}</span>
                                      @if (!$loop->last) @endif
                                  @endforeach
                              </div>
                          @endif
                      @endif
                  </div>
                  
                  <div class="cart-item-controls">
                     <div class="quantity-controls">
                        <button class="qty-btn decrease" data-key="{{ $key }}">-</button>
                        <span class="qty-display">{{ $item['qty'] }}</span>
                        <button class="qty-btn increase" data-key="{{ $key }}">+</button>
                     </div>
                     <div class="price-info">
                        <span class="item-price">{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{number_format($item['total'], 2)}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</span>
                        <button class="remove-btn" data-key="{{ $key }}">
                           <i class="fas fa-trash"></i>
                        </button>
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
            @else
            <div class="empty-cart">
               <p>{{__('Cart is empty')}}</p>
            </div>
            @endif
        </div>
        
        @if($cart != null && count($cart) > 0)
        <div class="cart-footer">
           <div class="cart-total">
              <span>{{__('Total')}}:</span>
              <span class="total-amount">{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}<span id="cartTotal">{{number_format($cartTotal, 2)}}</span>{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</span>
           </div>
           <div class="cart-actions">
              <a href="{{route('front.qrmenu.checkout')}}" class="checkout-btn">{{__('Checkout')}}</a>
           </div>
        </div>
        @endif
    </div>
</div>

<style>
.customization-details {
    margin: 8px 0;
}

.customization-item {
    margin-bottom: 4px;
    padding: 2px 0;
}

.customization-item strong {
    display: inline-block;
    margin-right: 6px;
    color: #2c3e50;
    font-size: 0.8rem;
}

.customization-item .badge {
    margin-right: 3px;
    margin-bottom: 2px;
    font-size: 0.7rem;
    padding: 2px 5px;
}

.badge-primary {
    background-color: #3498db;
    color: white;
}

.badge-success {
    background-color: #27ae60;
    color: white;
}

.badge-info {
    background-color: #17a2b8;
    color: white;
}

.badge-warning {
    background-color: #f39c12;
    color: white;
}

.badge-danger {
    background-color: #e74c3c;
    color: white;
}

.cart-item-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 8px;
}

.qty-btn {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-weight: bold;
    color: #495057;
}

.qty-btn:hover {
    background: #e9ecef;
}

.qty-display {
    font-weight: 600;
    color: #2c3e50;
    min-width: 20px;
    text-align: center;
}

.price-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.item-price {
    font-weight: 600;
    color: #f39c12;
    font-size: 0.9rem;
}

.remove-btn {
    background: #e74c3c;
    color: white;
    border: none;
    border-radius: 4px;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 0.8rem;
}

.remove-btn:hover {
    background: #c0392b;
}

.cart-footer {
    border-top: 1px solid #dee2e6;
    padding-top: 15px;
    margin-top: 15px;
}

.cart-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    font-weight: 600;
    color: #2c3e50;
}

.total-amount {
    color: #f39c12;
    font-size: 1.1rem;
}

.cart-actions {
    text-align: center;
}

.checkout-btn {
    background: linear-gradient(45deg, #f39c12, #e67e22);
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 20px;
    display: inline-block;
    font-weight: 600;
    transition: all 0.3s ease;
}

.checkout-btn:hover {
    background: linear-gradient(45deg, #e67e22, #d68910);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
    color: white;
    text-decoration: none;
}
</style>
