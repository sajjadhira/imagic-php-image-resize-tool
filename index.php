<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">

    <title>Imagic</title>

    <style>
      body{
        background-color: #4385F6;
      }
    </style>
  </head>
  <body>
  <div class="container">
    
    <br>
    <br>
    <br>
    <br>
    <div class="row card">
      <h1 class="text-center">Imagic</h1>
      <div class="text-center">A simple image resize tool</div>
      <br>
      <br>
      <br>

    <div class="col-md-6 offset-md-3 text-center">

    <form action="resize.php" enctype="multipart/form-data" method="post">

      <div class="form-group row">
        <label for="file" class="col-sm-4 col-form-label">Select Your Image</label>
        <input type="file" name="image" class="col-sm-8 form-control-file" id="file" accept="image/*"  required>
      </div>

      <div class="form-group row">
        <label for="file" class="col-sm-4 col-form-label">Number of Image</label>
        <input type="number" name="number" class="col-sm-8 form-control-file" id="file" value="5" required>
      </div>
      <br/>

      <div class="form-group row">
        <label for="file" class="col-sm-4 col-form-label">Image Quality (10-100)</label>
        <input type="number" name="quality" class="col-sm-8 form-control-file" id="quality" value="10" required>
        <div class="col-sm-4"></div><div class="col-sm-8 text-left"> Note: Image size will depend on quality.</div>
      </div>

      <br>

    <div class="form-group row">
    <div class="col-sm-10">
    <button type="submit" class="btn btn-primary" id="submit">Resize Image</button>
    
    </div>
    </div>

    <br/>
    <br/>
    <div class="text-center">Developed By &copy; Sajjad Hossain 2021</div>
      
    <br/><br/>
      
    </form>
    </div>

    </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="./bootstrap/js/bootstrap.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>