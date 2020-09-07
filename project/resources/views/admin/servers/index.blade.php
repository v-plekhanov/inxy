@extends('admin.layouts.app')

@section('content')
    <div class="my-2 row">
        <div class="col-md-3">
            <a href="{{route('servers.create')}}" class="btn btn-sm btn-success">Create new server</a>

            <button onclick="importServers('{{ route('servers.import') }}')" class="btn btn-sm btn-success">Import servers <span data-feather="download-cloud"></span></button>
        </div>
    </div>
    <div class="my-5">
        <h3>Filters</h3>
        <form action="{{route('servers.index')}}" method="GET">
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
    <div class="table-responsive">
     <table class="table">
        <thead>
        <tr>
            <th>
                <div class="hosting__feature--plan">
                    <div class="plan__title">#</div>
                </div>
            </th>
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
            <th>
                <div class="hosting__feature--plan">
                    <div class="plan__title">Actions</div>
                </div>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($servers as $server)
            <tr>
                <td class="hosting__feature--item">{{$server->id}}</td>
                <td class="hosting__feature--item">{{$server->provider}}</td>
                <td class="hosting__feature--info">{{$server->brand}}</td>
                <td class="hosting__feature--info">{{$server->location}}</td>
                <td class="hosting__feature--info">{{$server->cpu}}</td>
                <td class="hosting__feature--info">{{$server->drive}}</td>
                <td class="hosting__feature--info">${{$server->price}}</td>
                <td class="hosting__feature--info">
                    <a href="{{route('servers.edit', $server->id)}}" class="btn btn-sm btn-primary"><span data-feather="edit"></span></a>
                    <button onclick="daleteServer('{{ route('servers.destroy', $server->id) }}')" class="btn btn-sm btn-danger"><span data-feather="trash-2"></span></button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    {{ $servers->links() }}

@endsection
@section('scripts')
    <script>
        function daleteServer(url) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if(confirm('Are you sure?')) {
                $.ajax({
                    type: "DELETE",
                    url: url,
                    success: function(result) {
                        location.reload();
                    }
                });
            }
        }

        function importServers() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('servers.import')}}",
                success: function(result) {
                    location.reload();
                }
            });
        }
    </script>
@endsection
