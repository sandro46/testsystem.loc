<!DOCTYPE html>
<html>
  <?php include('html_head.php'); ?>
  <body>
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
      <div class="row col-md-12">
          <div class="jumbotron">
            <h1>Спасибо за прохождение теста</h1>
            <p>Результаты тестирования будут отправлены на Ваш email(<?=$req['uemail']?>)</p>
          </div>
      </div>
    </div>
  </body>
</html>
