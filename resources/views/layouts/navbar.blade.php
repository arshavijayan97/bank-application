<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
      .nav-link {
        margin-right: 10px; /* Adjust the margin as needed */
      }
      .nav-link .icon-align {
        margin-right: 5px;
      }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="mx-auto">
            <!-- Added mx-auto class for center alignment -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}"><span class="glyphicon glyphicon-home icon-align"></span>Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('depositfrom') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('depositfrom') }}"><span class="glyphicon glyphicon-plus icon-align"></span>Deposit</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('withdrwalfrom') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('withdrwalfrom') }}"><span class="glyphicon glyphicon-minus icon-align"></span>Withdraw</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('transferfrom') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('transferfrom') }}"><span class="glyphicon glyphicon-transfer icon-align"></span>Transfer</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('statement*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('statement.index') }}"><span class="glyphicon glyphicon-list icon-align"></span>Statements</a>
                    </li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link" style="margin-top: 6px;"><span class="glyphicon glyphicon-log-out icon-align"></span>Log Out</button>
                    </form>
                </ul>
            </div>
        </div>
    </nav>

  </body>
</html>
