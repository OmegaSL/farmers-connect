@extends('livewire.guest.layouts.master')

@section('title', 'Shop Page')

@section('content')


    <!-- section -->
    <section class="mt-8 mb-lg-14 mb-8">
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-lg-12">

                    @livewire('guest.component.shop-products-component', ['type' => 'shop'])
                </div>
            </div>
        </div>
    </section>

@endsection
