
<?php 
	$cssList = ['bootstrap.min'];
	$this->assign('css', $this->Html->css($cssList));
	
	$jsList[] = [
			'jquery-2.1.4.min',
			'bootstrap.min',
			'WpPost/dist/one.js',
	];
	$this->assign('script', $this->Html->script($jsList,array('charset'=>'utf-8')));
	
	$wp_path = '/wp_demo/wordpress/';

?>
<style>
	.div1{
		display:inline-block;
		width:28%;margin:1%;padding:1%;
	}
	.div1 img{
		width:auto;
		height:auto;
		max-width:100%;
		max-height:100%;
	}
	.div2{
		display:inline-block;
		width:45%;margin:1%;padding:1%;
	}
</style>

<select  id="lang_list"></select>
<input type="button" value="翻訳" class="btn btn-success" onclick="translateExe()" />
<div id="err" class="text-danger"></div>

<p>翻訳</p>
<div id="res" style="border:solid 4px #dd5145"></div>
<div id="contents1">
	<div id='test1' class="div1" style="background-color:#b6e2ce">
		<?php 
			$post_id = 1;
			echo $data[$post_id]['post_content']; 
		?>
		<time><?php echo $data[$post_id]['post_date_gmt']; ?></time>
		<a href='<?php echo $wp_path; ?>wp-admin/post.php?post=<?php echo $post_id?>&action=edit' target="blank" class='btn btn-primary'>編集</a>
	</div>
	
	<div class="div1" style="background-color:#ebbec4">
		<?php 
			$post_id = 5;
			echo $data[$post_id]['post_content']; 
		?>
		<time><?php echo $data[$post_id]['post_date_gmt']; ?></time>
		<a href='<?php echo $wp_path; ?>wp-admin/post.php?post=<?php echo $post_id?>&action=edit' target="blank" class='btn btn-primary'>編集</a>
	</div>
	
	<div class="div1" style="background-color:#fff4d9">
		<?php 
			$post_id = 10;
			echo $data[$post_id]['post_content']; 
		?>
		<time><?php echo $data[$post_id]['post_date_gmt']; ?></time>
		<a href='<?php echo $wp_path; ?>wp-admin/post.php?post=<?php echo $post_id?>&action=edit' target="blank" class='btn btn-primary'>編集</a>
	</div>
	
	<div class="div2" style="background-color:#ebfaf1">
		<?php 
			$post_id = 17;
			echo $data[$post_id]['post_content']; 
		?>
		<time><?php echo $data[$post_id]['post_date_gmt']; ?></time>
		<a href='<?php echo $wp_path; ?>wp-admin/post.php?post=<?php echo $post_id?>&action=edit' target="blank" class='btn btn-primary'>編集</a>
	</div>
	
	<div class="div2" style="background-color:#e1e9ff">
		<?php 
			$post_id = 19;
			echo $data[$post_id]['post_content']; 
		?>
		<time><?php echo $data[$post_id]['post_date_gmt']; ?></time>
		<a href='<?php echo $wp_path; ?>wp-admin/post.php?post=<?php echo $post_id?>&action=edit' target="blank" class='btn btn-primary'>編集</a>
	</div>
</div>
<hr>