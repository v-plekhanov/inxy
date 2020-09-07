@extends('layouts.app')

@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__option">
                    <span>Home</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Hosting Section Begin -->
<section class="hosting-section spad mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h3>Servers catalog</h3>
                </div>
                <div class="my-5">
                    <form action="{{route('home')}}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                            <label for="provider">Provider</label>
                            <select name="provider" id="provider" class="form-control">
                                @if( is_null(request()->get('provider')))
                                    <option disabled selected>Select provider</option
                                @endif
                                @foreach($filters['providers'] as $provider)
                                    @if(request()->get('provider') == $provider)
                                        <option value="{{$provider}}" selected>{{ $provider }}</option>
                                    @else
                                        <option value="{{$provider}}">{{ $provider }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                            <div class="col-md-5">
                                <label for="price_min">Price</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="price_min" placeholder="Min price" name="price_min" value="{{$filters['price_min']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="price_max" placeholder="Max price" name="price_max" value="{{$filters['price_max']}}">
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-2">
                                <label for="size">Per page</label>
                                <select name="size" id="size" class="form-control">
                                    @foreach($pagination as $size)
                                        @if( $filters['size'] == $size)
                                            <option value="{{$size}}" selected>{{ $size }}</option>
                                        @else
                                            <option value="{{$size}}">{{$size}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2 d-flex align-items-center">
                                <button type="submit" class="btn btn-primary mt-2"> Apply</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="hosting__text">
                    <div class="hosting__feature__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        <div class="hosting__feature--plan">
                                            <div class="plan__title">Provider</div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="hosting__feature--plan">
                                            <div class="plan__title">Brand</div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="hosting__feature--plan">
                                            <div class="plan__title">Location</div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="hosting__feature--plan">
                                            <div class="plan__title">CPU</div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="hosting__feature--plan">
                                            <div class="plan__title">Drive</div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="hosting__feature--plan">
                                            <div class="plan__title">Price</div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($servers as $server)
                                <tr>
                                    <td class="hosting__feature--item">{{$server->provider}}</td>
                                    <td class="hosting__feature--info">{{$server->brand}}</td>
                                    <td class="hosting__feature--info">{{$server->location}}</td>
                                    <td class="hosting__feature--info">{{$server->cpu}}</td>
                                    <td class="hosting__feature--info">{{$server->drive}}</td>
                                    <td class="hosting__feature--info">${{$server->price}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                    <div class="pagination center mt-3">
                        <div class="d-block mx-auto">
                            {{ $servers->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hosting Section End -->

@endsection
