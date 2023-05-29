<!DOCTYPE html>
<html>
  <head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  </head>
  <body>
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
                        <h5>Statement of account</h5>
                        @if ($statements->isEmpty())
                            <center><b>No records found</b></center>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>DateTime</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Details</th>
                                        <th>Balnce</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach ($statements as $statement)
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ date('d F Y h:i A', strtotime($statement->date)) }}</td>

                                            <td>{{ $statement->amount }}</td>
                                            <td>{{ $statement->tranfer_type }}</td>
                                             @if ($statement->type == 'transfer' && $statement->tranfer_type == 'debit')
                                               <td>Tranfered To {{ \App\Models\User::find($statement->from_id)->name }} </td>

                                            @elseif ($statement->type == 'transfer' && $statement->tranfer_type == 'credit')
                                                  <td>Tranfered From {{ \App\Models\User::find($statement->from_id)->name }}</td>
                                              @else

                                                   <td>{{ $statement->type }}</td>
                                              @endif
                                            <td>{{ $statement->balance }}</td>
                                        </tr>
                                        @php
                                            $counter++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $statements->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
  </body>
</html>
