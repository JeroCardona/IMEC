@extends('layouts.admin')
@section('content')
<div class="card mb-4">
    <div class="card-header">{{__('messages.createService') }}</div>
    <div class="card-body"> @if($errors->any()) <ul class="alert alert-danger list-unstyled"> @foreach($errors->all() as $error) <li>- {{ $error }}</li> @endforeach </ul> @endif <form method="POST" action="{{ route('admin.service.store') }}" enctype="multipart/form-data">

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
                <div class="mb-3 row"> 
                    <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.editCategory') }}</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <div class="form-group">
                                <select id="category" class="form-control mb-2" name="category">
                                    <option value="">{{__('messages.editCategory') }}</option>
                                    <option value="Preventive Maintenance" {{ old('category') == 'Preventive Maintenance' ? 'selected' : '' }}>{{__('messages.categoryOne') }}</option>
                                    <option value="Corrective Maintenance" {{ old('category') == 'Corrective Maintenance' ? 'selected' : '' }}>{{__('messages.categoryTwo') }}</option>
                                    <option value="Predictive Maintenance" {{ old('category') == 'Predictive Maintenance' ? 'selected' : '' }}>{{__('messages.categoryThree') }}</option>
                                    <option value="Technical Specialized Maintenance" {{ old('category') == 'Technical Specialized Maintenance' ? 'selected' : '' }}>{{__('messages.categoryFour') }}</option>
                                    <option value="Software/Hardware Maintenance" {{ old('category') == 'Software/Hardware Maintenance' ? 'selected' : '' }}>{{__('messages.categoryFive') }}</option>
                                    <option value="Facility Maintenance" {{ old('category') == 'Facility Maintenance' ? 'selected' : '' }}>{{__('messages.categorySix') }}</option>
                                </select>
                            </div>
                        </div>
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
    <div class="card-header">{{__('messages.manageService') }}</div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                <th scope="col">{{__('messages.id') }}</th>
                    <th scope="col">{{__('messages.editName') }}</th>
                    <th scope="col">{{__('messages.editPrice') }}</th>
                    <th scope="col">{{__('messages.edit') }}</th>
                    <th scope="col">{{__('messages.delete') }}</th>
                </tr>
            </thead>
            <tbody> @foreach ($viewData["services"] as $service) <tr>
                    <td>{{ $service->getId() }}</td>
                    <td>{{ $service->getName() }}</td>
                    <td>{{ $service->getPrice() }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{route('admin.service.edit', ['id'=> $service->getId()])}}"> 
                            <i class="bi-pencil"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.service.delete', $service->getId())}}" method="POST">
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