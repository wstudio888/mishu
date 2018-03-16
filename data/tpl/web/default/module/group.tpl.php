<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  if($do == 'display') { ?>
<div class="we7-page-title">
	应用权限套餐
</div>

<ul class="we7-page-tab">
	<li class="active"><a href="<?php  echo url('module/group/display') ?>">应用权限套餐列表  </a></li>
</ul>
<div class="js-system-module_group" ng-controller="moduleGroupCtrl" ng-cloak>
	<div class="combo-list">
		<div class="we7-page-search clearfix">
			<?php  if(permission_check_account_user('see_module_manage_system_group_add')) { ?>
			<div class="pull-right">
				<a href="<?php  echo url('module/group/post')?>" class="btn btn-primary">+添加应用权限套餐</a>
			</div>
			<?php  } ?>
			<form action="" method="get" class="we7-form row">
				<div class="form-group we7-padding-none col-sm-4">
					<input type="hidden" name="c" value="module">
					<input type="hidden" name="a" value="group">
					<input type="hidden" name="do" value="display">
					<div class="input-group">
						<input class="form-control" name="name" value="<?php  echo $_GPC['name'];?>" type="text" placeholder="名称" >
						<span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
					</div>
				</div>
			</form>
		</div>
		<table class="table we7-table table-hover vertical-middle">

			<col width="180px" />
			<col width="140px"/>
			<col width="140px" />
			<col width="140px" />
			<col width="140px" />
			<col width="220px" />
			<tr>
				<th class="text-left">套餐名称</th>
				<th>公众号应用个数</th>
				<th>小程序应用个数</th>
				<th>模板个数</th>
				<th>PC应用个数</th>
				<th class="text-right">操作</th>
			</tr>
			<?php  if(is_array($modules_group_list)) { foreach($modules_group_list as $module_group) { ?>
			<tr >
				<td class="text-left"><?php  echo $module_group['name'];?></td>
				<td><?php  echo count($module_group['modules'])?></td>
				<td><?php  echo count($module_group['wxapp'])?></td>
				<td><?php  echo count($module_group['templates'])?></td>
				<td><?php  echo count($module_group['webapp'])?></td>
				<td>
					<div class="link-group">
						<a href="javascript:;" class="color-default js-unfold" data-toggle="table-collapse" data-target="toggle-<?php  echo $module_group['id'];?>" ng-click="changeText($event)">展开</a>
						
							<?php  if($_W['role'] == ACCOUNT_MANAGE_NAME_FOUNDER || $_W['role'] == ACCOUNT_MANAGE_NAME_VICE_FOUNDER) { ?>
							<a href="<?php  echo url('module/group/post', array('id' => $module_group['id']))?>">编辑套餐</a>
							<a href="<?php  echo url('module/group/delete', array('id' => $module_group['id']))?>" class="del" onclick="return confirm('确定要删除套餐吗？')">删除</a>
							<?php  } ?>
						
						

					</div>
				</td>
			</tr>
			<tr class="collapse bg-light-gray" aria-expanded="true" data-id="toggle-<?php  echo $module_group['id'];?>">
				<td colspan="5">
					<div class="col-sm-1 color-gray text-left we7-padding-none">公众号应用</div>
					<div class="col-sm-11">
						<?php  if(is_array($module_group['modules'])) { foreach($module_group['modules'] as $module) { ?>
						<div class="col-sm-3 text-left text-over">
							<!--<img src="<?php  echo $module['logo'];?>" style="width:50px;height:50px;">-->
							<!--<a href=""><?php  echo $module['title'];?></a>-->
							<?php  if(empty($module['main_module'])) { ?>
							<img src="<?php  echo $module['logo'];?>" alt="">
							<?php  echo $module['title'];?>
							<?php  } else { ?>
							<span class="img">
								<img src="<?php  echo $module['logo'];?>" alt="子应用icon" class="plugin-img"/>
								<img src="<?php  echo $modules[$module['main_module']]['logo'];?>" alt="主应用icon" class="module-img"/>
							</span>
							<?php  } ?>
						</div>
						<?php  } } ?>
					</div>
				</td>
			</tr>
			<tr class="collapse bg-light-gray" aria-expanded="true" data-id="toggle-<?php  echo $module_group['id'];?>">
				<td colspan="5">
					<div class="col-sm-1 color-gray text-left we7-padding-none">小程序应用</div>
					<div class="col-sm-11">
						<?php  if(is_array($module_group['wxapp'])) { foreach($module_group['wxapp'] as $wxapp) { ?>
						<div class="col-sm-3 text-left text-over">
							<img src="<?php  echo $wxapp['logo'];?>">
							<a href=""><?php  echo $wxapp['title'];?></a>
						</div>
						<?php  } } ?>
					</div>
				</td>
			</tr>
			<tr class="collapse bg-light-gray" aria-expanded="true" data-id="toggle-<?php  echo $module_group['id'];?>">
				<td colspan="5">
					<div class="col-sm-1 color-gray text-left we7-padding-none">PC应用</div>
					<div class="col-sm-11">
						<?php  if(is_array($module_group['webapp'])) { foreach($module_group['webapp'] as $webapp) { ?>
						<div class="col-sm-3 text-left text-over">
							<img src="<?php  echo $webapp['logo'];?>">
							<a href=""><?php  echo $webapp['title'];?></a>
						</div>
						<?php  } } ?>
					</div>
				</td>
			</tr>
			<tr class="collapse bg-light-gray" aria-expanded="true" data-id="toggle-<?php  echo $module_group['id'];?>">
				<td colspan="5">
					<div class="col-sm-1 color-gray text-left we7-padding-none">模板</div>
					<div class="col-sm-11">
						<?php  if(is_array($module_group['templates'])) { foreach($module_group['templates'] as $template) { ?>
						<div class="col-sm-3 text-left  text-over">
							<i class="glyphicon glyphicon-th-large"></i>
							<a href=""><?php  echo $template['title'];?></a>
						</div>
						<?php  } } ?>
					</div>
				</td>
			</tr>
			<?php  } } ?>
		</table>
	</div>
</div>
<script>
	angular.bootstrap($('.js-system-module_group'), ['moduleApp']);
	$('[data-toggle="table-collapse"]').on('click',function(){
		var id = '[data-id="'+$(this).data('target')+'"]';
		$(id).collapse('toggle');
	});
</script>
<?php  } else if($do == 'post') { ?>
<div class="js-modulegroup-post" ng-controller="moduleGroupPostCtrl" ng-cloak>
	<div class="combo-list-add">
		<ol class="breadcrumb we7-breadcrumb">
			<a href="<?php  echo url('module/group')?>"><i class="wi wi-back-circle"></i> </a>
			<li>
				<a href="<?php  echo url('module/group') ?>">套餐应用列表</a>
			</li>
			<li>
				添加套餐应用列表
			</li>
		</ol>
		<div class="we7-form">
			<div class="form-group">
				<label for="" class="control-label col-sm-3">应用套餐名称</label>
				<div class="form-controls col-sm-8">
					<input type="text" ng-model="moduleGroup.name" class="form-control"/>
				</div>
			</div>
		</div>
		<div class="panel we7-panel">
			<div class="panel-heading">
				选择公众号应用
			</div>
			<div class="panel-body we7-padding">
				<div class="row">
					<div class="col-sm-2 text-left" ng-repeat="module in groupHaveModuleApp" style="overflow: hidden">
						<img ng-src="{{ module.logo }}" alt="" style="width:33px;height:33px;" ng-if="module.main_module == ''">
						<span class="img" ng-if="module.main_module != ''">
							<img ng-src="{{ module.logo }}" alt="子应用icon" class="plugin-img"/>
							<img ng-src="{{ groupHaveModuleApp[module.main_module].logo || groupNotHaveModuleApp[module.main_module].logo }}" alt="主应用icon" class="module-img"/>
						</span>
						<span class="name">{{ module.title }}</span>
						<span class="del bg-default" ng-click="delHaveModule(module)">删除</span>
					</div>
					<div class="col-sm-2 add-more">
						<div class="we7-input-img input-more input-img">
							<a href="" class="input-addon" ng-click="addModule()">
								<span class="color-gray"></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel we7-panel">
			<div class="panel-heading">
				选择小程序应用
			</div>
			<div class="panel-body we7-padding">
				<div class="row">
					<div class="col-sm-2 text-left" ng-repeat="module in groupHaveModuleWxapp" style="overflow: hidden">
						<img src="{{ module.logo }}" alt="" class="img">{{ module.title }}
						<span class="del bg-default" ng-click="delHaveModuleWxapp(module)">删除</span>
					</div>
					<div class="col-sm-2 add-more">
						<div class="we7-input-img input-more input-img">
							<a href="" class="input-addon" ng-click="addModuleWxapp()">
								<span class="color-gray"></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel we7-panel">
			<div class="panel-heading">
				选择模板
			</div>
			<div class="panel-body we7-padding">
				<div class="row">
					<div class="col-sm-2 text-left text-over" ng-repeat="template in groupHaveTemplate">
						<i class="wi wi-home"></i>
						<a href="">{{ template.title }}</a>
						<span class="del bg-default" ng-click="delHaveTemplate(template)">删除</span>
					</div>
					<div class="col-sm-2 add-more">
						<div class="we7-input-img input-more input-img">
							<a href="" class="input-addon" ng-click="adTemplate()">
								<span class="color-gray"></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel we7-panel">
			<div class="panel-heading">
				选择PC应用
			</div>
			<div class="panel-body we7-padding">
				<div class="row">
					<div class="col-sm-2 text-left" ng-repeat="module in groupHaveModuleWebapp" style="overflow: hidden">
						<img src="{{ module.logo }}" alt="" class="img">{{ module.title }}
						<span class="del bg-default" ng-click="delHaveModuleWebapp(module)">删除</span>
					</div>
					<div class="col-sm-2 add-more">
						<div class="we7-input-img input-more input-img">
							<a href="" class="input-addon" ng-click="addModuleWebapp()">
								<span class="color-gray"></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="uploader-modal modal fade module" id="add_template"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog" style="width:800px">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">添加模板(点击添加)</h4>
				</div>

				<div class="modal-body material-content clearfix">
					<div class="material-body">
						<div class="row">
							<div class="col-sm-2 select-module" ng-repeat="template in groupNotHaveTemplate" ng-click="selectOrCancelModule(template, 'template')">
								<div class="item" ng-class="{true:'active',false:''}[template.selected]">
									<i class="wi wi-home" style="color: #ddd;font-size: 48px;position:relative; top:-15px; margin: 0;"></i>
									<div class="name">{{ template.title }}</div>
									<div class="mask">
										<span class="wi wi-right"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--注意全部有分页-->
					<div class="material-pager text-right clearfix">
						<div class="pull-left we7-form">
							<input type="checkbox" id="selected-all2" ng-change= 'selecteAllTemplate(alltemplatesel)' ng-model='alltemplatesel'>
							<label for="selected-all2">全选</label>
						</div>
						<ul class="pagination">

						</ul>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="addHaveTemplate()">确定</button>
					<button type="button" class="btn btn-default" ng-click="cancel('add_template')">取消</button>
				</div>
			</div>
		</div>
	</div>

	<div class="uploader-modal modal fade module" id="add_module"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog  modal-dialog modal-lg we7-modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">添加模块(点击添加)</h4>
				</div>

				<div class="modal-body material-content clearfix">
					<div class="material-head">
						<form action="" method="get" class="form-horizontal clearfix form-inline" role="form">
							<div class="input-group pull-left col-sm-4">
								<input type="text" name="keyword" id=""  ng-model='keyword' ng-change="filterKeyword(keyword)" class="form-control" placeholder="搜索关键字"/>
								<span class="input-group-btn"><button type="button" class="btn btn-default"><i class="wi wi-search"></i></button></span>
							</div>
						</form>
					</div>
					<div class="material-body">
						<div class="row">
							<div class="col-sm-2 select-module" ng-show="!module.hide" ng-repeat="module in groupNotHaveModuleApp" ng-click="selectOrCancelModule(module, 'module')">
								<div class="item"  ng-class="{true:'active',false:''}[module.selected]">
									<img ng-src="{{ module.logo }}"  alt="" class="icon" ng-if="module.main_module == ''"/>
									<div class="name">{{ module.title }}</div>
									<div class="mask">
										<span class="wi wi-right"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--注意全部有分页-->
					<div class="material-pager text-right clearfix">
						<div class="pull-left we7-form">
							<input type="checkbox" id="selected-all" ng-change= 'selecteAllModule(allmodulesel)' ng-model='allmodulesel'>
							<label for="selected-all">全选</label>
						</div>
						<ul class="pagination">

						</ul>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="addHaveModule()">确定</button>
					<button type="button" class="btn btn-default" ng-click="cancel('add_module')">取消</button>
				</div>
			</div>
		</div>
	</div>

	<div class="uploader-modal modal fade module" id="add_module_wxapp"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">添加小程序(点击添加)</h4>
				</div>

				<div class="modal-body material-content clearfix">
					<div class="material-body">
						<div class="row">
							<div class="col-sm-2 select-module" ng-repeat="module in groupNotHaveModuleWxapp" ng-click="selectOrCancelModule(module, 'module_wxapp')">
								<div class="item" ng-class="{true:'active',false:''}[module.selected]">
									<img ng-src="{{ module.logo }}"  alt="" class="icon" ng-if="module.main_module == ''"/>
									<div class="name">{{ module.title }}</div>
									<div class="mask">
										<span class="wi wi-right"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--注意全部有分页-->
					<div class="material-pager text-right clearfix">
						<div class="pull-left we7-form">
							<input type="checkbox" id="selected-all1" ng-change="selecteAllWxapp(allwxappsel)" ng-model="allwxappsel">
							<label for="selected-all1">全选</label>
						</div>
						<ul class="pagination">

						</ul>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="addHaveModuleWxapp()">确定</button>
					<button type="button" class="btn btn-default" ng-click="cancel('add_module_wxapp')">取消</button>
				</div>
			</div>
		</div>
	</div>

	<div class="uploader-modal modal fade module" id="add_module_webapp"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">添加PC应用(点击添加)</h4>
				</div>

				<div class="modal-body material-content clearfix">
					<div class="material-body">
						<div class="row">
							<div class="col-sm-2 select-module" ng-repeat="module in groupNotHaveModuleWebapp" ng-click="selectOrCancelModule(module, 'module_webapp')">
								<div class="item" ng-class="{true:'active',false:''}[module.selected]">
									<img ng-src="{{ module.logo }}"  alt="" class="icon"/>
									<div class="name">{{ module.title }}</div>
									<div class="mask">
										<span class="wi wi-right"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--注意全部有分页-->
					<div class="material-pager text-right clearfix">
						<div class="pull-left we7-form">
							<input type="checkbox" id="selected-all3" ng-change="selecteAllWebapp(allwebappsel)" ng-model="allwebappsel">
							<label for="selected-all3">全选</label>
						</div>
						<ul class="pagination">

						</ul>
					</div>

				</div>
				<div class="modal-footer">

					<button type="button" class="btn btn-primary" ng-click="addHaveModuleWebapp()">确定</button>
					<button type="button" class="btn btn-default" ng-click="cancel('add_module_webapp')">取消</button>
				</div>
			</div>
		</div>
	</div>
	<span class="btn btn-primary we7-padding-horizontal" ng-click="saveGroup()">提交</span>
</div>
<script>
require(['underscore'], function() {
	angular.module('moduleApp').value('config', {
		'moduleGroup' : <?php  echo json_encode($module_group)?>,
		'groupHaveModuleApp' : <?php  echo json_encode($group_have_module_app)?>,
		'groupHaveModuleWxapp' : <?php  echo json_encode($group_have_module_wxapp)?>,
		'groupHaveModuleWebapp' : <?php  echo json_encode($group_have_module_webapp)?>,
		'groupNotHaveModuleApp' : <?php  echo json_encode($group_not_have_module_app)?>,
		'groupNotHaveModuleWebapp' : <?php  echo json_encode(($group_not_have_module_webapp))?>, // angular filter 只能数组
		'groupNotHaveModuleWxapp' : <?php  echo json_encode($group_not_have_module_wxapp)?>,
		'groupHaveTemplate' : <?php  echo json_encode($group_have_template)?>,
		'groupNotHaveTemplate' : <?php  echo json_encode($group_not_have_template)?>,
		'url' : "<?php  echo url('module/group/save')?>"
	});

	angular.bootstrap($('.js-modulegroup-post'), ['moduleApp']);
	$('[data-toggle="table-collapse"]').on('click',function(){
		var id = '[data-id="'+$(this).data('target')+'"]';
		$(id).collapse('toggle');
	});
});
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>