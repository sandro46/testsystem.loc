<!DOCTYPE html>
<html>
  <?php include('html_head.php'); ?>
  <body>
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
      <?php //var_dump(); ?>
      <div class="row col-md-6">
        <form method="post" action="/root/save_user">
          <input type="hidden" name="uri" value="<?=$_SERVER['REQUEST_URI']?>">
          <div class="row form-group">
            <div class="col-md-12">
              <input type="text" class="form-control" name="name" required="true" placeholder="Ваше имя">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <input type="email" class="form-control" name="email" required="true" placeholder="Электронная почта">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary">Далее</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
