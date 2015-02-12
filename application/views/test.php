<h1><?php echo $hello?></h1><br>
<form action="<?php echo siteUrl('home/index')?>" method="post" enctype="multipart/form-data">
姓名：<input name="name" type="text"><br>
图片：<input name="pic" type="file"><br>
留言：<textarea name="content" ></textarea><br>
<input type="submit" value="留言">
</form>
<br>
<div>
<ul>
<?php foreach ($list as $v):?>
<td>姓名：<?php echo $v['name'];?></td><br>
<td>留言：<?php echo $v['content'];?></td><br>
<td>头像：<img src="/<?php echo $v['pic'];?>"></td><br>
<h4>=================</h4>
<?php endforeach;?>
</ul>