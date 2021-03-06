<?php if (!defined('THINK_PATH')) exit();?><div class="container">
    <div class="row">
        <div class="span12">
            <ul class="breadcrumb">
                <li>
                    <a href="../">主页</a> <span class="divider">/</span>
                </li>
                <li class="active">
                    <a href="#">修改商品</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="span2">
            <img class="img-polaroid" alt="140x140" src="img/a.jpg" /><img class="img-polaroid" alt="140x140" src="img/a.jpg" /><img class="img-polaroid" alt="140x140" src="img/a.jpg" />
        </div>
        <div class="span2">
            <img class="img-polaroid" alt="140x140" src="img/a.jpg" /><img class="img-polaroid" alt="140x140" src="img/a.jpg" /><img class="img-polaroid" alt="140x140" src="img/a.jpg" />
        </div>
        <div class="span2">
            <img class="img-polaroid" alt="140x140" src="img/a.jpg" /><img class="img-polaroid" alt="140x140" src="img/a.jpg" /><img class="img-polaroid" alt="140x140" src="img/a.jpg" />
        </div>
        <div class="span6">
            <form class="form-horizontal">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="product_name">商品名称</label>
                        <div class="controls">
                            <input id="product_name" name="product_name" class="input-xlarge" size="60" type="text" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="min_price">最低价格</label>
                        <div class="controls">
                            <input id="min_price" name="min_price" class="input-xlarge" type="text" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="max_price">最高价格</label>
                        <div class="controls">
                            <input id="max_price" name="max_price" class="input-xlarge" type="text" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="main_category">类别</label>
                        <div class="controls">
                            <select id="main_category" name="main_category" class="input-xlarge"> <option>全部类别</option></select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="category">子类别</label>
                        <div class="controls">
                            <select id="category" name="category" class="input-xlarge"> <option>全部子类别</option></select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="quantity">数量</label>
                        <div class="controls">
                            <input id="quantity" name="quantity" class="input-xlarge" type="number" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="fineness">成色</label>
                        <div class="controls">
                            <select id="fineness" name="fineness" class="input-xlarge"> <option value="5">全新5</option> <option value="4">九五成以上4</option> <option value="3">九成以上3</option> <option value="2">八成以上2</option> <option value="1">七成以上1</option> <option value="0">七成以下0</option></select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="source">商品来源</label>
                        <div class="controls">
                            <select id="source" name="source" class="input-xlarge"> <option value="0">未知0</option> <option value="1">网购1</option> <option value="2">代购2</option> <option value="3">海淘3</option> <option value="4">线下商店4</option> <option value="5">奖品或赠品5</option> <option value="6">其他6</option></select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="description">商品描述（600字以内）</label>
                        <div class="controls">
							<textarea id="description" name="description">
							</textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="submit"></label>
                        <div class="controls">
                            <button id="submit" name="submit" class="btn btn-success">完成修改</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>