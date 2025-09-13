{{-- eslint-disable --}}
@extends('front.layout')
@section('content')

<!--====== PAGE TITLE PART START ======-->
<section class="page-title-area d-flex align-items-center lazy" data-bg="{{asset('assets/front/img/'.$bs->breadcrumb)}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h2 class="title">Menus Enfant</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front.index')}}"><i class="flaticon-home"></i>{{__('Home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('front.sandwiches')}}">Notre Carte</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Menus Enfant</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== PAGE TITLE PART ENDS ======-->

<!-- Menu Section -->
<div class="menu-section" style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <!-- Full Width Menu -->
            <div class="col-12">
                <!-- Main Menus Enfant -->
                <div class="menu-category" style="background: #2c3e50; border-radius: 20px; padding: 30px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <h2 style="color: #e91e63; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center;">
                        MENUS ENFANT
                    </h2>
                    
                    <div class="menu-table" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px;">
                        <!-- Desktop Header -->
                        <div class="table-header desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 15px; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #e91e63;">
                            <span style="color: #e91e63; font-weight: 600; font-size: 1.1rem;">Menu</span>
                            <span style="color: #e91e63; font-weight: 600; font-size: 1.1rem; text-align: center;">Seul</span>
                            <span style="color: #e91e63; font-weight: 600; font-size: 1.1rem; text-align: center;">Menu</span>
                            <span style="color: #e91e63; font-weight: 600; font-size: 1.1rem; text-align: center;">Commander</span>
                        </div>
                        
                        <!-- Desktop Layout -->
                        @foreach($products as $product)
                        <div class="menu-item desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 15px; align-items: center; padding: 15px 0; {{ !$loop->last ? 'border-bottom: 1px solid rgba(255,255,255,0.2);' : '' }}">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">{{ strtoupper($product->title) }}</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">{{ number_format($product->price_seul, 2, ',', '') }}€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">{{ number_format($product->price_menu, 2, ',', '') }}€</span>
                            <div style="text-align: center;">
                                <a href="{{ route('front.menusEnfant.addons') }}?type=seul&product={{ $product->slug }}" class="btn btn-warning btn-sm" style="background: #e91e63; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; margin-bottom: 8px; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.menusEnfant.addons') }}?type=menu&product={{ $product->slug }}" class="btn btn-warning btn-sm" style="background: #f06292; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        @endforeach
                        
                        <!-- Mobile Layout -->
                        <div class="menu-item-mobile mobile-only" style="background: rgba(255,255,255,0.05); border-radius: 15px; padding: 20px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.1);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.2rem;">MENU ENFANT</h4>
                                <div style="text-align: right;">
                                    <div style="color: #e91e63; font-size: 0.9rem; margin-bottom: 5px;">Prix</div>
                                </div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Seul</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">8,50€</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Menu</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">11,50€</span>
                            </div>
                            
                            <div style="text-align: center;">
                                <a href="{{ route('front.menusEnfant.addons') }}?type=seul" class="btn btn-warning" style="background: #e91e63; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; margin-bottom: 10px; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.menusEnfant.addons') }}?type=menu" class="btn btn-warning" style="background: #f06292; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        
                        <!-- Desktop Layout -->
                        <div class="menu-item desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 15px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">BURGER + FRITES</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">9,00€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">12,00€</span>
                            <div style="text-align: center;">
                                <a href="{{ route('front.menusEnfant.addons') }}?type=seul" class="btn btn-warning btn-sm" style="background: #e91e63; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; margin-bottom: 8px; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.menusEnfant.addons') }}?type=menu" class="btn btn-warning btn-sm" style="background: #f06292; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        
                        <!-- Mobile Layout -->
                        <div class="menu-item-mobile mobile-only" style="background: rgba(255,255,255,0.05); border-radius: 15px; padding: 20px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.1);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.2rem;">BURGER + FRITES</h4>
                                <div style="text-align: right;">
                                    <div style="color: #e91e63; font-size: 0.9rem; margin-bottom: 5px;">Prix</div>
                                </div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Seul</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">9,00€</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Menu</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">12,00€</span>
                            </div>
                            
                            <div style="text-align: center;">
                                <a href="{{ route('front.menusEnfant.addons') }}?type=seul" class="btn btn-warning" style="background: #e91e63; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; margin-bottom: 10px; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.menusEnfant.addons') }}?type=menu" class="btn btn-warning" style="background: #f06292; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        
                        <!-- Desktop Layout -->
                        <div class="menu-item desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 15px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">NUGGETS + FRITES</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">8,00€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">11,00€</span>
                            <div style="text-align: center;">
                                <a href="{{ route('front.menusEnfant.addons') }}?type=seul" class="btn btn-warning btn-sm" style="background: #e91e63; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; margin-bottom: 8px; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.menusEnfant.addons') }}?type=menu" class="btn btn-warning btn-sm" style="background: #f06292; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        
                        <!-- Mobile Layout -->
                        <div class="menu-item-mobile mobile-only" style="background: rgba(255,255,255,0.05); border-radius: 15px; padding: 20px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.1);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.2rem;">NUGGETS + FRITES</h4>
                                <div style="text-align: right;">
                                    <div style="color: #e91e63; font-size: 0.9rem; margin-bottom: 5px;">Prix</div>
                                </div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Seul</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">8,00€</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Menu</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">11,00€</span>
                            </div>
                            
                            <div style="text-align: center;">
                                <a href="{{ route('front.menusEnfant.addons') }}?type=seul" class="btn btn-warning" style="background: #e91e63; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; margin-bottom: 10px; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.menusEnfant.addons') }}?type=menu" class="btn btn-warning" style="background: #f06292; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        
                        <!-- Desktop Layout -->
                        <div class="menu-item desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 15px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">VIANDE KEBAB + FRITES</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">9,50€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">12,50€</span>
                            <div style="text-align: center;">
                                <a href="{{ route('front.menusEnfant.addons') }}?type=seul" class="btn btn-warning btn-sm" style="background: #e91e63; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; margin-bottom: 8px; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.menusEnfant.addons') }}?type=menu" class="btn btn-warning btn-sm" style="background: #f06292; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        
                        <!-- Mobile Layout -->
                        <div class="menu-item-mobile mobile-only" style="background: rgba(255,255,255,0.05); border-radius: 15px; padding: 20px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.1);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.2rem;">VIANDE KEBAB + FRITES</h4>
                                <div style="text-align: right;">
                                    <div style="color: #e91e63; font-size: 0.9rem; margin-bottom: 5px;">Prix</div>
                                </div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Seul</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">9,50€</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Menu</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">12,50€</span>
                            </div>
                            
                            <div style="text-align: center;">
                                <a href="{{ route('front.menusEnfant.addons') }}?type=seul" class="btn btn-warning" style="background: #e91e63; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; margin-bottom: 10px; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.menusEnfant.addons') }}?type=menu" class="btn btn-warning" style="background: #f06292; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desserts Section -->
                <div class="menu-category" style="background: #2c3e50; border-radius: 20px; padding: 30px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <h2 style="color: #e91e63; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center;">
                        DESSERTS ENFANT
                    </h2>
                    
                    <div class="menu-table" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px;">
                        <!-- Desktop Header -->
                        <div class="table-header desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #e91e63;">
                            <span style="color: #e91e63; font-weight: 600; font-size: 1.1rem;">Dessert</span>
                            <span style="color: #e91e63; font-weight: 600; font-size: 1.1rem; text-align: center;">Prix</span>
                            <span style="color: #e91e63; font-weight: 600; font-size: 1.1rem; text-align: center;">Commander</span>
                        </div>
                        
                        <!-- Desktop Layout -->
                        <div class="menu-item desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">COMPOTE + CAPRISUN + JOUET</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">3,50€</span>
                            <div style="text-align: center;">
                                <a href="{{ route('front.menusEnfant.addons') }}?type=seul" class="btn btn-warning btn-sm" style="background: #e91e63; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; text-decoration: none; display: inline-block;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                                    Commander
                                </a>
                            </div>
                        </div>
                        
                        <!-- Mobile Layout -->
                        <div class="menu-item-mobile mobile-only" style="background: rgba(255,255,255,0.05); border-radius: 15px; padding: 20px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.1);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.2rem;">COMPOTE + CAPRISUN + JOUET</h4>
                                <div style="text-align: right;">
                                    <div style="color: #e91e63; font-size: 0.9rem; margin-bottom: 5px;">Prix</div>
                                </div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Prix</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">3,50€</span>
                            </div>
                            
                            <div style="text-align: center;">
                                <a href="{{ route('front.menusEnfant.addons') }}?type=seul" class="btn btn-warning" style="background: #e91e63; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; display: inline-block;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 8px;"></i>
                                    Commander
                                </a>
                            </div>
                        </div>
                        
                        <!-- Desktop Layout -->
                        <div class="menu-item desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px; align-items: center; padding: 15px 0;">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">GLACE VANILLE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">2,50€</span>
                            <div style="text-align: center;">
                                <a href="{{ route('front.menusEnfant.addons') }}?type=seul" class="btn btn-warning btn-sm" style="background: #e91e63; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; text-decoration: none; display: inline-block;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                                    Commander
                                </a>
                            </div>
                        </div>
                        
                        <!-- Mobile Layout -->
                        <div class="menu-item-mobile mobile-only" style="background: rgba(255,255,255,0.05); border-radius: 15px; padding: 20px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.1);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.2rem;">GLACE VANILLE</h4>
                                <div style="text-align: right;">
                                    <div style="color: #e91e63; font-size: 0.9rem; margin-bottom: 5px;">Prix</div>
                                </div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Prix</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">2,50€</span>
                            </div>
                            
                            <div style="text-align: center;">
                                <a href="{{ route('front.menusEnfant.addons') }}?type=seul" class="btn btn-warning" style="background: #e91e63; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; display: inline-block;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 8px;"></i>
                                    Commander
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="cta-section" style="padding: 80px 0; background: linear-gradient(135deg, #e91e63 0%, #ad1457 100%); text-align: center; color: white;">
    <div class="container">
        <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 20px;">
            Prêt à régaler vos enfants ?
        </h2>
        <p style="font-size: 1.2rem; margin-bottom: 30px; opacity: 0.9;">
            Commandez maintenant et offrez un repas délicieux à vos enfants
        </p>
        <div class="cta-buttons">
            <a href="{{ route('front.sandwiches') }}" class="btn btn-light btn-lg" style="padding: 15px 40px; font-size: 1.1rem; font-weight: 600; border-radius: 30px; text-decoration: none; transition: all 0.3s ease; margin-right: 20px;">
                <i class="fas fa-arrow-left" style="margin-right: 10px;"></i>
                Retour au menu
            </a>
            <a href="{{ route('front.index') }}" class="btn btn-outline-light btn-lg" style="padding: 15px 40px; font-size: 1.1rem; font-weight: 600; border-radius: 30px; text-decoration: none; transition: all 0.3s ease; border: 2px solid white;">
                <i class="fas fa-home" style="margin-right: 10px;"></i>
                Accueil
            </a>
        </div>
    </div>
</div>

<!-- Responsive CSS -->
<style>
@media (max-width: 768px) {
    .desktop-only {
        display: none !important;
    }
    .mobile-only {
        display: block !important;
    }
}

@media (min-width: 769px) {
    .mobile-only {
        display: none !important;
    }
    .desktop-only {
        display: grid !important;
    }
}

.menu-item:hover {
    background: rgba(255,255,255,0.05);
    border-radius: 10px;
    transition: all 0.3s ease;
}

.menu-item-mobile:hover {
    background: rgba(255,255,255,0.1) !important;
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}
</style>


<!-- JavaScript for cart functionality -->
<script>
// Set current product type for this page
window.currentProductType = 'menus_enfant';
window.currentAddons = @json($addons);


function addToCartSimple(url) {
    window.location.href = url;
}

// Add to cart with customization
window.addToCartWithCustomization = function(customizationOptions) {
    console.log('Adding to cart with customization:', customizationOptions);
    
    // Here you would typically send the data to your backend
    // For now, just show a success message
    if (typeof toastr !== 'undefined') {
        toastr.success('Produit ajouté au panier avec succès!');
    } else {
        alert('Produit ajouté au panier avec succès!');
    }
    
    // Close modal
    $('#customizationModal').modal('hide');
};
</script>

@endsection 