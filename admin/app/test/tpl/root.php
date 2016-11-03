<!DOCTYPE html>
<html>
  <?php include('html_head.php'); ?>
  <body>
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="row col-md-12" style="margin-bottom: 5px;">
            <button type="button" name="button" class="btn btn-default" onclick='$("div.add_test").modal("show")'><span class="glyphicon glyphicon-plus"></span></button>
          </div>
          <div class="row col-md-12">
            <table>
              <?php while($row = $params['test']->fetch()){ ?>
                <tr>
                  <td style="padding: 7px; width: 200px;">
                    <a href="?id=<?=$row['id']?>" class="active" style="display: block; <?=($row['id']==$req['id']?'background-color: whitesmoke;':'')?>  padding: 7px;"><?=$row['name']?></a>
                  </td>
                  <td style="padding: 7px;">
                    <button type="button" name="button" class="btn btn-default" onclick='$("div.add_test").modal("show")'><span class="glyphicon glyphicon-remove"></span></button>
                  </td>
                </tr>
              <?php } ?>
            </table>
          </div>
        </div>
        <div class="col-md-9">
          <?php if($req['id']) {?>
              <div class="row col-md-12" style="margin-bottom: 5px;">
                <button type="button" name="button" class="btn btn-default btn-sm" onclick='$("div.add_quest").modal("show")'><span class="glyphicon glyphicon-plus"></span></button>
              </div>
              <div class="row" style="margin-bottom: 5px;">
                <form class="" action="/admin/test/save_quest" method="post">
                  <?php while($row = $params['quest']->fetch()){ ?>
                    <div class="col-md-11 alert alert-info">
                      <div class="row col-md-12"> <?=$row['question']?>   </div>
                      <div class="row col-md-12">
                        <button type="button" name="button" class="btn btn-default btn-sm" onclick='add_request(this, <?=$row['id']?>)'>Добавить вариант</button>
                      </div>
                      <div class="col-md-6 reqlist">
                        <?php if($row['res']) foreach(json_decode($row['res'], 1) as $k=>$v){ ?>
                          <div class="row form-group" data-res-id="<?=$v['id']?>">
                            <div class="col-md-8"><input type="text" class="form-control input-sm" name="res[<?=$row['id']?>][<?=$v['id']?>][text]" value="<?=$v['text']?>"></div>
                            <div class="col-md-2"><input type="checkbox" style='margin: 0 auto;' class="form-control input-sm" name="res[<?=$row['id']?>][<?=$v['id']?>][right_res]" <?=($v['right_res']=='Y'?'checked':'')?> value="Y"></div>
                            <div class="col-md-2">
                              <button type="button" name="button" class="btn btn-default btn-sm" onclick='$(this).closest("div[data-res-id]").remove()'><span class="glyphicon glyphicon-remove"></span></button>
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
              </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      function add_request(but, req_id){
        // console.log($(but).closest('div.row').next());
        if($('div.reqlist div.row:last').length==0) var id = 1;
        else var id = $('div.reqlist div.row:last').data('res-id') + 1;
        // console.log(id);
        $(but).closest('div.row').next('div.reqlist').append(
          `<div class="row form-group" data-res-id="${id}">
            <input type="hidden"  name="res[${req_id}][${id}][new]" value="Y">
            <div class="col-md-8"><input type="text" class="form-control input-sm" name="res[${req_id}][${id}][text]" value=""></div>
            <div class="col-md-2"><input type="checkbox" style='margin: 0 auto;' class="form-control input-sm" name="res[${req_id}][${id}][right_res]" value="Y"></div>
            <div class="col-md-2">
              <button type="button" name="button" class="btn btn-default btn-sm" onclick='$(this).closest("div[data-res-id]").remove()'><span class="glyphicon glyphicon-remove"></span></button>
            </div>
          </div>`
        );
      };
    </script>
    <div class="modal fade add_test">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Добавление теста</h4>
          </div>
          <div class="modal-body">
            <form method="post" action="/admin/test/add_quest">
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="text" class="form-control" name="name" placeholder="Название теста">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <textarea class="form-control" name="description" placeholder="Описание теста"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade add_quest">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Добавление вопроса</h4>
          </div>
          <div class="modal-body">
            <form method="post" action="/admin/test/add_quest">
              <input type="hidden" name="test_id" value="<?=$req['id']?>">
              <div class="row form-group">
                <div class="col-md-12">
                  <textarea class="form-control" name="question" placeholder="Текст вопроса"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </body>
</html>
