@extends('layouts.manage')

@section('content')

<div class="flex-container">
    <div class="columns m-t-10">
        <div class="column">
            <h1 class="title">Manage Users</h1>
        </div>

        <div class="column">
            <a href="{{route('users.create')}}" class="button is-primary is-pulled-right"><i class="fa fa-user-add m-r-10"></i>Create New User</a>
        </div>
    </div>
    <hr class="m-t-0">

    <div class="card">
        <div class="card-content">
            <table class="table is-narrow is-fullwidth">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date Created</th>
                        <th></th>
                    </tr>
                </thead>
        
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at->toFormattedDateString()}}</td>
                            <td class="has-text-right">
                                <a href="{{route('users.show', $user->id)}}" class="button is-outlined m-r-5">View</a>
                                <a href="{{route('users.edit', $user->id)}}" class="button is-outlined">Edit</a>
                            </td>
                        </tr>     
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> <!-- end of .card -->
    
    {{$users->links('vendor.pagination.default')}}
        {{-- by default, this renders for bootstrap. since we are  using bulma, we need to customize the view that this comes in. 
            we will render that view and then customize as needed.  We will use commmand php artisan vendor:publish --tag=laravel-pagination
            this command will publish the standard laravel-pagination view so we can customize it.
            The default pagination view is called default under views/vendor/pagination
        --}}
    
</div>

@endsection