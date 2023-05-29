@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @include('layouts.navbar')
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5>Welcome, {{ Auth::user()->name }} </h5><br>
                    <table class="table justify-content-center" >
                        
                        <tbody>
                           
                                <tr>
                                    <td>Email </td>
                                    <td>{{ Auth::user()->email }}</td>
                                    
                                </tr>
                                <tr>
                                    <td>Balance </td>
                                    <td>${{ Auth::user()->balance ?? 0}}</td>
                                    
                                </tr>
                            
                        </tbody>
                    </table>
                   
                </div>
        </div>
    </div>
</div>
@endsection
