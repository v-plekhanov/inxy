@extends('admin.layouts.app')

@section('content')
    <div class="my-2">
        <a href="{{route('servers.index')}}" class="btn btn-sm btn-success">Back <span data-feather="back"></span></a>
    </div>
    <form action="{{route('servers.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="provider">Provider</label>
            <input type="text" class="form-control" id="provider" placeholder="Provider" name="provider" value="{{old('provider')}}">
        </div>
        <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" class="form-control" id="brand" placeholder="Brand" name="brand" value="{{old('brand')}}">
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" placeholder="Location" name="location" value="{{old('location')}}">
        </div>
        <div class="form-group">
            <label for="cpu">CPU</label>
            <input type="text" class="form-control" id="cpu" placeholder="CPU" name="cpu" value="{{old('cpu')}}">
        </div>
        <div class="form-group">
            <label for="drive">Drive</label>
            <input type="text" class="form-control" id="drive" placeholder="Drive" name="drive" value="{{old('drive')}}">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" placeholder="Price" name="price" value="{{old('price')}}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
