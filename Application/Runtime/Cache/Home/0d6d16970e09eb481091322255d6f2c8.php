<?php if (!defined('THINK_PATH')) exit();?><script>
$.fn.typeahead.Constructor.prototype.blur = function() {
  var that = this;
  setTimeout(function () { that.hide() }, 250);
};
$(document).ready(function() {
  $('#address1').typeahead({
    source: function (query, process) {
      var parameter = {query: query};
      $.post('getAddresses', parameter, function (data) {
        process(data);
      });
    }
  });
  $('#major').typeahead({
    source: function (query, process) {
      var parameter = {query: query};
      $.post('getMajors', parameter, function (data) {
        process(data);
      });
    }
  });
});
</script>
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
            个人信息修改
          </li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="span2">
        <ul class="nav nav-list">
          <li>
            <a href="/market/ordersAndProducts">我的商品与求购</a>
          </li>
          <li>
            <a href="/market/favorite">我的收藏</a>
          </li>
          <li>
            <a href="/market/QAs">问答处理</a>
          </li>
          <li class="active">
            <a href="#">个人信息修改</a>
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
      <div class="span9">
        <form class="form-horizontal" method="post" action="updatePersonalInfo">
          <fieldset>
             <legend>更新个人信息</legend>

            <div class="control-group">
               <label class="control-label" for="student_id">学号</label>
              <div class="controls">
                <input id="user_id" name="user_id" class="input-large" type="hidden" value="<?php echo ($user_info['user_id']); ?>"/>
                <input id="student_id" name="student_id" class="input-large" disabled="disabled" type="text" value="<?php echo ($user_info['student_id']); ?>"/>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="real_name">真实姓名</label>
              <div class="controls">
                <input id="real_name" name="real_name" disabled="disabled" class="input-large" type="text"  value="<?php echo ($user_info['real_name']); ?>"/>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="nickname">昵称</label>
              <div class="controls">
                <input id="nickname" name="nickname" class="input-large" size="42" type="text" value="<?php echo ($user_info['nickname']); ?>" required/>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="email">邮箱</label>
              <div class="controls">
                <input id="email" name="email" class="input-large" size="50" type="text" value="<?php echo ($user_info['email']); ?>" required/>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="qq">QQ</label>
              <div class="controls">
                <input id="qq" name="qq" class="input-large" size="13" type="text" value="<?php echo ($user_info['qq']); ?>" required/>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="phone">手机号码</label>
              <div class="controls">
                <input id="phone" name="phone" class="input-large" size="11" type="text" value="<?php echo ($user_info['phone']); ?>" required/>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="short_phone">移动短号</label>
              <div class="controls">
                <input id="short_phone" name="short_phone" class="input-large" size="6" type="text" value="<?php echo ($user_info['short_phone']); ?>" placeholder="选填"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="sex">性别</label>
              <div class="controls">
                <select id="sex" name="sex" class="input-large">
                  <option value="0" <?php if(($user_info['sex'] == 0)): ?>selected="selected"<?php endif; ?>>请选择</option>
                  <option value="1" <?php if(($user_info['sex'] == 1)): ?>selected="selected"<?php endif; ?>>男</option>
                  <option value="2" <?php if(($user_info['sex'] == 2)): ?>selected="selected"<?php endif; ?>>女</option>
                  <option value="3" <?php if(($user_info['sex'] == 3)): ?>selected="selected"<?php endif; ?>>保密</option>
                </select>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="address1">楼栋</label>
              <div class="controls">
                <input id="address1" name="address1" class="input-large" size="50" type="text" value="<?php echo ($address); ?>" required data-provide="typeahead" autocomplete="off"/>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="address2">房间号</label>
              <div class="controls">
                <input id="address2" name="address2" class="input-large" size="20" type="text" value="<?php echo ($user_info['address2']); ?>" required/>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="campus">校区</label>
              <div class="controls">
                <select id="campus" name="campus" class="input-large">
                  <?php if(is_array($campus_list)): $i = 0; $__LIST__ = $campus_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["campus_id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="school">学院</label>
              <div class="controls">
                <select id="school" name="school" class="input-large">
                  <?php if(is_array($school_list)): $i = 0; $__LIST__ = $school_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["school_id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="major">专业班级</label>
              <div class="controls">
                <input id="major" name="major" class="input-large" size="40" type="text" value="<?php echo ($major); ?>" required data-provide="typeahead" autocomplete="off" placeholder="如：软件工程卓越班"/>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="year">入学年份</label>
              <div class="controls">
                  <input id="year" name="year" class="input-large" size="4" type="number" value="<?php echo ($user_info['year']); ?>" required/>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="education">最高学历</label>
              <div class="controls">
                <select id="education" name="education" class="input-large"><option>本科</option> <option>硕士</option> <option>博士</option> <option>教职工</option> <option>其他</option></select>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="recommend_day">周推荐日</label>
              <div class="controls">
                 <select id="recommend_day" name="recommend_day" class="input-large">
                   <option value="0" <?php if(($user_info['recommend_day'] == 0)): ?>selected="selected"<?php endif; ?>>星期日</option>
                   <option value="1" <?php if(($user_info['recommend_day'] == 1)): ?>selected="selected"<?php endif; ?>>星期一</option>
                   <option value="2" <?php if(($user_info['recommend_day'] == 2)): ?>selected="selected"<?php endif; ?>>星期二</option>
                   <option value="3" <?php if(($user_info['recommend_day'] == 3)): ?>selected="selected"<?php endif; ?>>星期三</option>
                   <option value="4" <?php if(($user_info['recommend_day'] == 4)): ?>selected="selected"<?php endif; ?>>星期四</option>
                   <option value="5" <?php if(($user_info['recommend_day'] == 5)): ?>selected="selected"<?php endif; ?>>星期五</option>
                   <option value="6" <?php if(($user_info['recommend_day'] == 6)): ?>selected="selected"<?php endif; ?>>星期六</option></select>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="recommend_hour">推荐时间</label>
              <div class="controls">
                 <select id="recommend_hour" name="recommend_hour" class="input-large">
                   <?php $__FOR_START_14555__=0;$__FOR_END_14555__=24;for($i=$__FOR_START_14555__;$i < $__FOR_END_14555__;$i+=1){ if(($user_info['recommend_hour'] != $i) ): ?><option value="<?php echo ($i); ?>"><?php echo ($i); ?>:00</option>
                     <?php else: ?>
                       <option value="<?php echo ($user_info['recommend_hour']); ?>" selected="selected"><?php echo ($user_info['recommend_hour']); ?>:00</option><?php endif; } ?>
                 </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="singlebutton"></label>
              <div class="controls">
                 <button id="singlebutton" name="singlebutton" class="btn btn-success" type="submit">提交</button>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>