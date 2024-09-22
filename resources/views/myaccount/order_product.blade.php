@extends('layouts.app') 
@section('title', $viewData["title"]) 
@section('subtitle', $viewData["subtitle"]) 
@section('content') 
@forelse ($viewData["orderProduct"] as $orderProduct) 
<div class="card mb-4">
    <div class="card-header"> Order #{{ $orderProduct->getId() }} </div>
    <div class="card-body"> <b>Date:</b> {{ $orderProduct->getCreatedAt() }}<br /> <b>Total:</b> ${{ $orderProduct->getTotal() }}<br />

        <table class="table table-bordered table-striped text-center mt-3">
            <thead>
                <tr>
                    <th scope="col">Item ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody> 
            @if ($orderProduct->getItemsProduct())    
            @foreach ($orderProduct->getItemsProduct() as $itemProduct) <tr>
                    <td>{{ $itemProduct->getId() }}</td>
                    <td> <a class="link-success" href="{{ route('product.show', ['id'=> $itemProduct->getProduct()->getId()]) }}"> {{ $itemProduct->getProduct()->getName() }} </a> </td>
                    <td>${{ $itemProduct->getPrice() }}</td>
                    <td>{{ $itemProduct->getQuantity() }}</td>
                </tr> @endforeach 
                @else
                <tr>
                    <td colspan="4">No items found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div> @empty <div class="alert alert-danger" role="alert"> Seems to be that you have not purchased anything in our store =(. </div> 
@endforelse 
@endsection