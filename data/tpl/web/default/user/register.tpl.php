<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('common/header-base', TEMPLATE_INCLUDEPATH));?>
<script>
	$('#form1').submit(function(){
		if($.trim($(':text[name="username"]').val()) == '') {
			util.message('没有输入用户名.', '', 'error');
			return false;
		}
		if($('#password').val() == '') {
			util.message('没有输入密码.', '', 'error');
			return false;
		}
		if($('#password').val() != $('#repassword').val()) {
			util.message('两次输入的密码不一致.', '', 'error');
			return false;
		}
/* 		<?php  if(is_array($extendfields)) { foreach($extendfields as $item) { ?>
		<?php  if($item['required']) { ?>
			if (!$.trim($('[name="<?php  echo $item['field'];?>"]').val())) {
				util.message('<?php  echo $item['title'];?>为必填项，请返回修改！', '', 'error');
				return false;
			}
		<?php  } ?>
		<?php  } } ?>
 */		<?php  if($_W['setting']['register']['code']) { ?>
		if($.trim($(':text[name="code"]').val()) == '') {
			util.message('没有输入验证码.', '', 'error');
			return false;
		}
		<?php  } ?>
	});
	var h = document.documentElement.clientHeight;
	$(".login").css('min-height',h);
</script>
<div class="head">
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php  echo $_W['siteroot'];?>">
					<img src="<?php  if(!empty($_W['setting']['copyright']['blogo'])) { ?><?php  echo tomedia($_W['setting']['copyright']['blogo'])?><?php  } else { ?>./resource/images/logo/logo.png<?php  } ?>" class="pull-left" width="110px" height="35px">
				</a>
			</div>
		</div>
	</nav>
