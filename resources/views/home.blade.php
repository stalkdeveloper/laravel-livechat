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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
            
                            <tbody>
                                @if(is_array($userData) || is_object($userData))
                                    @foreach($userData->chunk(10) as $collection)
                                        @forelse ($collection as $count=>$user)
                                            <tr>
                                                <td>{{$count+1}}</td>
                                                <td>
                                                    {{$user->name}}
                                                </td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->usertype}}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{route('getUser', $user->id)}}" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                            View
                                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td>No Data Found!</td></tr>
                                        @endforelse
                                    @endforeach
                                @endif
                            </tbody>
                          </table>
                        </div>
                        {{ $userData->links() }}
                    </div>


                    <div class="card-body mt-4">
                        <h4 class="card-title">Logs</h4>
                        <div class="">
                            @if(is_string($logContent))
                                <pre>
                                    {{ $logContent }}
                                </pre>
                            @else
                                <p>No Data Found!</p>
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
