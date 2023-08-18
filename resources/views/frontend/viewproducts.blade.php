@extends('layouts.app')

@section('content')
    <livewire:frontend.products.viewproducts :product="$product" :category="$category"/>
@endsection