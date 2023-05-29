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
                    <h4>Transfer Money</h4>
<form method="POST" action="{{ route('transfer') }}">
    @csrf
      @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
           <div id="errorAlert" class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

        @endif
    <div class="form-group">
        <label for="recipient_id">  Email ID:</label>
        <input type="text" name="recipient_email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="amount">Transfer Amount:</label>
        <input type="text" name="amount" class="form-control" step="0.01" min="0.05" required placeholder="Enter Amount">
    </div>
    <button type="submit" class="btn btn-primary">Transfer</button>
</form>

             
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@if($errors->any() || session('success'))
    <script>
        setTimeout(function() {
            document.querySelector('.alert').style.display = 'none';
        }, 800); 
        @if($errors->any())
    
        setTimeout(function() {
            document.getElementById('errorAlert').style.display = 'none';
        }, 1000);
     @endif

        
    </script>
@endif
