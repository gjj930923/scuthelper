<?php if (!defined('THINK_PATH')) exit();?><script>
	$(document).ready(function () {
		$("#deleted_exception").change(function(){
			if($(this).is(':checked')) {
				$(".order_deleted").hide();
			}
			else{
				$(".order_deleted").show();
			}
		});
		$("[data-toggle='popover']").popover();
		$('#order_acception_modal').modal('hide');
		$('#order_rejection_modal').modal('hide');
		$('#order_acception_modal').hide();
		$('#order_rejection_modal').hide();
		$('#address1').typeahead({
			source: function (query, process) {
				var parameter = {query: query};
				$.post('getAddresses', parameter, function (data) {
					process(data);
				});
			},
			items: 3
		});
		$('#order_submit_button').click(function(){
			$('#order_submit_button').button('loading');
			accept_order();
		});
		$('#order_reject_button').click(function(){
			$('#order_reject_button').button('loading');
			reject_order();
		});
		$('#order_delete_button').click(function(){
			$('#order_delete_button').button('loading');
			delete_order();
		});
		var date = new Date();
		var date_string = date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate()+' '+date.getHours()+':'+date.getMinutes()+':'+date.getSeconds();
		$('#real_exchange_time').datetimepicker({
			startDate: date_string,
			format: 'yyyy-mm-dd hh:ii',
			autoclose: true,
			startView: 'month',
			maxView: 'month',
			todayBtn: true,
			todayHighlight: true
		});
		$('[id^=product_options]').change(function(){
			$('#product_option_confirm_button').unbind("click");
			var value = $(this).val().split("-");
			var product_id = value[0];
			var value_num = value[1];
			var product_name = $('#product-'+product_id+' td:eq(0)').text();
			var product_price = $('#product-'+product_id+' td:eq(2)').text().split("-");
			var product_quantity = parseInt($.trim($('#product-'+product_id+' td:eq(4)').text()));
			if(isNaN(product_quantity)){
				product_quantity = 0;
			}
			var string_discount = "您希望将价格调整为<strong>X</strong>元？";
			var string_add = "您希望添加商品库存至<strong>X</strong>？";
			var string_delete = '您希望删除商品 <strong>X</strong>吗？<br>商品删除后不可恢复，相关订单都会被取消。<br>交易达成后自动调整商品数量，售罄后商品自动下架，不必人工删除。';
			var discount = 1.0;
			var new_quantity = 0;
			switch(value_num) {
				case "1":
					discount = 0.95;
					break;
				case "2":
					discount = 0.9;
					break;
				case "3":
					discount = 0.85;
					break;
				case "4":
					discount = 0.8;
					break;
				case "5":
					discount = 0.7;
					break;
				case "6":
					discount = 0.5;
					break;
				case "11":
					new_quantity = 1;
					break;
				case "12":
					new_quantity = 5;
					break;
				case "13":
					new_quantity = 10;
					break;
				default:
			}
			var string = "";
			var type = 0;
			if(value_num > 0 && value_num < 10){
				type = 1;
				if(product_price[1])
					string = string_discount.replace("X",(product_price[0]*discount).toFixed(2)+'-'+(product_price[1]*discount).toFixed(2));
				else
					string = string_discount.replace("X",(product_price[0]*discount).toFixed(2));
				$('#product_option_confirm .modal-body').html(string);
				$('#product_option_confirm').modal('show');
			}
			else if(value_num > 10 && value_num < 20){
				type = 2;
				string = string_add.replace("X",new_quantity + product_quantity);
				$('#product_option_confirm .modal-body').html(string);
				$('#product_option_confirm').modal('show');
			}
			else if(value_num == 21){
				type = 3;
				string = string_delete.replace("X",product_name);
				$('#product_option_confirm .modal-body').html(string);
				$('#product_option_confirm').modal('show');
			}
			else if(value_num == 22){
				window.location.href = "release?product_id="+product_id;
				return;
			}
			if(type == 1){
				$('#product_option_confirm_button').bind("click",function(){
					product_option_confirm(product_id,type,discount);
				});
			}
			else if(type == 2){
				$('#product_option_confirm_button').bind("click",function(){
					product_option_confirm(product_id,type,new_quantity);
				});
			}
			else if(type == 3){
				$('#product_option_confirm_button').bind("click",function(){
					product_option_confirm(product_id,type,0);
				});
			}
		});
	});

	function check(){
		return false;
	}

	//type = 1（打折，num为折扣）,2（商品添加量，num为添加数量）,3（删除商品）
	function product_option_confirm(product_id,type, num){
		var result = null;
		$.post("modifyProductOption",
				{
					user_id:<?php echo ($user_info['user_id']); ?>,
					product_id:product_id,
					type:type,
					num:num
				},
				function(data,status){
					switch(data.code){
						case -1:
							alert('商品不存在');
							break;
						case -2:
						case -3:
						case -4:
							alert('参数错误');
							break;
						case 0:
							$('#product_option_confirm').modal('hide');
							$('#product_option_confirm_button').button('reset');
							if(data.type == 1) {
								if (data.min_price < data.max_price) {
									//result = new Array(data.type, data.min_price + '-' + data.max_price);
									$('#product-'+product_id+' td:eq(2)').html(data.min_price+'-'+data.max_price);
								}
								else {
									//result = new Array(data.type, data.min_price);
									$('#product-'+product_id+' td:eq(2)').html(data.min_price);
								}
							}
							else if(data.type == 2){
								//result = new Array(data.type, data.quantity);
								$('#product-'+product_id+' td:eq(4)').html(data.quantity);
							}
							else if(data.type == 3){
								//result = new Array(data.type);
								$('#product-'+product_id).remove();
							}
							break;
						default:
					}
				});
		return result;
	}

	function show_order_acception_modal(order_id,min_price,max_price,expect_exchange_time,address1,address2){
		$('#order_acception_modal').show();
		$('#order_acception_modal').modal('show');
		$('#order_id').val(order_id);
		$('#real_exchange_time').val(expect_exchange_time);
		$('#address1').val(address1);
		$('#address2').val(address2);
		$('#payment_amount').val(min_price);
		if(min_price < max_price){
			$('#order_price').html(min_price+'-'+max_price);
		}
		else{
			$('#order_price').html(min_price);
		}
	}

	function show_order_rejection_modal(order_id){
		$('#order_rejection_modal').show();
		$('#order_rejection_modal').modal('show');
		$('#order_id').val(order_id);
	}

	function show_order_delete_modal(order_id){
		$('#order_delete_modal').modal('show');
		$('#order_delete_button').attr('onclick','delete_order('+order_id+')');
	}

	function accept_order(){
		$.post("updateOrder",
			{
				order_id:$('#order_id').val(),
				real_exchange_time:$('#real_exchange_time').val(),
				seller_note:$('#seller_note').val(),
				payment_amount:$('#payment_amount').val(),
				address1:$('#address1').val(),
				address2:$('#address2').val(),
				is_accept:1
			},
			function(data,status){
				switch(data){
					case "-1":
						$('#order_acception_modal_alert').html('订单不存在');
						break;
					case "-2":
						$('#order_acception_modal_alert').html('订单已被取消');
						break;
					case "-3":
						$('#order_acception_modal_alert').html('信息不完整');
						break;
					case "-4":
						$('#order_acception_modal_alert').html('更新订单失败');
						break;
					case "0":
						$('#order_acception_modal').modal('hide');
						$('#orders_for_deal-'+$('#order_id').val()+' td:last').html("已同意");//已同意
						break;
					default:
				}
				$('#order_submit_button').button('reset');
			});
		return false;
	}

	function reject_order(){
		$.post("updateOrder",
				{
					order_id:$('#order_id').val(),
					is_accept:0
				},
				function(data,status){
					switch(data){
						case "-1":
							$('#order_rejection_modal_alert').html('订单不存在');
							break;
						case "-2":
							$('#order_rejection_modal_alert').html('订单已被取消');
							break;
						case "-4":
							$('#order_rejection_modal_alert').html('更新订单失败');
							break;
						case "0":
							$('#order_rejection_modal').modal('hide');
							$('#orders_for_deal-'+$('#order_id').val()+' td:last').html("已回绝");//已同意
							break;
						default:
					}
					$('#order_reject_button').button('reset');
				});
		return false;
	}

	function delete_order(order_id){
		$.post("deleteOrder",
				{
					order_id:order_id,
					user_id:<?php echo ($user_info['user_id']); ?>
				},
				function(data,status){
					switch(data){
						case "-1":
						case "-2":
							$('#order_delete_modal_alert').html('订单不存在');
							break;
						case "0":
							$('#order_delete_modal').modal('hide');
							break;
						default:
					}
					$('#order_delete_button').button('reset');
				});
		return false;
	}
