<?php if (!defined('THINK_PATH')) exit();?><script>
	$(document).ready(function() {
		$('#page').change(function(){
			window.location.href = window.location.href+"&page="+$('#page').val();
		});
		$('#category').change(function(){
			$.get("getBranchType", {
				type_id: $(this).val()
			},
			function(data){
				$('#branch_category').empty();
				$('#branch_category').html('<option value="" selected>全部子类</option>');
				for (var i in data){
					$('#branch_category').append('<option value="'+data[i]['category_id']+'">'+data[i]['name']+'</option>');
				}
			});
		});
	});
</script>
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="row">
				<div class="span12">
					<ul class="breadcrumb">
						<li>
							<a href="#">主页</a> <span class="divider">/</span>
						</li>
						<li class="active">
							搜索结果
						</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="span3">
					<form class="form-horizontal" action="" method="get">
						<fieldset>
							<div class="control-group">
								<div class="input-prepend">
									<span class="add-on">关键字</span><input class="input-medium" id="name" name="name" type="text" />
								</div>
							</div>
							<div class="control-group">
								<select class="input-large" id="category" name="category">
									<option value="" selected>全部类别</option>
									<?php if(is_array($main_category_list)): foreach($main_category_list as $key=>$vo): ?><option value="<?php echo ($vo["category_id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
								</select>
							</div>
							<div class="control-group">
								<select class="input-large" id="branch_category" name="branch_category">
									<option value="" selected>全部子类</option>
								</select>
							</div>
							
							<div class="control-group">
								<div class="input-prepend">
									<span class="add-on">价格下限</span><input class="input-medium" id="low_minPrice" name="low_minPrice" type="text" />
								</div>
							</div>
							<div class="control-group">
								<div class="input-prepend">
									 <span class="add-on">价格上限</span><input class="input-medium" id="high_minPrice" name="high_minPrice" type="text" />
								</div>
							</div>
							
							<div class="control-group">
								<select id="fineness" name="fineness" class="input-large">
									<option value="0-5" selected>全部成色</option>
									<option value="0-1">七成以下->七成新</option>
									<option value="0-2">七成以下->八成新</option>
									<option value="0-3">七成以下->九成新</option>
									<option value="0-4">七成以下->九五成新</option>
									<option value="1-2">七成->八成新</option>
									<option value="1-3">七成->九成新</option>
									<option value="1-4">七成->九五新</option>
									<option value="1-5">七成->全新</option>
									<option value="2-3">八成->九成新</option>
									<option value="2-4">八成->九五成新</option>
									<option value="2-5">八成->全新</option>
									<option value="3-4">九成->九五成新</option>
									<option value="3-5">九成->全新</option>
									<option value="4-5">九五成->全新</option>
								</select>
							</div>
							<div class="control-group">
								<button class="btn btn-success" id="search" name="search">搜索</button>
							</div>
						</fieldset>
					</form>
				</div>
				<div class="span9">
					<div class="container"></div>
					<?php if(is_array($products)): foreach($products as $i=>$vo): ?><div class="span2">
							<div class="thumbnail" style="margin: 10px 1px;">
								<a target="_blank" href="product?product_id=<?php echo ($vo['product_id']); ?>"><img alt="300x225" src="<?php echo ($vo['url']); ?>/rectangle.300" style="width: 140px;height: 100px"/></a>
								<div class="caption">
									<h4>
										<a target="_blank" href="product?product_id=<?php echo ($vo['product_id']); ?>"><?php echo ($vo["name"]); ?></a>
									</h4>
									<p>
										<?php echo ($vo['min_price']); ?>元<?php if($vo['min_price'] < $vo['max_price']): ?>起<?php endif; ?> |
										数量 <?php echo ($vo['quantity'] - $vo['quantity_sold']); ?> |
										<?php switch($vo["fineness"]): case "0": ?>七成新以下<?php break;?>
											<?php case "1": ?>七成新<?php break;?>
											<?php case "2": ?>八成新<?php break;?>
											<?php case "3": ?>九成新<?php break;?>
											<?php case "4": ?>九五成新<?php break;?>
											<?php case "5": ?>全新<?php break;?>
											<?php default: ?>新旧未知<?php endswitch;?>
									</p>
								</div>
							</div>
						</div><?php endforeach; endif; ?>
				</div>
				</div>
			</div>
			<div align="right">
				<select id="page" name="page" class="input-small">
					<?php $__FOR_START_4148__=1;$__FOR_END_4148__=$num_pages+1;for($i=$__FOR_START_4148__;$i < $__FOR_END_4148__;$i+=1){ ?><option value="<?php echo ($i); ?>" <?php if($i == $page): ?>selected<?php endif; ?>>第<?php echo ($i); ?>页</option><?php } ?>
				</select>
			</div>
		</div>
	</div>
</div>