@extends('layouts.frontend')
@section('title', $product->name)
@section('content')
    <div class="product-details ptb-100 pb-90">

    @if(session()->has('message'))
        <div class="alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert" id="alert-message">
            {{ session()->get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-7 col-12">
                    <div class="product-details-img-content">
                        <div class="product-details-tab mr-70">
                            @if($product->media_count)
                                <div class="product-details-large tab-content">
                                    @foreach ($product->media as $media)
                                        <div class="tab-pane {{ $loop->index == 0 ? 'active' : '' }} show fade"
                                             id="pro-details{{ $loop->index }}" role="tabpanel">
                                            <div class="easyzoom easyzoom--overlay">
                                                @if($product->media)
                                                    <a href="{{ asset('storage/images/products/' . $media->file_name ) }}">
                                                        <img src="{{ asset('storage/images/products/' . $media->file_name ) }}"
                                                             alt="{{ $product->name }}">
                                                    </a>
                                                @else
                                                    <img src="{{ asset('img/no-img.png' ) }}"
                                                         alt="{{ $product->name }}">
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="product-details-small nav mt-12" role=tablist>
                                    @foreach ($product->media as $media)
                                        <a class="{{ $loop->index == 0 ? 'active' : '' }} mr-12"
                                           href="#pro-details{{ $loop->index }}" data-toggle="tab" role="tab"
                                           aria-selected="true">
                                            <img style="width: 90px;" src="{{ asset('storage/images/products/' . $media->file_name ) }}"
                                                 alt="{{ $product->name }}">
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <img src="{{ asset('img/no-img.png' ) }}" alt="{{ $product->name }}">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5 col-12">
                    <div class="product-details-content">
                        <h3>{{ $product->name }}</h3>
                        <div class="details-price">
                            <span>Rp.{{ number_format($product->price) }}</span>
                        </div>
                        <p>{!! $product->details !!}</p>
                            <form action="{{ route('cart.store') }}" method="post">
                                    @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="quickview-plus-minus">
                                    <div class="cart-plus-minus">
                                        <input type="number" name="qty" min="1" value="1" class="cart-plus-minus-box" placeholder="qty">
                                    </div>
                                    <div class="quickview-btn-cart">
                                        <button type="submit" class="submit contact-btn btn-hover">Tambah Keranjang</button>
                                    </div>
                                </div>
							</form>
                        <div class="product-details-cati-brand mt-35">
                            <ul>
                                <li class="categories-title">Kategori :</li>
                                <li><a class="badge badge-warning text-white" href="{{ route('shop.index', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                            </ul>
                        </div>
                        <div class="product-details-cati-tag mtb-10">
                            <ul>
                                <li class="categories-title">Tag :</li>
                                <li>
                                    @if($product->tags->count() > 0)
                                        @foreach($product->tags as $tag)
                                        <a href="{{ route('shop.tag', $tag->slug) }}">
                                            <span class="badge badge-info">{{ $tag->name }}</span>
                                        </a>
                                        @endforeach
                                    @endif
                                </li>
                            </ul>
                                <br>
                            <ul>
                                <li class="categories-title">Merk :</li>
                                <li>
                                    @if($product->brands->count() > 0)
                                        @foreach($product->brands as $brand)
                                        <a href="{{ route('shop.brand', $brand->slug) }}">
                                            <span class="badge badge-info">{{ $brand->name }}</span>
                                        </a>
                                        @endforeach
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-description-review-area pb-90">
        <div class="container">
            <div class="product-description-review text-left">
                <div class="description-review-title nav" role=tablist>
                    <a href="#pro-dec" data-toggle="tab" role="tab" aria-selected="true">
                        Deskripsi
                    </a>
                </div>
                <div class="description-review-text tab-content">
                    <p class="description-text">
                    {!! $product->description !!}  
                    </p>
                    <div class="tab-pane active show fade" id="pro-review" role="tabpanel">
                        <div class="page-blog-details section-padding--lg bg--white pt-0">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-9 col-12">
                                        <livewire:shop.single-product-review-component :product="$product" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="popular-product-area wrapper-padding-3 pt-115 pb-115">
            <div class="container-fluid">
                <br>
                <div class="section-title-furits section-title-6 text-center mb-50">
                    <h2>Produk</h2>
                </div>
                <br>
                <div class="product-style">
                    <div class="popular-product-active owl-carousel">
                        @foreach ($relatedProducts as $product)
                            <div class="product-wrapper">
                                <div class="product-img">
                                    <a href="{{ route('product.show', $product->slug) }}">
                                        @if($product->firstMedia)
                                        <img src="{{ asset('storage/images/products/' . $product->firstMedia->file_name) }}"
                                         alt="{{ $product->name }}">
                                        @else
                                            <img src="{{ asset('frontend/assets/img/product/fashion-colorful/1.jpg') }}" alt="{{ $product->name }}">
                                        @endif
                                    </a>
                                    <div class="product-action">
                                        <a class="animate-left add-to-fav" title="Wishlist"  product-slug="{{ $product->slug }}" href="">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                        <a class="animate-top add-to-card" title="Add To Cart" href="" product-id="{{ $product->id }}" product-slug="{{ $product->slug }}">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="funiture-product-content text-center">
                                    <h4><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h4>
                                    <span>Rp.{{ number_format($product->price) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection

