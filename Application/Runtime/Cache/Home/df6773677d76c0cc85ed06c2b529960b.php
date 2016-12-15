<?php if (!defined('THINK_PATH')) exit();?><div class="container">
	<div class="row">
		<div class="span7"></div>
		<div class="span3">
			<form class="form-search" method="get" action="/market/search">
				<input id="name" name="name" class="input-large search-query" type="text" placeholder="搜索商品……"/>
			</form>
		</div>
		<div class="span2">
			<div class="btn-group">
				<a href="/market/search" class="btn btn-primary">高级搜索</a>
				<a href="/market/release" class="btn btn-warning">发布商品</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<nav class="navbar navbar-default" role="navigation">
				<div>
					<ul class="nav">
						<li><a href="/market/type?category=1">图书</a></li>
						<li><a href="/market/type?category=2">音像软件</a></li>
						<li><a href="/market/type?category=3">数码及配件</a></li>
						<li><a href="/market/type?category=4">家居</a></li>
						<li><a href="/market/type?category=5">电脑设备</a></li>
						<li><a href="/market/type?category=6">办公及学生用品</a></li>
						<li><a href="/market/type?category=7">票券</a></li>
						<li><a href="/market/type?category=8">电器</a></li>
						<li><a href="/market/type?category=9">美妆</a></li>
						<li><a href="/market/type?category=10">食品</a></li>
						<li><a href="/market/type?category=11">运动户外</a></li>
						<li><a href="/market/type?category=12">服装</a></li>
						<li><a href="/market/type?category=13">鞋靴</a></li>
						<li><a href="/market/type?category=14">箱包</a></li>
						<li><a href="/market/type?category=15">手表眼镜</a></li>
						<li><a href="/market/type?category=16">虚拟物品</a></li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<h2 class="text-center">
				最新商品
			</h2>
			<h5 class="text-right">

			</h5>
			<div class="row">
				<?php if(is_array($latest_products)): foreach($latest_products as $i=>$vo): ?><div class="span3">
						<div class="thumbnail" style="margin-bottom: 15px;">
							<a target="_blank" href="/market/product?product_id=<?php echo ($vo['product_id']); ?>"><img alt="300x225" src="<?php echo ($vo['url']); ?>/rectangle.300" style="height: 150px;width: 225px"/></a>
							<div class="caption">
								<h4>
									<a target="_blank" href="/market/product?product_id=<?php echo ($vo['product_id']); ?>"><?php echo ($vo["name"]); ?></a>
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
			<div class="row">
				<div class="span12">
					<h2 class="text-center">
						热门商品
					</h2>
					<h5 class="text-right">

					</h5>
					<div class="row">
						<?php if(is_array($hot_products)): foreach($hot_products as $i=>$vo): ?><div class="span3">
								<div class="thumbnail" style="margin-bottom: 15px;">
									<a target="_blank" href="product?product_id=<?php echo ($vo['product_id']); ?>"><img alt="300x225" src="<?php echo ($vo['url']); ?>/rectangle.300" style="height: 150px;width: 225px"/></a>
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
		</div>
	</div>
</div>