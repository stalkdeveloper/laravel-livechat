@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <h4 class="card-title">User List</h4>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
            
                            <tbody>
                                @if(is_array($messages) || is_object($messages))
                                    @forelse ($messages as $count=>$user)
                                        <tr>
                                            <td>{{$count+1}}</td>
                                            <td>
                                                {{$user->fromName}}
                                            </td>
                                            <td>{{$user->toName}}</td>
                                            <td>{{$user->body}}</td>
                                        </tr>
                                    @empty
                                        <tr><td>No Data Found!</td></tr>
                                    @endforelse
                                @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