</script>
<!-- 模态框（Modal） -->
<div class="modal fade" id="order_acception_modal" tabindex="-1" role="dialog"
	 aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">
					完善确认信息：
				</h4>
			</div>
		</div><!-- /.modal-content -->
		<div class="modal-body">
			<form class="form-horizontal">
				<fieldset>
					<div class="control-group">
							<div class="alert"  id="order_acception_modal_alert">
								请注意确认信息的内容，一经提交不可修改！
							</div>
							<input id="order_id" type="hidden">
							<input id="is_accept" type="hidden" value="1">
							<label class="control-label" for="seller_note">备注信息</label>
							<div class="controls">
								<textarea id="seller_note" name="seller_note" style="width: 98%" placeholder="选填"></textarea>
								<h5 class="help-block">您设定的价格为<strong id="order_price"></strong>元</h5>
							</div>
							<label class="control-label" for="payment_amount">交易金额？</label>
							<div class="controls">
								<input id="payment_amount" name="payment_amount" class="input-large" type="text" required>
								<h5 class="help-block">默认为买家设定的时间</h5>

							</div>
							<label class="control-label" for="payment_amount">交易时间？</label>
							<div class="controls">
								<input id="real_exchange_time" name="real_exchange_time" class="input-large" type="text" required>
								<h5 class="help-block">默认为买家设定的地点</h5>

							</div>
                    		<label class="control-label">交易地点？</label>
								<div class="controls">
                                    <input id="address1" name="address1" placeholder="楼栋（地点）" class="input-medium" type="text"  required data-provide="typeahead" autocomplete="off">
                                	<input id="address2" name="address2" placeholder="房间（选填）" class="input-medium" type="text">
									<p class="help-block"> </p>

                                </div>
						    <div class="controls"><button id="order_submit_button" name="order_submit_button" class="btn btn-primary" onclick="return check();">确认</button></div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div><!-- /.modal -->
