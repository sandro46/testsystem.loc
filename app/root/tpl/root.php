<!DOCTYPE html>
<html>
  <?php include('html_head.php'); ?>
  <body>
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
      <?php //var_dump($_SESSION); ?>
      <div class="row col-md-6">
        <?php while($row = $params['test']->fetch()){ ?>
          <div class="col-md-11 alert alert-info">
            <h4><a href="/test?id=<?=$row['id']?>"><?=$row['name']?></a></h4>
            <p>
              <?=$row['description']?>
            </p>
          </div>
        <?php } ?>
      </div>
    </div>
  </body>
</html>
