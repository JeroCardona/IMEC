@extends('layouts.admin')
@section('content')
<div class="card mb-4">
    <div class="card-header"> {{__('messages.createProduct') }} </div>
    <div class="card-body"> @if($errors->any()) <ul class="alert alert-danger list-unstyled"> @foreach($errors->all() as $error) <li>- {{ $error }}</li> @endforeach </ul> @endif <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">

            @csrf <div class="row">
                <div class="col">
                    <div class="mb-3 row"> <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.editName') }}</label>
                        <div class="col-lg-10 col-md-6 col-sm-12"> <input name="name" value="{{ old('name') }}" type="text" class="form-control"> </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3 row"> <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.editPrice') }}</label>
                        <div class="col-lg-10 col-md-6 col-sm-12"> <input name="price" value="{{ old('price') }}" type="number" class="form-control"> </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3 row"> <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.editWarranty') }}</label>
                        <div class="col-lg-10 col-md-6 col-sm-12"> <input name="warranty" value="{{ old('warranty') }}" type="number" class="form-control"> </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 row"> <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.editImage') }}</label>
                        <div class="col-lg-10 col-md-6 col-sm-12"> <input class="form-control" type="file" name="image"> </div>
                    </div>
                </div>

                <div class="col"> &nbsp; </div>
            </div>
            <div class="mb-3"> <label class="form-label">{{__('messages.editDescription') }}</label> <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea> </div> 
            <button type="submit" class="btn btn-primary">{{__('messages.submit') }}</button>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">{{__('messages.manageProduct') }}</div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">{{__('messages.id') }}</th>
                    <th scope="col">{{__('messages.editName') }}</th>
                    <th scope="col">{{__('messages.editPrice') }}</th>
                    <th scope="col">{{__('messages.editWarranty') }}</th>
                    <th scope="col">{{__('messages.edit') }}</th>
                    <th scope="col">{{__('messages.delete') }}</th>
                </tr>
            </thead>
            <tbody> @foreach ($viewData["products"] as $product) <tr>
                    <td>{{ $product->getId() }}</td>
                    <td>{{ $product->getName() }}</td>
                    <td>{{ $product->getPrice() }}</td>
                    <td>{{ $product->getWarranty() }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{route('admin.product.edit', ['id'=> $product->getId()])}}"> 
                            <i class="bi-pencil"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.product.delete', $product->getId())}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                <i class="bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr> @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection