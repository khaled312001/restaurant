{{-- eslint-disable --}}
@extends('front.layout')
@section('content')

<!--====== PAGE TITLE PART START ======-->
<section class="page-title-area d-flex align-items-center lazy" data-bg="{{asset('assets/front/img/'.$bs->breadcrumb)}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h2 class="title">Nos Assiettes</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front.index')}}"><i class="flaticon-home"></i>{{__('Home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('front.sandwiches')}}">Notre Carte</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nos Assiettes</li>
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
                <!-- Main Assiettes Menu -->
                <div class="menu-category" style="background: #2c3e50; border-radius: 20px; padding: 30px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <h2 style="color: #3498db; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center;">
                        NOS ASSIETTES
                    </h2>
                    
                    <div class="menu-table" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px;">
                        <!-- Desktop Header -->
                        <div class="table-header desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 15px; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #3498db;">
                            <span style="color: #3498db; font-weight: 600; font-size: 1.1rem;">Assiette</span>
                            <span style="color: #3498db; font-weight: 600; font-size: 1.1rem; text-align: center;">Seul</span>
                            <span style="color: #3498db; font-weight: 600; font-size: 1.1rem; text-align: center;">Menu</span>
                            <span style="color: #3498db; font-weight: 600; font-size: 1.1rem; text-align: center;">Commander</span>
                        </div>
                        
                        <!-- Desktop Layout -->
                        <div class="menu-item desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 15px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">ASSIETTE KEBAB</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">13,00€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">16,00€</span>
                            <div style="text-align: center;">
                                <a href="{{ route('front.assiettes.addons') }}?type=seul" class="btn btn-warning btn-sm" style="background: #3498db; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; margin-bottom: 8px; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.assiettes.addons') }}?type=menu" class="btn btn-warning btn-sm" style="background: #5dade2; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        
                        <!-- Mobile Layout -->
                        <div class="menu-item-mobile mobile-only" style="background: rgba(255,255,255,0.05); border-radius: 15px; padding: 20px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.1);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.2rem;">ASSIETTE KEBAB</h4>
                                <div style="text-align: right;">
                                    <div style="color: #3498db; font-size: 0.9rem; margin-bottom: 5px;">Prix</div>
                                </div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Seul</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">13,00€</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Menu</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">16,00€</span>
                            </div>
                            
                            <div style="text-align: center;">
                                <a href="{{ route('front.assiettes.addons') }}?type=seul" class="btn btn-warning" style="background: #3498db; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; margin-bottom: 10px; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.assiettes.addons') }}?type=menu" class="btn btn-warning" style="background: #5dade2; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        
                        <!-- Desktop Layout -->
                        <div class="menu-item desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 15px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">ASSIETTE GRILLÉE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">14,00€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">17,00€</span>
                            <div style="text-align: center;">
                                <a href="{{ route('front.assiettes.addons') }}?type=seul" class="btn btn-warning btn-sm" style="background: #3498db; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; margin-bottom: 8px; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.assiettes.addons') }}?type=menu" class="btn btn-warning btn-sm" style="background: #5dade2; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        
                        <!-- Mobile Layout -->
                        <div class="menu-item-mobile mobile-only" style="background: rgba(255,255,255,0.05); border-radius: 15px; padding: 20px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.1);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.2rem;">ASSIETTE GRILLÉE</h4>
                                <div style="text-align: right;">
                                    <div style="color: #3498db; font-size: 0.9rem; margin-bottom: 5px;">Prix</div>
                                </div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Seul</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">14,00€</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Menu</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">17,00€</span>
                            </div>
                            
                            <div style="text-align: center;">
                                <a href="{{ route('front.assiettes.addons') }}?type=seul" class="btn btn-warning" style="background: #3498db; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; margin-bottom: 10px; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.assiettes.addons') }}?type=menu" class="btn btn-warning" style="background: #5dade2; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        
                        <!-- Desktop Layout -->
                        <div class="menu-item desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 15px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">ASSIETTE KOFTE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">13,00€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">16,00€</span>
                            <div style="text-align: center;">
                                <a href="{{ route('front.assiettes.addons') }}?type=seul" class="btn btn-warning btn-sm" style="background: #3498db; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; margin-bottom: 8px; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.assiettes.addons') }}?type=menu" class="btn btn-warning btn-sm" style="background: #5dade2; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        
                        <!-- Mobile Layout -->
                        <div class="menu-item-mobile mobile-only" style="background: rgba(255,255,255,0.05); border-radius: 15px; padding: 20px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.1);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.2rem;">ASSIETTE KOFTE</h4>
                                <div style="text-align: right;">
                                    <div style="color: #3498db; font-size: 0.9rem; margin-bottom: 5px;">Prix</div>
                                </div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Seul</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">13,00€</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Menu</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">16,00€</span>
                            </div>
                            
                            <div style="text-align: center;">
                                <a href="{{ route('front.assiettes.addons') }}?type=seul" class="btn btn-warning" style="background: #3498db; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; margin-bottom: 10px; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.assiettes.addons') }}?type=menu" class="btn btn-warning" style="background: #5dade2; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        
                        <!-- Desktop Layout -->
                        <div class="menu-item desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 15px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">ASSIETTE POULET CRÈME</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">13,00€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">16,00€</span>
                            <div style="text-align: center;">
                                <a href="{{ route('front.assiettes.addons') }}?type=seul" class="btn btn-warning btn-sm" style="background: #3498db; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; margin-bottom: 8px; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.assiettes.addons') }}?type=menu" class="btn btn-warning btn-sm" style="background: #5dade2; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        
                        <!-- Mobile Layout -->
                        <div class="menu-item-mobile mobile-only" style="background: rgba(255,255,255,0.05); border-radius: 15px; padding: 20px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.1);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.2rem;">ASSIETTE POULET CRÈME</h4>
                                <div style="text-align: right;">
                                    <div style="color: #3498db; font-size: 0.9rem; margin-bottom: 5px;">Prix</div>
                                </div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Seul</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">13,00€</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Menu</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">16,00€</span>
                            </div>
                            
                            <div style="text-align: center;">
                                <a href="{{ route('front.assiettes.addons') }}?type=seul" class="btn btn-warning" style="background: #3498db; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; margin-bottom: 10px; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.assiettes.addons') }}?type=menu" class="btn btn-warning" style="background: #5dade2; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        
                        <!-- Desktop Layout -->
                        <div class="menu-item desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 15px; align-items: center; padding: 15px 0;">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">ASSIETTE KOBANE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">15,00€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">18,00€</span>
                            <div style="text-align: center;">
                                <a href="{{ route('front.assiettes.addons') }}?type=seul" class="btn btn-warning btn-sm" style="background: #3498db; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; margin-bottom: 8px; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.assiettes.addons') }}?type=menu" class="btn btn-warning btn-sm" style="background: #5dade2; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        
                        <!-- Mobile Layout -->
                        <div class="menu-item-mobile mobile-only" style="background: rgba(255,255,255,0.05); border-radius: 15px; padding: 20px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.1);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.2rem;">ASSIETTE KOBANE</h4>
                                <div style="text-align: right;">
                                    <div style="color: #3498db; font-size: 0.9rem; margin-bottom: 5px;">Prix</div>
                                </div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Seul</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">15,00€</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">
                                <span style="color: white; font-size: 0.9rem;">Menu</span>
                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">18,00€</span>
                            </div>
                            
                            <div style="text-align: center;">
                                <a href="{{ route('front.assiettes.addons') }}?type=seul" class="btn btn-warning" style="background: #3498db; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; margin-bottom: 10px; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.assiettes.addons') }}?type=menu" class="btn btn-warning" style="background: #5dade2; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem; text-decoration: none; display: block;">
                                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Supplements Menu -->
                <div class="menu-category" style="background: #2c3e50; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <h2 style="color: #3498db; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center;">
                        SUPPLEMENTS
                    </h2>
                    
                    <div class="menu-table" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px;">
                        <div class="table-header" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #3498db;">
                            <span style="color: #3498db; font-weight: 600; font-size: 1.1rem;">Article</span>
                            <span style="color: #3498db; font-weight: 600; font-size: 1.1rem;">Prix</span>
                            <span style="color: #3498db; font-weight: 600; font-size: 1.1rem; text-align: center;">Commander</span>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">PETITE FRITE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">2,00€</span>
                            <div style="text-align: center;">
                                <button onclick="addToCart('{{ route('add.cart', 134) }}', [], 1, [])" class="btn btn-warning btn-sm" style="background: #3498db; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                                    Commander
                                </button>
                            </div>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">GRANDE FRITE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">4,00€</span>
                            <div style="text-align: center;">
                                <button onclick="addToCart('{{ route('add.cart', 135) }}', [], 1, [])" class="btn btn-warning btn-sm" style="background: #3498db; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                                    Commander
                                </button>
                            </div>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0;">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">PETITE VIANDE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">5,00€</span>
                            <div style="text-align: center;">
                                <button onclick="addToCart('{{ route('add.cart', 136) }}', [], 1, [])" class="btn btn-warning btn-sm" style="background: #3498db; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                                    Commander
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action Section -->
<div class="cta-section" style="background: linear-gradient(45deg, #2c3e50, #34495e); padding: 60px 0; text-align: center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 style="color: white; font-size: 2.5rem; font-weight: 700; margin-bottom: 20px;">
                    Prêt à déguster ?
                </h2>
                <p style="color: #bdc3c7; font-size: 1.2rem; margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto;">
                    Personnalisez vos sauces et ajoutez votre assiette au panier en quelques clics !
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
    </div>
</div>


<style>
.menu-category {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.menu-category:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
}

.menu-item {
    transition: all 0.3s ease;
}

.menu-item:hover {
    background-color: rgba(255,255,255,0.05);
    border-radius: 10px;
    padding-left: 15px;
    padding-right: 15px;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
}

.food-image {
    transition: transform 0.3s ease;
}

.food-item:hover .food-image {
    transform: scale(1.05);
}

.glow-effect {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { opacity: 0.5; }
    50% { opacity: 1; }
    100% { opacity: 0.5; }
}

.info-item {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.info-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

/* Mobile Styles */
@media (max-width: 768px) {
    .desktop-only {
        display: none !important;
    }
    
    .mobile-only {
        display: block !important;
    }
    
    .page-header h1 {
        font-size: 2rem;
    }
    
    .menu-section {
        padding: 40px 0;
    }
    
    .cta-buttons .btn {
        display: block;
        margin: 10px auto;
        width: 100%;
        max-width: 300px;
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
</style>

<script>
// Set current product type for this page
window.currentProductType = 'assiettes';
window.currentAddons = @json($addons);


function addToCart(url, variant, quantity, extras) {
    // Existing addToCart function
    // You can keep your existing implementation here
    console.log('Adding to cart:', url, variant, quantity, extras);
    
    // For now, redirect to the cart route
    window.location.href = url;
}

// Add to cart with customization
window.addToCartWithCustomization = function(customizationOptions) {
    console.log('=== ADD TO CART WITH CUSTOMIZATION ===');
    console.log('Customization options received:', customizationOptions);
    
    if (!window.currentProduct) {
        console.error('No current product information available');
        return;
    }
    const product = window.currentProduct;
    if (!customizationOptions || !customizationOptions.addons) {
        console.error('Invalid customization options:', customizationOptions);
        return;
    }
    const cartData = {
        product_id: product.id,
        quantity: customizationOptions.quantity || 1,
        customizations: JSON.stringify({
            productName: product.name,
            productType: product.type,
            price: product.price,
            quantity: customizationOptions.quantity || 1,
            meatChoice: customizationOptions.addons?.meat || null,
            vegetables: customizationOptions.addons?.vegetables || [],
            sauces: customizationOptions.addons?.sauces || [],
            drinks: customizationOptions.addons?.drinks || [],
            extras: customizationOptions.addons?.extras || []
        }),
        _token: $('meta[name="csrf-token"]').attr('content')
    };
    $.ajax({
        url: '/add-to-cart/' + product.id,
        method: 'POST',
        data: cartData,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(response) {
            if (response && response.success) {
                window.location.href = response.redirect || '/cart';
            } else {
                if (typeof toastr !== 'undefined') { toastr.error(response.message || 'Erreur lors de l\'ajout au panier'); }
            }
        },
        error: function() {
            if (typeof toastr !== 'undefined') { toastr.error('Erreur lors de l\'ajout au panier'); }
        }
    });
};
</script>

@endsection 