<!-- 模态框（Modal） -->
<div class="modal fade" id="order_rejection_modal" tabindex="-1" role="dialog"
	 aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">
					完善回绝信息
				</h4>
			</div>
		</div><!-- /.modal-content -->
		<div class="modal-body">
			<form class="form-horizontal">
				<fieldset>
					<div class="control-group">
						<div class="alert" id="order_rejection_modal_alert">
							请注意：以下内容一经提交不可修改！
						</div>
						<input id="order_id" type="hidden">
						<input id="is_accept" type="hidden" value="3">
						<label class="control-label" for="seller_note">回绝理由</label>
						<div class="controls">
							<textarea id="seller_note" name="seller_note" style="width: 98%" placeholder="选填" rows="5"></textarea>
							<p class="help-block"></p>
						</div>
						<div class="controls"><button id="order_reject_button" name="order_reject_button" class="btn btn-warning" onclick="return check();">确认</button></div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div><!-- /.modal -->
<!-- 模态框（Modal） -->
<div class="modal hide fade" id="order_delete_modal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>删除确认</h3>
	</div>
	<div class="modal-body">
		<div class="alert" id="order_delete_modal_alert">
			请注意：删除之后不可恢复！
		</div>
	</div>
	<div class="modal-footer">
		<a class="btn btn-warning" id="order_delete_button">确认</a>
	</div>
