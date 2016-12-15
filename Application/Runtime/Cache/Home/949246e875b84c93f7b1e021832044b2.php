<?php if (!defined('THINK_PATH')) exit();?><script>
	$(document).ready(function() {
		$('#page').change(function(){
			window.location.href = window.location.href+"&page="+$('#page').val();
		});
	});
</script>
<div class="container">
	<div class="row">
		<div class="span12">
			<ul class="breadcrumb">
				<li>
					<a href="#">主页</a> <span class="divider">/</span>
				</li>
				<li>
					<?php echo ($type_name); ?>
				</li>
				<?php if(branch_type_name != null): ?><li>
						<span class="divider">/</span><?php echo ($branch_type_name); ?>
					</li><?php endif; ?>

			</ul>
		</div>
	</div>
	<div class="row">
		<div class="span2">
			<div class="accordion" id="category_list">
				<div class="accordion-heading">
					<div onfocus="this.blur();" class="accordion-toggle collapsed" data-parent="#category_list"><strong>---分类列表---</strong></div>
				</div>
				<div class="accordion-group">
					<?php if(is_array($category_list)): $i = 0; $__LIST__ = $category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo['html']); endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
		</div>
		<div class="span10">
			<div class="container"></div>
				<?php if(is_array($products)): foreach($products as $i=>$vo): ?><div class="span3" style="margin:10px;">
						<div class="thumbnail">
							<a target="_blank" href="product?product_id=<?php echo ($vo['product_id']); ?>"><img alt="300x225" src="<?php echo ($vo['url']); ?>/rectangle.300" /></a>
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
			<div class="controls" align="right">
				<select id="page" name="page" class="input-small">
					<?php $__FOR_START_19416__=1;$__FOR_END_19416__=$num_pages+1;for($i=$__FOR_START_19416__;$i < $__FOR_END_19416__;$i+=1){ ?><option value="<?php echo ($i); ?>" <?php if($i == $page): ?>selected<?php endif; ?>>第<?php echo ($i); ?>页</option><?php } ?>
				</select>
			</div>
		</div>
	</div>
</div>