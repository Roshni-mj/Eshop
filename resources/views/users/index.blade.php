@extends('layouts.app')
@section('content')

    <h1>List of Users</h1>

   

   
  
    @empty ($users)
    <div class ="alert alert-warning">
       The list of users is empty
    </div>
    @else
    
  <div class="table-responsive">
    <table class=" table table-striped">
        <thead class="thead-light">
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Admin Since</th>
            <th>Action</th>
         

        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->Name}}</td>
                <td>{{$user->email}}</td>
              
                <td>
                    @php
                        $adminSince = \Carbon\Carbon::parse($user->admin_since);
                    @endphp

                    @if ($user->admin_since)
                        {{ $adminSince->diffForHumans() }}
                    @else
                        Never
                    @endif
                </td>

              
                <td>
                
                  <form action="{{ route('users.admin.toggle', ['user' =>$user->id]) }}" method="POST">
                  
                    @csrf
                
                    <button class =" btn btn-link" type="submit">{{$user->isAdmin() ? 'Remove' : 'Make'}} Admin</button>
                  </form>
                </td>
            </tr>
           @endforeach
        </tbody>

    </table>
  </div>
  @endif
@endsection