</div><!-- /.modal -->
<!-- 模态框（Modal） -->
<div class="modal hide fade" id="product_option_confirm">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>商品操作确认</h3>
	</div>
	<div class="modal-body">
		<p></p>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">关闭</a>
		<a href="#" class="btn btn-primary" id="product_option_confirm_button">确认修改</a>
	</div>
</div><!-- /.modal -->
<div class="container">
	<div class="row">
		<div class="span12">
			<ul class="breadcrumb">
				<li>
					<a href="/market">主页</a> <span class="divider">/</span>
				</li>
				<li class="active">
					个人中心 <span class="divider">/</span>
				</li>
				<li class="active">
					我的商品与求购
				</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="span2">
			<ul class="nav nav-list">
				<li class="active">
					<a href="#">我的商品与求购</a>
				</li>
				<li>
					<a href="/market/favorite">我的收藏</a>
				</li>
				<li>
					<a href="/market/QAs">问答处理</a>
				</li>
				<li>
					<a href="/market/modifyPersonalInfo">个人信息修改</a>
				</li>
				<li>
					<a href="/market/password">密码修改</a>
				</li>
				<li>
					<a href="/market/msgbox">收件箱</a>
				</li>
				<li>
					<a href="/market/feedback">意见反馈</a>
				</li>
			</ul>
		</div>
		<div class="span10">
			<ul class="nav nav-pills nav-tabs">
				<li class="active">
					<a data-toggle="pill" href="#tab1">已发布商品</a>
				</li>
				<li>
					<a data-toggle="pill" href="#tab2">我的求购</a>
				</li>
				<li>
					<a data-toggle="pill" href="#tab3">求购信息待处理</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<table class="table table-hover table-condensed">
						<thead>
							<tr>
								<th>
									商品名称
								</th>
								<th>
									发布时间
								</th>
								<th>
									价格（元）
								</th>
								<th>
									上次修改时间
								</th>
								<th>
									库存余量
								</th>
								<th>
									操作
								</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="success" id="product-<?php echo ($vo["product_id"]); ?>">
								<td><a target="_blank" href="/market/product?product_id=<?php echo ($vo["product_id"]); ?>"><?php echo ($vo["name"]); ?></a>
								</td>
								<td><?php echo ($vo["time"]); ?>
								</td>
								<td><?php echo ($vo["min_price"]); if($vo['min_price'] < $vo['max_price']): ?>-<?php echo ($vo["max_price"]); endif; ?>
								</td>
								<td><?php echo ($vo["modify_time"]); ?>
								</td>
								<td><?php if(($vo['quantity_sold'] > $vo['quantity']) OR ($vo['quantity_sold'] == $vo['quantity'])): ?>已售罄<?php else: echo ($vo['quantity'] - $vo['quantity_sold']); endif; ?>
								</td>
								<td>
									<select class="input-small" id="product_options-<?php echo ($vo["product_id"]); ?>">
										<option value="<?php echo ($vo["product_id"]); ?>-0" selected="selected">请选择</option>
										<option value="<?php echo ($vo["product_id"]); ?>-1">商品打95折</option>
										<option value="<?php echo ($vo["product_id"]); ?>-2">商品打9折</option>
										<option value="<?php echo ($vo["product_id"]); ?>-3">商品打85折</option>
										<option value="<?php echo ($vo["product_id"]); ?>-4">商品打8折</option>
										<option value="<?php echo ($vo["product_id"]); ?>-5">商品打7折</option>
										<option value="<?php echo ($vo["product_id"]); ?>-6">商品半价</option>
										<option value="<?php echo ($vo["product_id"]); ?>-10">--------</option>
										<option value="<?php echo ($vo["product_id"]); ?>-11">添加商品数量1</option>
										<option value="<?php echo ($vo["product_id"]); ?>-12">添加商品数量5</option>
										<option value="<?php echo ($vo["product_id"]); ?>-13">添加商品数量10</option>
										<option value="<?php echo ($vo["product_id"]); ?>-20">--------</option>
										<option value="<?php echo ($vo["product_id"]); ?>-21">删除商品</option>
										<option value="<?php echo ($vo["product_id"]); ?>-22">编辑商品</option>
									</select>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
				</div>
				<div class="tab-pane" id="tab2">
					<label class="checkbox" for="deleted_exception">
						<input name="deleted_exception" id="deleted_exception" value="true" type="checkbox">
						只显示未删除且未被取消项目
					</label>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>
									求购商品
								</th>
								<th>
									下单时间
								</th>
								<th>
									状态更新时间
								</th>
								<th>
									求购数量
								</th>
								<th>
									交易地点
								</th>
								<th>
									状态
								</th>
								<th>
									操作
								</th>
							</tr>
						</thead>
						<tbody>
						<?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="orders_for_delete-<?php echo ($vo["order_id"]); ?>" class="success <?php if(($vo["status"] == 3) OR ($vo["status"] == 4) OR ($vo["status"] == 2)): ?>order_deleted<?php endif; ?>" >
								<td><?php echo ($vo["name"]); ?>
								</td>
								<td><?php echo ($vo["time"]); ?>
								</td>
								<td><?php echo ($vo["latest_time"]); ?>
								</td>
								<td><?php echo ($vo["quantity"]); ?>
								</td>
								<td><?php echo ($vo["content"]); ?>-<?php echo ($vo["address2"]); ?>
								</td>
								<td>
									<?php switch($vo["status"]): case "0": ?>等待卖方确认<?php break;?>
										<?php case "1": ?>卖方已同意<?php break;?>
										<?php case "2": ?>商品已被删除<?php break;?>
										<?php case "3": ?>交易已被卖方取消<?php break;?>
										<?php case "4": ?>交易已被您取消<?php break;?>
										<?php default: ?>未知<?php endswitch;?>
								</td>
								<td>
									<?php switch($vo["status"]): case "0": ?><button type="button" class="btn btn-warning btn-small" href="javascript:void(0);" onclick="show_order_delete_modal(<?php echo ($vo["order_id"]); ?>)">取消订单</button><?php break;?>
										<?php case "1": ?><button type="button" class="btn btn-warning btn-small" href="javascript:void(0);" onclick="show_order_delete_modal(<?php echo ($vo["order_id"]); ?>)">取消订单</button><?php break; endswitch;?>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
				</div>
				<div class="tab-pane" id="tab3">
					<p>具体房间和联系方式请确认后查看信息列表或邮箱。</p>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>
									商品名称
								</th>
								<th>
									下单时间
								</th>
								<th>
									求购数量
								</th>
								<th>
									期望交易地址
								</th>
								<th>
									操作
								</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($orders_for_deal)): $i = 0; $__LIST__ = $orders_for_deal;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="orders_for_deal-<?php echo ($vo["order_id"]); ?>" class="success">
								<td><?php echo ($vo["name"]); ?>
								</td>
								<td><?php echo ($vo["time"]); ?>
								</td>
								<td><?php echo ($vo["quantity"]); ?>
								</td>
								<td><?php echo ($vo["content"]); ?>-<?php echo ($vo["address2"]); ?>
								</td>
								<td>
									<?php switch($vo["status"]): case "0": ?><button type="button" class="btn btn-primary btn-small" class="detail" data-toggle="popover" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="top"
																data-content="买方备注：<?php echo ($vo["buyer_note"]); ?>">详情</button>
											<button type="button" class="btn btn-success btn-small" href="javascript:void(0);" onclick="show_order_acception_modal(<?php echo ($vo["order_id"]); ?>,<?php echo ($vo["min_price"]); ?>,<?php echo ($vo["max_price"]); ?>,'<?php echo ($vo["expect_exchange_time"]); ?>','<?php echo ($vo["content"]); ?>','<?php echo ($vo["address2"]); ?>')">确认</button>
											<button type="button" class="btn btn-warning btn-small" href="javascript:void(0);" onclick="show_order_rejection_modal(<?php echo ($vo["order_id"]); ?>)">回绝</button><?php break;?>
										<?php case "1": ?>已同意<?php break;?>
										<?php case "2": ?>商品已被删除<?php break;?>
										<?php case "3": ?>已回绝<?php break;?>
										<?php case "4": ?>已被买家取消<?php break;?>
										<?php default: ?>未知<?php endswitch;?>

								</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>