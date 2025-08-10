@extends('front.layout')

@section('content')
    <!--====== PAGE TITLE PART START ======-->

    <section class="page-title-area d-flex align-items-center lazy" data-bg="{{asset('assets/front/img/'.$bs->breadcrumb)}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-item text-center">
                    <h2 class="title">{{convertUtf8($bs->menu_title)}}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('front.index')}}"><i class="flaticon-home"></i>{{__('Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{convertUtf8($bs->menu_title)}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== PAGE TITLE PART ENDS ======-->

    <!--====== FOOD MENU PART START ======-->

    @if ($be->menu_version == 1)
        <section class="food-menu-area food-menu-2-area food-menu-3-area pt-90">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-title text-center">
                            <span>{{convertUtf8($be->menu_section_title)}}
                                <img class="lazy" data-src="{{asset('assets/front/img/title-icon.png')}}" alt=""></span>
                            <h3 class="title">{{convertUtf8($be->menu_section_subtitle)}}</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tabs-btn pb-20">
                            <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
                                @foreach ($categories as $keys => $category)
                                <li class="nav-item">
                                    <a class="nav-link {{$keys == 0 ? 'active' : ''}}" 
                                       href="{{ route('front.items', ['search' => '', 'minprice' => '0', 'maxprice' => '16.00', 'category_id' => $category->id, 'subcategory_id' => '', 'type' => 'new', 'review' => '']) }}"
                                       style="cursor: pointer; text-decoration: none;">
                                        @if (!empty($category->image))
                                            <img class="lazy wow fadeIn" data-src="{{asset('assets/front/img/category/'.$category->image)}}" alt="menu" data-wow-delay=".5s">
                                        @endif
                                        <p @if(empty($category->image)) style="padding-top: 0px;" @endif>{{convertUtf8($category->name)}} ({{$category->products->count()}})</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content" id="pills-tabContent">
                            @foreach ($categories as $key => $category)
                            <div class="tab-pane fade {{$key == 0 ? 'show active' : ''}}"  id="{{convertUtf8($category->slug)}}" role="tabpanel" aria-labelledby="{{convertUtf8($category->slug)}}-tab">
                                        
                                <div class="button-group filters-button-group">
                                    <button class="button is-checked" data-filter="*" @if ($category->subcategories()->count() == 0) style="display: none;" @endif>{{__('All')}}</button>
                                    @foreach ($category->subcategories as $subcat)
                                        <button class="button" data-filter=".sub{{$subcat->id}}">{{$subcat->name}}</button>
                                    @endforeach
                                </div>
                                
                                <!-- Category content area - Products removed, showing only category info -->
                              
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        @if (!empty($be->menu_section_img))
            <style>
                .food-menu-area .food-menu-items.menu-2::before {
                    background-image: url("{{asset('assets/front/img/' . $be->menu_section_img)}}");
                }
            </style>
        @endif
        <section class="food-menu-area pt-130">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-title text-center">
                            <span>{{convertUtf8($be->menu_section_title)}} <img class="lazy" data-src="{{asset('assets/front/imt/title-icon.png')}}" alt=""></span>
                            <h3 class="title">{{convertUtf8($be->menu_section_subtitle)}}</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tabs-btn pb-20">
                            <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
                                @foreach ($categories as $keys => $category)
                                <li class="nav-item">
                                    <a class="nav-link {{$keys == 0 ? 'active' : ''}}" 
                                       href="{{ route('front.items', ['search' => '', 'minprice' => '0', 'maxprice' => '16.00', 'category_id' => $category->id, 'subcategory_id' => '', 'type' => 'new', 'review' => '']) }}"
                                       style="cursor: pointer; text-decoration: none;">
                                        @if (!empty($category->image))
                                            <img class="lazy wow fadeIn" data-src="{{asset('assets/front/img/category/'.$category->image)}}" alt="menu" data-wow-delay=".5s">
                                        @endif
                                        <p @if(empty($category->image)) style="padding-top: 0px;" @endif>{{convertUtf8($category->name)}} ({{$category->products->count()}})</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content" id="pills-tabContent">
                            @foreach ($categories as $key => $category)
                            <div class="tab-pane fade {{$key == 0 ? 'show active' : ''}}" id="{{convertUtf8($category->slug)}}"  role="tabpanel" aria-labelledby="{{convertUtf8($category->slug)}}-tab">
                                        
                                <div class="button-group filters-button-group">
                                    <button class="button is-checked" data-filter="*" @if ($category->subcategories()->count() == 0) style="display:none;" @endif>{{__('All')}}</button>
                                    @foreach ($category->subcategories()->get() as $subcat)
                                        <button class="button" data-filter=".sub{{$subcat->id}}">{{$subcat->name}}</button>
                                    @endforeach
                                </div>
                                
                                <!-- Category content area - Products removed, showing only category info -->
                                <div class="row justify-content-center mt-4">
                                    <div class="col-lg-8">
                                        <div class="category-info text-center">
                                            <h4>{{convertUtf8($category->name)}}</h4>
                                            <p>{{__('This category contains')}} {{$category->products->count()}} {{__('items')}}</p>
                                            @if($category->subcategories->count() > 0)
                                                <p>{{__('Subcategories')}}: {{$category->subcategories->count()}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!--====== FOOD MENU PART ENDS ======-->

@endsection
