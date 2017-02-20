<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cluster Contacts</title>

        <!-- Fonts -->
        <link href="//fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
        </style>

    </head>
    <body>
        <div class="container">
        <h1> Contacts distribution </h1>
        <div class="col-md-3 well">
            <h3> Agents and Contacts </h3>
            <form method="post">
              {{ csrf_field() }}
              <div class="form-group form-horizontal">
                <label for="agent1Name">Agent1</label>
                <input type="number" class="form-control" id="agent1ZipCode" name="agent1ZipCode" placeholder="Zip Code">
              </div>
              <div class="form-group form-horizontal">
                <label for="agent2Name">Agent2</label>
                <input type="number" class="form-control" id="agent2ZipCode" name="agent2ZipCode" placeholder="Zip Code">
              </div>
              <button type="submit" class="btn btn-default">Match</button>
            </form>
        </div>
        <div class="col-md-9 well">
            <h3> Contacts Distribution </h3>
            <div class="form-group">
              <label class="sr-only" for="distribution">Contacts distribution</label>
              <textarea disabled class="form-control" rows="8" id="distribution">{{ $distribution }}
              </textarea>
            </div>
        </div>
        </div>
    </body>
</html>
