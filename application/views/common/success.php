<title>错误页面</title>
<div style="color: green"><?php echo $message;?><br>
<?php foreach ($url as $k=>$v):?>
				<a href="<?php echo $k;?>"><?php echo $v;?></a>
			<?php endforeach; ?>
</div>