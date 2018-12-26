<?php

$this->FrontA = $this->Helpers->load('FrontA');// ヘルパー
$this->FrontA->init(array(
		'data'=>$data,
		'dp_tmpl'=>$dp_tmpl,
		'viaDpFnMap'=>$viaDpFnMap,
));

// CSSファイルのインクルード
$cssList = array(
		'bootstrap.min',
		'bootstrap-theme.min',
		'Buta/front_a'// 当画面専用CSS
);
$this->assign('css', $this->Html->css($cssList));

// JSファイルのインクルード
$jsList = array(
		'jquery-2.1.4.min',
		'bootstrap.min',
);
$this->assign('script', $this->Html->script($jsList,array('charset'=>'utf-8')));

?>
<h1><?php echo $title_for_layout; ?></h1>

<div style="margin-top:8px;margin-bottom:8px;">
	<?php 
	echo $this->FrontA->topLinkBtn($pages);
	echo $this->FrontA->prevLinkBtn($pages);
	echo $this->FrontA->nextLinkBtn($pages); 
	?>
	<div style="display:inline-block"><?php echo $pages['page_index_html']; ?></div>
	<div style="display:inline-block">件数:<?php echo $data_count ?></div>
</div>

<!-- 一覧テーブル -->
<table id="buta_tbl" border="1"  class="table_transform">

<thead>
<tr>
	<!-- CBBXS-1050 -->
	<th>id</th>
	<th>neko_val</th>
	<th>neko_name</th>
	<th>neko_date</th>
	<th>猫種別</th>
	<th>neko_dt</th>
	<th>ネコフラグ</th>
	<th>画像ファイル名</th>
	<th>備考</th>
	<th>順番</th>
	<th>無効フラグ</th>
	<th>更新者</th>
	<th>IPアドレス</th>
	<th>生成日時</th>
	<th>更新日</th>

	<!-- CBBXE -->
</tr>
</thead>
<tbody>
<?php

// td要素出力を列並モードに対応させる
$this->CrudBase->startClmSortMode($field_data);

foreach($data as $i=>$ent){

	echo "<tr id=i{$ent['id']}>";
	
	// CBBXS-1051
	$this->FrontA->tdPlain($ent,'id');
	$this->FrontA->tdPlain($ent,'neko_val');
	$this->FrontA->tdStr($ent,'neko_name');
	$this->FrontA->tdPlain($ent,'neko_date');
	$this->FrontA->tdPlain($ent,'neko_group');
	$this->FrontA->tdPlain($ent,'neko_dt');
	$this->FrontA->tdPlain($ent,'neko_flg');
	$this->FrontA->tdImage($ent,'img_fn','td_image');
	$this->FrontA->tdNote($ent,'note','td_note');
	$this->FrontA->tdPlain($ent,'sort_no');
	$this->FrontA->tdPlain($ent,'delete_flg');
	$this->FrontA->tdStr($ent,'update_user');
	$this->FrontA->tdStr($ent,'ip_addr');
	$this->FrontA->tdPlain($ent,'created');
	$this->FrontA->tdPlain($ent,'modified');

	// CBBXE
	
	echo "</tr>";
}

?>
</tbody>
</table>

<div style="margin-top:8px;margin-bottom:8px;">
	<?php 
	echo $this->FrontA->topLinkBtn($pages);
	echo $this->FrontA->prevLinkBtn($pages);
	echo $this->FrontA->nextLinkBtn($pages); 
	?>
	<div style="display:inline-block"><?php echo $pages['page_index_html']; ?></div>
	<div style="display:inline-block">件数:<?php echo $data_count ?></div>
</div>

























