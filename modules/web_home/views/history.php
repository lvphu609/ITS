<?php
   //echo '<pre>';
    //var_dump($history_list);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?php /*<form method="GET">
            <div class="input-group custom-search-form pull-left col-lg-4 col-md-6 col-sm-9 col-xs-12">
                <input value="<?php echo !empty($search) ? $search: ''; ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('placeholder_text_search'); ?>" name="search">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <div class="clear"></div> */ ?>
        Lịch sử hoạt động
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <?php
        if(!empty($pagination)){
            echo $pagination;
        }
        ?>
        <div class="dataTable_wrapper table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th width="6%" class="text-center"><?php echo $this->lang->line('head_title_no'); ?></th>
                    <th width="29%" class="text-center" colspan="2">Loại yêu cầu</th>
                    <th width="50%" class="text-center">Nội dung lịch sử hoạt động</th>
                    <th width="15%" class="text-center">Thời gian</th>
                    <!--<th class="text-center">#</th>-->
                </tr>
                </thead>
                <tbody>
                <?php if(count($history_list)>0): ?>
                    <?php foreach($history_list as $key => $row): ?>
                        <tr class="post-type-<?php echo $row['id']; ?>">
                            <td  class="text-center align-middel"><?php echo ++$page_stt; ?></td>
                            <td class="no-border-right text-right align-middel"><img src="<?php echo $row['avatar']; ?>" width="36"></td>
                            <td class="no-border-left align-middel"><?php echo $row['name']; ?></td>
                            <td class="align-middel"><?php echo $row['title']; ?></td>
                            <td class="align-middel"><?php echo $row['created_at']; ?></td>
                            <!--<td class="text-center">
                                <a title="<?php /*echo $this->lang->line('post_type_btn_edit_title'); */?>" class="btn btn-primary btn-xs" href="<?php /*echo base_url('admin/accounts/history/'.$row['id']); */?>">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a>
                            </td>-->
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
        if(!empty($pagination)){
            echo $pagination;
        }
        ?>
    </div>
    <!-- /.panel-body -->
</div>
<!-- /.panel -->