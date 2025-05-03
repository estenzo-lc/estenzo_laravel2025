<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #ffa6c9; /* light pink background */
    color: #4a3b69; /* dark text for contrast */
  }

  .nav-bar {
    background: #fca17d; /* soft orange */
    padding: 15px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }

  .nav-bar a {
    color: #ffffff;
    margin: 0 20px;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.1rem;
  }

  .dashboard-container {
    margin: 50px auto;
    width: 90%;
    max-width: 1200px;
  }

  .dashboard-title {
    text-align: center;
    color: #f88379; /* salmon pink */
    font-size: 2.5rem;
    margin-bottom: 30px;
  }

  .card-box {
    background: #ff6f61; /* coral red */
    border-radius: 15px;
    padding: 25px;
    color: #ffffff; /* white text for contrast */
    transition: transform 0.2s;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  }

  .card-box:hover {
    transform: translateY(-5px);
  }

  .card-box h4 {
    font-weight: bold;
  }

  .footer {
    margin-top: 50px;
    text-align: center;
    font-size: 0.9rem;
    color: #e65a5a; /* deep red */
  }
</style>

</head>
<body>

  @include('nav')

  <div class="nav-bar">
    <a href="#">Home</a>
    <a href="#">Profile</a>
    <a href="#">Settings</a>
  </div>

  <div class="dashboard-container">
    <h2 class="dashboard-title">Welcome to Your Dashboard!</h2>
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card-box">
          <h4>Card 1</h4>
          <p>Sample content for card 1.</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
  <div class="card-box" style="background: #fca17d; color: #ffffff;"> <!-- orange -->
    <h4>Card 2</h4>
    <p>Sample content for card 2.</p>
  </div>
</div>

<div class="col-md-4 mb-4">
  <div class="card-box" style="background: #f88379; color: #ffffff;"> <!-- salmon pink -->
    <h4>Card 3</h4>
    <p>Sample content for card 3.</p>
  </div>
</div>

          <p>Sample content for card 3.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="footer">© 2025 Your Dashboard</div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
