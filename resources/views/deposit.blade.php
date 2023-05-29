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
                    <h4>Deposit Money</h4>
                    <form method="POST" action="{{ route('deposit') }}">
                        @csrf
                         @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" id="amount" name="amount" min="1" max="100000" class="form-control" required placeholder="Enter Amount">
                        </div>
                        <button type="submit" class="btn btn-primary">Deposit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@if(session('success'))
    <script>
        setTimeout(function() {
            document.querySelector('.alert').style.display = 'none';
        }, 700); 
        
    </script>
@endif
