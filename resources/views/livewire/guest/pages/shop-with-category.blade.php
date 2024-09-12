@extends('livewire.guest.layouts.master')

@section('title', 'Category Products')

@section('content')

    <!-- section -->
    <section class="mt-8 mb-lg-14 mb-8">
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-lg-12">
                    @livewire('guest.component.shop-products-component', ['type' => 'category', 'category_slug' => $category])
                </div>
            </div>
        </div>
    </section>

@endsection