</div>
<div class="main">
	<div class="register" style="">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="title register-nav">
					<a href="<?php  echo url('user/register', array('register_type' => 'system', 'owner_uid' => $_GPC['owner_uid']))?>" <?php  if($_GPC['register_type'] == 'system' || empty($_GPC['register_type'])) { ?>class="active"<?php  } ?>>用户名密码</a>
					<?php  if(!empty($_W['setting']['copyright']['mobile_status'])) { ?>
					<a href="<?php  echo url('user/register', array('register_type' => 'mobile', 'owner_uid' => $_GPC['owner_uid']))?>" <?php  if($_GPC['register_type'] == 'mobile') { ?>class="active"<?php  } ?>>手机注册</a>
					<?php  } ?>
				</div>
				<?php  if($_GPC['register_type'] == 'system' || empty($_GPC['register_type'])) { ?>
				<form action="" class="we7-form" method="post" role="form" id="form1">
					<div class="form-group">
						<label class="control-label col-sm-1">用户名:<span class="color-red">*</span></label>
						<div class="col-sm-11">
							<input name="username" type="text" class="form-control" placeholder="请输入用户名">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-1">密码:<span class="color-red">*</span></label>
						<div class="col-sm-11">
							<input name="password" type="password" id="password" class="form-control col-sm-10" placeholder="请输入不少于8位的密码">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-1">确认密码:<span style="color:red">*</span></label>
						<div class="col-sm-11">
							<input name="password " type="password" id="repassword" class="form-control col-sm-10" placeholder="请再次输入不少于8位的密码">
						</div>
					</div>
					<?php  if($extendfields) { ?>
						<?php  if(is_array($extendfields)) { foreach($extendfields as $item) { ?>
							<div class="form-group">
								<label class="control-label col-sm-1"><?php  echo $item['title'];?>:<?php  if($item['required']) { ?><span class="color-red">*</span><?php  } ?></label>
								<div class="col-sm-11">
									<?php  echo tpl_fans_form($item['field'])?>
								</div>
							</div>
						<?php  } } ?>
					<?php  } ?>
					<?php  if($_W['setting']['register']['code']) { ?>
						<div class="form-group">
							<label class="control-label col-sm-1">验证码:<span class="color-red">*</span></label>
							<div class="col-sm-11">
								<div class="input-group">
									<input name="code" type="text" class="form-control" placeholder="请输入验证码">
									<a href="javascript:;" class="input-group-btn imgverify"><img src="<?php  echo url('utility/code');?>" onclick="this.src='<?php  echo url('utility/code');?>' + Math.random();" style="height: 32px;"/></a>
								</div>
							</div>
						</div>
					<?php  } ?>
					<div class="login-submit text-center">
						<input type="submit" name="submit" value="注册" class="btn btn-primary" />
						<a href="<?php  echo url('user/login');?>" class="btn btn-default">登录</a>
						<input name="token" value="<?php  echo $_W['token'];?>" type="hidden" />
						<input name="owner_uid" value="<?php  echo $_GPC['owner_uid'];?>" type="hidden" />
						<input name="register_type" value="" type="hidden" />
						<input name="do" value="register" type="hidden" />
					</div>
					</form>
					<?php  } ?>

					<!--div class="form-group">
						<label>邀请码:<span style="color:red">*</span></label>
						<input name="invitation" type="text" class="form-control" placeholder="请输入邀请码">
					</div-->
					<?php  if($_GPC['register_type'] == 'mobile') { ?>
					<form action="javascript:;" class="we7-form">
					<div class="register-mobile" ng-controller="UsersRegisterMobile" ng-cloak>
						<div class="form-group">
							<label class="control-label col-sm-2">手机号:<span class="color-red">*</span></label>
							<div class="col-sm-10">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="请输入常用手机号" ng-model="mobile">
									<a href="javascript:;" class="input-group-btn">
										<!--<button class="btn btn-primary">发送验证码</button>-->
										<input type="button" class="btn btn-primary send-code" ng-disabled="isDisable" ng-click="sendMessage()" value="{{text}}">
									</a>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">输入验证码:<span class="color-red">*</span></label>
							<div class="col-sm-10">
								<div class="input-group">
									<input ng-model="imagecode" type="text" class="form-control" placeholder="请输入图形验证码">
									<a href="javascript:;" class="input-group-btn imgverify" ng-click="changeVerify()"><img ng-src="{{image}}" style="height: 32px;"/></a>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">输入验证码:<span class="color-red">*</span></label>
							<div class="col-sm-10">
								<input ng-model = 'smscode' type="text" class="form-control" placeholder="请输入手机验证码">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">密码:<span class="color-red">*</span></label>
							<div class="col-sm-10">
								<input ng-model="password" type="password" class="form-control" placeholder="请输入不少于8位的密码">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">确认密码:<span class="color-red">*</span></label>
							<div class="col-sm-10">
								<input ng-model="repassword" type="password"  class="form-control" placeholder="请再次输入密码">
							</div>
						</div>
						<div class="login-submit text-center">
							<input type="submit" ng-click="register()" value="注册" class="btn btn-primary" />
							<a href="<?php  echo url('user/login');?>" class="btn btn-default">登录</a>
						</div>
					</div>
					</form>
				<?php  } ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	angular.module('userManageApp').value('config', {
		'owner_uid': "<?php echo !empty($_GPC['owner_uid']) ? $_GPC['owner_uid'] : 0?>",
		'register_type': "<?php echo !empty($_GPC['register_type']) ? $_GPC['register_type'] : 0?>",
		'register_sign': "<?php echo !empty($register_sign) ? $register_sign : 'null'?>",
		'image' : "<?php  echo url('utility/code')?>",
		'links' : {
			'valid_mobile_link': "<?php  echo url('user/register/valid_mobile')?>",
			'send_code_link': "<?php  echo url('utility/verifycode')?>",
			'img_verify_link': "<?php  echo url('utility/code')?>",
			'register_link': "<?php  echo url('user/register/register')?>",
		},
	});
	angular.bootstrap($('.register-mobile'), ['userManageApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-base', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-base', TEMPLATE_INCLUDEPATH));?>
