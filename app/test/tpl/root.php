<!DOCTYPE html>
<html>
  <?php include('html_head.php'); ?>
  <body>
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
        <div class="row col-md-12">
          <?php if($req['id'] and $params['quest']->rowCount()) {?>
                <form class="" action="/test/save_res" method="post">
                  <input type="hidden" name="test_id" value="<?=$req['id']?>">
                  <input type="hidden" name="uemail" value="<?=$_SESSION['uemail']?>">
                  <?php while($row = $params['quest']->fetch()){ ?>
                    <div class="col-md-11 alert alert-info">
                      <div class="row col-md-12"> <?=$row['question']?>   </div>
                      <div class="col-md-6 reqlist">
                        <?php if($row['res']) foreach(json_decode($row['res'], 1) as $k=>$v){ ?>
                          <div class="row form-group" data-res-id="<?=$v['id']?>">
                            <div class="col-md-8">
                              <label for="<?=$v['id']?>"><?=$v['text']?></label>
                            </div>
                            <div class="col-md-2">
                              <input type="radio" style='margin: 0 auto;' id="<?=$v['id']?>" class="form-control input-sm" name="res[<?=$row['id']?>]" <?=($v['right_res']=='Y'?'checked':'')?> value="<?=$v['id']?>">
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  <?php } ?>
                  <div class="row col-md-6">
                    <input type="submit" name="" value="Сохранить">
                  </div>
                </form>
          <?php } ?>
        </div>
    </div>
  </body>
</html>
