<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-header">
    当前位置：
    <span class="text-primary">页面设计</span>
</div>

<div class="page-content">
    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('app/_tab', TEMPLATE_INCLUDEPATH)) : (include template('app/_tab', TEMPLATE_INCLUDEPATH));?>

    <form action="./index.php">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="ewei_shopv2" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r" value="app.page" />

        <div class="page-toolbar">
            <?php if(cv('app.page.add')) { ?>
                <div class="col-sm-4">
                    <a class="btn btn-primary btn-sm" href="<?php  echo webUrl('app/page/add')?>"><i class="fa fa-plus"></i> 新建页面</a>
                </div>
            <?php  } ?>

            <div class="col-sm-5 pull-right">
                <div class="input-group">
                    <span class="input-group-select">
                        <select name="type" class="form-control  input-sm select2" style="width:120px;">
                            <option value="">页面类型</option>
                            <option value="2" selected>商城首页</option>
                        </select>
                    </span>
                    <input type="text" class="input-sm form-control" name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入页面标题关键字进行搜索">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"> 搜索</button>
                    </span>
                </div>
            </div>
        </div>
    </form>

    <?php  if(empty($list)) { ?>
    <div class="panel panel-default">
        <div class="panel-body empty-data">
            未查询到<?php  if(!empty($_GPC['keyword'])) { ?>"<?php  echo $_GPC['keyword'];?>"<?php  } ?>相关页面
        </div>
    </div>
    <?php  } else { ?>
        <div class="page-table-header">
            <input type="checkbox">
            <div class="btn-group">
                <?php if(cv('app.page.delete')) { ?>
                <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch-remove" data-confirm="确认要批量删除?" data-href="<?php  echo webUrl('app/page/sys/delete')?>" disabled="disabled"><i class="icow icow-shanchu1"></i> 删除</button>
                <?php  } ?>
                <?php if(cv('app.page.edit')) { ?>
                <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php  echo webUrl('app/page/status',array('status'=>1))?>"><i class='icow icow-qiyong'></i> 启用</button>
                <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php  echo webUrl('app/page/status',array('status'=>0))?>"><i class='icow icow-jinyong'></i> 禁用</button>
                <?php  } ?>
            </div>
        </div>

        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th style="width:25px;"></th>
                <th>页面名称</th>
                <th style="width: 120px; text-align: center;">页面类型</th>
                <th style="width: 100px; text-align: center;">状态</th>
                <th style="width: 155px;">创建时间</th>
                <th style="width: 155px;">最后修改时间</th>
                <th style="width: 95px;">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td>
                        <input type="checkbox" value="<?php  echo $row['id'];?>">
                    </td>
                    <td>
                        <?php  if(!empty($row['isdefault'])) { ?>
                            <span class="label label-primary">默认首页</span>
                        <?php  } ?>
                        <?php  echo $row['name'];?>
                    </td>
                    <td style="text-align: center;">
                        <?php  if($row['type']==2) { ?>
                        <span class="label label-success">商城首页</span>
                        <?php  } ?>
                    </td>
                    <td style="text-align: center;">
                        <span class="label <?php  if($row['status']==1) { ?>label-primary<?php  } else { ?>label-default<?php  } ?>"
                            <?php if(cv('app.page.edit')) { ?>
                                data-toggle='ajaxSwitch'
                                data-switch-value='<?php  echo $row['status'];?>'
                                data-switch-value0='0|禁用|label label-default|<?php  echo webUrl('app/page/status',array('status'=>1,'id'=>$row['id']))?>'
                                data-switch-value1='1|启用|label label-primary|<?php  echo webUrl('app/page/status',array('status'=>0,'id'=>$row['id']))?>'
                                style="cursor: pointer;"
                            <?php  } ?> >
                        <?php  if($row['status']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?>
                        </span>
                    </td>
                    <td><?php echo empty($row['createtime'])? '-': date('Y-m-d H:i:s', $row['createtime'])?></td>
                    <td><?php echo empty($row['lasttime'])? '-': date('Y-m-d H:i:s', $row['lasttime'])?></td>
                    <td>
                        <?php if(cv('app.page.edit')) { ?>
                        <a class="btn  btn-op btn-operation" href="<?php  echo webUrl('app/page/edit', array('id'=>$row['id']))?>">
                            <span data-toggle="tooltip" data-placement="top" data-original-title="编辑"><i class="icow icow-bianji2"></i></span>
                        </a>
                        <?php  } ?>
                        <?php  if(empty($row['isdefault'])) { ?>
                            <?php if(cv('app.page.delete')) { ?>
                            <a class="btn  btn-op btn-operation" data-toggle="ajaxRemove" href="<?php  echo webUrl('app/page/delete', array('id'=>$row['id']))?>" data-confirm="确定要删除该页面吗？">
                                <span data-toggle="tooltip" data-placement="top" data-original-title="删除"><i class="icow icow-shanchu1"></i></span>
                            </a>
                            <?php  } ?>
                            <?php if(cv('app.page.edit')) { ?>
                            <a class="btn  btn-op btn-operation" data-toggle="ajaxPost" href="<?php  echo webUrl('app/page/setdefault', array('id'=>$row['id']))?>" data-confirm="确定要将此页面设置为默认首页吗？">
                                <span data-toggle="tooltip" data-placement="top" data-original-title="设为默认"><i class="icow icow-home1"></i></span>
                            </a>
                            <?php  } ?>
                        <?php  } ?>
                    </a>
                    </td>
                </tr>
            <?php  } } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <?php if(cv('app.page.delete')) { ?>
                        <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch-remove" data-confirm="确认要批量删除?" data-href="<?php  echo webUrl('app/page/delete')?>" disabled="disabled"><i class="icow icow-shanchu1"></i> 删除</button>
                        <?php  } ?>
                        <?php if(cv('app.page.edit')) { ?>
                        <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php  echo webUrl('app/page/status',array('status'=>1))?>"><i class='icow icow-qiyong'></i> 启用</button>
                        <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php  echo webUrl('app/page/status',array('status'=>0))?>"><i class='icow icow-jinyong'></i> 禁用</button>
                        <?php  } ?>
                    </td>
                    <td colspan="5" style="text-align: right;">
                        <?php  echo $pager;?>
                    </td>
                </tr>
            </tfoot>
        </table>
    <?php  } ?>

</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<!--NDAwMDA5NzgyNw==-->