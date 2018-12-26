<?php
$this->CrudBase->init(array('model_name'=>'Neko'));

// CSSファイルのインクルード
$cssList = $this->CrudBase->getCssList();
$cssList[] = 'Neko/index'; // 当画面専用CSS
$this->assign('css', $this->Html->css($cssList));

// JSファイルのインクルード
$jsList = $this->CrudBase->getJsList();
$jsList[] = 'Neko/index'; // 当画面専用JavaScript
$this->assign('script', $this->Html->script($jsList,array('charset'=>'utf-8')));

?>






<div class="cb_func_line">


	<div class="cb_breadcrumbs">
	<?php
		$this->Html->addCrumb("トップ",'/');
		$this->Html->addCrumb("ネコ画面");
		echo $this->Html->getCrumbs(" > ");
	?>
	</div>
	
	<div class="cb_kj_main">
		<!-- 検索条件入力フォーム -->
		<?php echo $this->Form->create('Neko', array('url' => true , 'class' => 'form_kjs')); ?>
		<?php $this->CrudBase->inputKjMain($kjs,'kj_main','',null,'ネコ名前、ネコ日、備考を検索する');?>
		<input type='button' value='検索' onclick='searchKjs()' class='search_kjs_btn btn btn-success' />
		<div class="btn-group">
			<a href="" class="ini_rtn btn btn-info btn-xs" title="この画面を最初に表示したときの状態に戻します。（検索状態、列並べの状態を初期状態に戻します。）">
				<span class="glyphicon glyphicon-certificate"  ></span></a>
			<button type="button" class="btn btn-default btn-xs" title="詳細検索項目を表示する" onclick="jQuery('.cb_kj_detail').toggle(300)">詳細</button>
		</div>
		
		<div class="cb_kj_detail" style="display:none">
		<?php 
		
		// --- CBBXS-1004
		$this->CrudBase->inputKjText($kjs,'kj_neko_name','ネコ名前');
		$this->CrudBase->inputKjMoDateRng($kjs,'kj_neko_date','ネコ日付');
		$this->CrudBase->inputKjNouislider($kjs,'neko_val','ネコ数値'); 
		$this->CrudBase->inputKjSelect($kjs,'kj_neko_group','ネコ種別',$nekoGroupList); 
		//$this->CrudBase->inputKjDateTime($kjs,'kj_neko_dt','ネコ日時',150);
		$this->CrudBase->inputKjText($kjs,'kj_neko_dt','ネコ日時',150); 
		$this->CrudBase->inputKjFlg($kjs,'kj_neko_flg','ネコフラグ');
		$this->CrudBase->inputKjText($kjs,'kj_img_fn','ネコ名前',200);
		$this->CrudBase->inputKjText($kjs,'kj_note','備考',200,'部分一致検索'); 
		$this->CrudBase->inputKjId($kjs); 
		$this->CrudBase->inputKjHidden($kjs,'kj_sort_no');
		$this->CrudBase->inputKjDeleteFlg($kjs);
		$this->CrudBase->inputKjText($kjs,'kj_update_user','更新者',150);
		$this->CrudBase->inputKjText($kjs,'kj_ip_addr','更新IPアドレス',200);
		$this->CrudBase->inputKjCreated($kjs);
		$this->CrudBase->inputKjModified($kjs);
		// --- CBBXE
		
		$this->CrudBase->inputKjLimit($kjs);
		echo "<input type='button' value='検索' onclick='searchKjs()' class='search_kjs_btn btn btn-success' />";
		echo $this->element('CrudBase/crud_base_cmn_inp');
		

		?>
			<div class="kj_div" style="margin-top:5px">
				<input type="button" value="リセット" title="検索入力を初期に戻します" onclick="resetKjs()" class="btn btn-primary btn-xs" />
			</div>
		</div>
		<?php echo $this->Form->end()?>
	</div>
	
	<div id="cb_func_btns" class="btn-group" >
		<button type="button" onclick="$('#detail_div').toggle(300);" class="btn btn-default">
			<span class="glyphicon glyphicon-cog"></span></button>

		<button id="table_transform_tbl_mode" type="button" class="btn btn-default" onclick="tableTransform(0)" style="display:none">
			<span class="glyphicon glyphicon-th" title="一覧の変形・テーブルモード"></span></button>
			
		<button id="table_transform_div_mode" type="button" class="btn btn-default" onclick="tableTransform(1)" >
			<span class="glyphicon glyphicon-th-large" title="一覧の変形・区分モード"></span></button>
			
		<button id="calendar_view_k_btn" type="button" class="btn btn-default" onclick="calendarViewKShow()" >
			<span class="glyphicon glyphicon-time" title="カレンダーモード"></span></button>
		
	</div>
		
	<a href="neko/front_a?<?php echo $pages['query_str']; ?>" class="btn btn-info btn-xs" target="brank" >フロント画面</a>
	
</div><!-- cb_func_line -->

<div style="clear:both"></div>


<?php echo $this->element('CrudBase/crud_base_new_page_version');?>
<div id="err" class="text-danger"><?php echo $errMsg;?></div>


<div style="clear:both"></div>

<div id="detail_div" style="display:none">
	
<?php 
	echo $this->element('CrudBase/crud_base_index');
	
	$csv_dl_url = $this->html->webroot . 'neko/csv_download';
	$this->CrudBase->makeCsvBtns($csv_dl_url);
?>

</div><!-- detail_div -->

<div id="new_inp_form_point"></div><!-- 新規入力フォーム表示地点 -->


<div style="margin-top:8px;">
	<div style="display:inline-block">
		<?php echo $pages['page_index_html'];//ページ目次 ?>
	</div>
	<div style="display:inline-block">件数:<?php echo $data_count ?></div>
</div>

<div id="calendar_view_k"></div>
<div id="hyo2">
	<div>
		<input type='text' name='id'  value='85' placeholder='id' style='width:80px'/>
		<input type='text' name='neko_val'  value='' placeholder='neko_val' style='width:80px'/>
		<input type='text' name='neko_name'  value='' placeholder='neko_name' style='width:80px'/>
		<input type='text' name='neko_date'  value='' placeholder='neko_date' style='width:80px'/>
		<input type='text' name='neko_group'  value='' placeholder='neko_group' style='width:80px'/>
		<input type='text' name='neko_dt'  value='' placeholder='neko_dt' style='width:80px'/>
		<input type='text' name='neko_flg'  value='' placeholder='neko_flg' style='width:80px'/>
		<input type='text' name='img_fn'  value='' placeholder='img_fn' style='width:80px'/>
		<input type='text' name='note'  value='' placeholder='note' style='width:80px'/>
		<input type='text' name='sort_no'  value='' placeholder='sort_no' style='width:80px'/>
		<input type='text' name='delete_flg'  value='' placeholder='delete_flg' style='width:80px'/>
		<input type='text' name='update_user'  value='' placeholder='update_user' style='width:80px'/>
		<input type='text' name='ip_addr'  value='' placeholder='ip_addr' style='width:80px'/>
		<input type='text' name='created'  value='' placeholder='created' style='width:80px'/>
		<input type='text' name='modified'  value='' placeholder='modified' style='width:80px'/>
	</div>
	<div>
		<input type='text' name='id'  value='89' placeholder='id' style='width:80px'/>
		<input type='text' name='neko_val'  value='' placeholder='neko_val' style='width:80px'/>
		<input type='text' class='neko_name'  value='' placeholder='neko_name' style='width:80px'/>
		<input type='text' name='neko_date'  value='' placeholder='neko_date' style='width:80px'/>
		<input type='text' name='neko_group'  value='' placeholder='neko_group' style='width:80px'/>
		<input type='text' name='neko_dt'  value='' placeholder='neko_dt' style='width:80px'/>
		<input type='text' name='neko_flg'  value='' placeholder='neko_flg' style='width:80px'/>
		<input type='text' name='img_fn'  value='' placeholder='img_fn' style='width:80px'/>
		<input type='text' name='note'  value='' placeholder='note' style='width:80px'/>
		<input type='text' name='sort_no'  value='' placeholder='sort_no' style='width:80px'/>
		<input type='text' name='delete_flg'  value='' placeholder='delete_flg' style='width:80px'/>
		<input type='text' name='update_user'  value='' placeholder='update_user' style='width:80px'/>
		<input type='text' name='ip_addr'  value='' placeholder='ip_addr' style='width:80px'/>
		<input type='text' name='created'  value='' placeholder='created' style='width:80px'/>
		<input type='text' name='modified'  value='' placeholder='modified' style='width:80px'/>
	</div>
</div>

<div id="crud_base_auto_save_msg" style="height:20px;" class="text-success"></div>

<button type="button" class="btn btn-warning btn-sm" onclick="newInpShow(this, 'add_to_top');">
	<span class="glyphicon glyphicon-plus-sign" title="新規入力"> 追加</span></button>
	
<!-- 一覧テーブル -->
<table id="neko_tbl" border="1"  class="table table-striped table-bordered table-condensed" style="display:none;margin-bottom:0px">

<thead>
<tr>
	<?php
	foreach($field_data as $ent){
		$row_order=$ent['row_order'];
		echo "<th class='{$ent['id']}'>{$pages['sorts'][$row_order]}</th>";
	}
	?>
	<th></th>
</tr>
</thead>
<tbody>
<?php

// td要素出力を列並モードに対応させる
$this->CrudBase->startClmSortMode($field_data);

foreach($data as $i=>$ent){

	echo "<tr id=i{$ent['id']}>";
	// CBBXS-1005
	$this->CrudBase->tdId($ent,'id',array('checkbox_name'=>'pwms'));
	$this->CrudBase->tdMoney($ent,'neko_val');
	$this->CrudBase->tdStr($ent,'neko_name');
	$this->CrudBase->tdList($ent,'neko_group',$nekoGroupList);
	$this->CrudBase->tdPlain($ent,'neko_date');
	$this->CrudBase->tdPlain($ent,'neko_dt');
	$this->CrudBase->tdFlg($ent,'neko_flg');
	$this->CrudBase->tdImage($ent,'img_fn');
	$this->CrudBase->tdNote($ent,'note',50);
	$this->CrudBase->tdPlain($ent,'sort_no');
	$this->CrudBase->tdDeleteFlg($ent,'delete_flg');
	$this->CrudBase->tdPlain($ent,'update_user');
	$this->CrudBase->tdPlain($ent,'ip_addr');
	$this->CrudBase->tdPlain($ent,'created');
	$this->CrudBase->tdPlain($ent,'modified');
	// CBBXE
	
	$this->CrudBase->tdsEchoForClmSort();// 列並に合わせてTD要素群を出力する
	
	// 行のボタン類
	echo "<td><div style='display:inline-block'>";
	$id = $ent['id'];
	echo  "<input type='button' value='↑↓' onclick='rowExchangeShowForm(this)' class='row_exc_btn btn btn-info btn-xs' />";
	$this->CrudBase->rowEditBtn($id);
	$this->CrudBase->rowPreviewBtn($id);
	$this->CrudBase->rowCopyBtn($id);
	echo "</div>&nbsp;";
	echo "<div style='display:inline-block'>";
	$this->CrudBase->rowDeleteBtn($ent); // 削除ボタン
	$this->CrudBase->rowEnabledBtn($ent); // 有効ボタン
	echo "&nbsp;";
	$this->CrudBase->rowEliminateBtn($ent);// 抹消ボタン
	echo "</div>";
	echo "</td>";
	echo "</tr>";
}

?>
</tbody>
</table>

<button type="button" class="btn btn-warning btn-sm" onclick="newInpShow(this, 'add_to_bottom');">
	<span class="glyphicon glyphicon-plus-sign" title="新規入力"> 追加</span></button>
	
<?php echo $this->element('CrudBase/crud_base_pwms'); // 複数選択による一括処理 ?>

<table id="crud_base_forms">

	<!-- 新規入力フォーム -->
	<tr id="ajax_crud_new_inp_form" class="crud_base_form" style="display:none;padding-bottom:60px"><td colspan='5'>
	
		<div>
			<div style="color:#3174af;float:left">新規入力</div>
			<div style="float:left;margin-left:10px">
				<button type="button"  onclick="newInpReg();" class="btn btn-success btn-xs reg_btn">
					<span class="glyphicon glyphicon-ok reg_btn_msg"></span>
				</button>
			</div>
			<div style="float:right">
				<button type="button" class="btn btn-primary btn-xs" onclick="closeForm('new_inp')"><span class="glyphicon glyphicon-remove"></span></button>
			</div>
		</div>
		<div style="clear:both;height:4px"></div>
		<div class="err text-danger"></div>
		
		<div style="display:none">
	    	<input type="hidden" name="form_type">
	    	<input type="hidden" name="row_index">
	    	<input type="hidden" name="sort_no">
		</div>
	
	
		<!-- CBBXS-1006 -->
		
		<div class="cbf_inp_wrap">
			<div class='cbf_inp_label_long' >画像ファイル名: </div>
			<div class='cbf_input'>
				<label for="img_fn_n" class="fuk_label" style="width:100px;height:100px;">
					<input type="file" id="img_fn_n" class="img_fn" style="display:none" accept="image/*" title="画像ファイルをドラッグ＆ドロップ(複数可)" />
				</label>
			</div>
		</div>
	
		<div class="cbf_inp_wrap">
			<div class='cbf_inp' >ネコ名: </div>
			<div class='cbf_input'>
				<input type="text" name="neko_name" class="valid " value=""  maxlength="255" title="255文字以内で入力してください" />
				<label class="text-danger" for="neko_name"></label>
			</div>
		</div>
	
		<div class="cbf_inp_wrap">
			<div class='cbf_inp_label' >ネコ数値: </div>
			<div class='cbf_input'>
				<input type="text" name="neko_val" class="valid" value="" pattern="^[0-9]+$" maxlength="11" title="数値を入力してください" />
				<label class="text-danger" for="neko_val" ></label>
			</div>
		</div>
		
		<div class="cbf_inp_wrap">
			<div class='cbf_inp_label' >ネコ日付: </div>
			<div class='cbf_input'>
				<input type="text" name="neko_date" class="valid datepicker" value=""  pattern="([0-9]{4})(\/|-)([0-9]{1,2})(\/|-)([0-9]{1,2})" title="日付形式（Y-m-d）で入力してください(例：2012-12-12)" />
				<label class="text-danger" for="neko_date"></label>
			</div>
		</div>
		
		<div class="cbf_inp_wrap">
			<div class='cbf_inp_label' >ネコ種別: </div>
			<div class='cbf_input'>
				<?php $this->CrudBase->selectX('neko_group',null,$nekoGroupList,null);?>
				<label class="text-danger" for="neko_group"></label>
			</div>
		</div>
	
		<div class="cbf_inp_wrap">
			<div class='cbf_inp_label' >ネコ日時: </div>
			<div class='cbf_input'>
				<input type="text" name="neko_dt" class="valid " value=""  pattern="([0-9]{4})(\/|-)([0-9]{1,2})(\/|-)([0-9]{1,2}) \d{2}:\d{2}:\d{2}" title="日時形式（Y-m-d H:i:s）で入力してください(例：2012-12-12 12:12:12)" />
				<label class="text-danger" for="neko_dt"></label>
			</div>
		</div>
		
		<div class="cbf_inp_wrap">
			<div class='cbf_inp_label' >ネコフラグ: </div>
			<div class='cbf_input'>
				<input type="checkbox" name="neko_flg" class="valid"/>
				<label class="text-danger" for="neko_flg" ></label>
			</div>
		</div>
		
		<div class="cbf_inp_wrap_long">
			<div class='cbf_inp_label' >備考： </div>
			<div class='cbf_input'>
				<textarea name="note" maxlength="1000" title="1000文字以内で入力してください" style="height:100px;width:100%"></textarea>
				<label class="text-danger" for="note"></label>
			</div>
		</div>
		<!-- CBBXE -->
		
		<div style="clear:both"></div>
		<div class="cbf_inp_wrap">
			<button type="button" onclick="newInpReg();" class="btn btn-success reg_btn">
				<span class="glyphicon glyphicon-ok reg_btn_msg"></span>
			</button>
		</div>
	</td></tr><!-- new_inp_form -->



	<!-- 編集フォーム -->
	<tr id="ajax_crud_edit_form" class="crud_base_form" style="display:none"><td colspan='5'>
		<div  style='width:100%'>
	
			<div>
				<div style="color:#3174af;float:left">編集</div>
				<div style="float:left;margin-left:10px">
					<button type="button"  onclick="editReg();" class="btn btn-success btn-xs reg_btn">
						<span class="glyphicon glyphicon-ok reg_btn_msg"></span>
					</button>
				</div>
				<div style="float:right">
					<button type="button" class="btn btn-primary btn-xs" onclick="closeForm('edit')"><span class="glyphicon glyphicon-remove"></span></button>
				</div>
			</div>
			<div style="clear:both;height:4px"></div>
			<div class="err text-danger"></div>
			
			<!-- CBBXS-1007 -->
			
			<div style="display:none">
				<input type="hidden" name="sort_no">
			</div>
			
			<div class="cbf_inp_wrap">
				<div class='cbf_inp' >ID: </div>
				<div class='cbf_input'>
					<span class="id"></span>
				</div>
			</div>
			
			<div class="cbf_inp_wrap_long">
				<div class='cbf_inp' >ネコ名: </div>
				<div class='cbf_input'>
					<input type="text" name="neko_name" class="valid " value=""  maxlength="255" title="255文字以内で入力してください" />
					<label class="text-danger" for="neko_name"></label>
				</div>
			</div>
			
			<div class="cbf_inp_wrap">
				<div class='cbf_inp_label_long' >画像ファイル名: </div>
				<div class='cbf_input'>
					<label for="img_fn_e" class="fuk_label" style="width:100px;height:100px;">
						<input type="file" id="img_fn_e" class="img_fn" style="display:none" accept="image/*" title="画像ファイルをドラッグ＆ドロップ(複数可)" />
					</label>
				</div>
			</div>
		
		
			<div class="cbf_inp_wrap">
				<div class='cbf_inp_label' >ネコ数値: </div>
				<div class='cbf_input'>
					<input type="text" name="neko_val" class="valid" value="" pattern="^[0-9]+$" maxlength="11" title="数値を入力してください" />
					<label class="text-danger" for="neko_val" ></label>
				</div>
			</div>
			
			<div class="cbf_inp_wrap">
				<div class='cbf_inp_label' >ネコ日付: </div>
				<div class='cbf_input'>
					<input type="text" name="neko_date" class="valid datepicker" value=""  pattern="([0-9]{4})(\/|-)([0-9]{1,2})(\/|-)([0-9]{1,2})" title="日付形式（Y-m-d）で入力してください(例：2012-12-12)" />
					<label class="text-danger" for="neko_date"></label>
				</div>
			</div>
			
			<div class="cbf_inp_wrap">
				<div class='cbf_inp_label' >ネコ種別: </div>
				<div class='cbf_input'>
					<?php $this->CrudBase->selectX('neko_group',null,$nekoGroupList,null);?>
					<label class="text-danger" for="neko_group"></label>
				</div>
			</div>

			<div class="cbf_inp_wrap">
				<div class='cbf_inp_label' >ネコ日時: </div>
				<div class='cbf_input'>
					<input type="text" name="neko_dt" class="valid " value=""  pattern="([0-9]{4})(\/|-)([0-9]{1,2})(\/|-)([0-9]{1,2}) \d{2}:\d{2}:\d{2}" title="日時形式（Y-m-d H:i:s）で入力してください(例：2012-12-12 12:12:12)" />
					<label class="text-danger" for="neko_dt"></label>
				</div>
			</div>
			
			<div class="cbf_inp_wrap">
				<div class='cbf_inp_label' >ネコフラグ: </div>
				<div class='cbf_input'>
					<input type="checkbox" name="neko_flg" class="valid"/>
					<label class="text-danger" for="neko_flg" ></label>
				</div>
			</div>
			
			<div class="cbf_inp_wrap">
				<div class='cbf_inp_label' >削除：</div>
				<div class='cbf_input'>
					<input type="checkbox" name="delete_flg" class="valid"  />
				</div>
			</div>
			
			<div class="cbf_inp_wrap_long">
				<div class='cbf_inp_label' >備考： </div>
				<div class='cbf_input'>
					<textarea name="note" maxlength="1000" title="1000文字以内で入力してください" style="height:100px;width:100%"></textarea>
					<label class="text-danger" for="note"></label>
				</div>
			</div>
			
			<!-- CBBXE -->
			
			<div style="clear:both"></div>
			<div class="cbf_inp_wrap">
				<button type="button"  onclick="editReg();" class="btn btn-success reg_btn">
					<span class="glyphicon glyphicon-ok reg_btn_msg"></span>
				</button>
			</div>
			
			<div class="cbf_inp_wrap" style="padding:5px;">
				<input type="button" value="更新情報" class="btn btn-default btn-xs" onclick="$('#ajax_crud_edit_form_update').toggle(300)" /><br>
				<aside id="ajax_crud_edit_form_update" style="display:none">
					更新日時: <span class="modified"></span><br>
					生成日時: <span class="created"></span><br>
					ユーザー名: <span class="update_user"></span><br>
					IPアドレス: <span class="ip_addr"></span><br>
					ユーザーエージェント: <span class="user_agent"></span><br>
				</aside>
			</div>
		</div>
	</td></tr>
</table>







<!-- 削除フォーム -->
<div id="ajax_crud_delete_form" class="panel panel-danger" style="display:none">

	<div class="panel-heading">
		<div class="pnl_head1">削除</div>
		<div class="pnl_head2"></div>
		<div class="pnl_head3">
			<button type="button" class="btn btn-default btn-sm" onclick="closeForm('delete')"><span class="glyphicon glyphicon-remove"></span></button>
		</div>
	</div>
	
	<div class="panel-body" style="min-width:300px">
	<table><tbody>

		<!-- Start ajax_form_new -->
		<tr><td>ID: </td><td>
			<span class="id"></span>
		</td></tr>
		

		<tr><td>ネコ名: </td><td>
			<span class="neko_name"></span>
		</td></tr>
		
		<tr><td>画像ファイル: </td><td>
			<label for="img_fn"></label><br>
			<img src="" class="img_fn" width="80" height="80" ></img>
		</td></tr>


		<!-- Start ajax_form_end -->
	</tbody></table>
	<br>
	

	<button type="button"  onclick="deleteReg();" class="btn btn-danger">
		<span class="glyphicon glyphicon-remove"></span>　削除する
	</button>
	<hr>
	
	<input type="button" value="更新情報" class="btn btn-default btn-xs" onclick="$('#ajax_crud_delete_form_update').toggle(300)" /><br>
	<aside id="ajax_crud_delete_form_update" style="display:none">
		更新日時: <span class="modified"></span><br>
		生成日時: <span class="created"></span><br>
		ユーザー名: <span class="update_user"></span><br>
		IPアドレス: <span class="ip_addr"></span><br>
		ユーザーエージェント: <span class="user_agent"></span><br>
	</aside>
	

	</div><!-- panel-body -->
</div>



<!-- 抹消フォーム -->
<div id="ajax_crud_eliminate_form" class="panel panel-danger" style="display:none">

	<div class="panel-heading">
		<div class="pnl_head1">抹消</div>
		<div class="pnl_head2"></div>
		<div class="pnl_head3">
			<button type="button" class="btn btn-default btn-sm" onclick="closeForm('eliminate')"><span class="glyphicon glyphicon-remove"></span></button>
		</div>
	</div>
	
	<div class="panel-body" style="min-width:300px">
	<table><tbody>

		<!-- Start ajax_form_new -->
		<tr><td>ID: </td><td>
			<span class="id"></span>
		</td></tr>
		

		<tr><td>ネコ名: </td><td>
			<span class="neko_name"></span>
		</td></tr>


		<!-- Start ajax_form_end -->
	</tbody></table>
	<br>
	

	<button type="button"  onclick="eliminateReg();" class="btn btn-danger">
		<span class="glyphicon glyphicon-remove"></span>　抹消する
	</button>
	<hr>
	
	<input type="button" value="更新情報" class="btn btn-default btn-xs" onclick="$('#ajax_crud_eliminate_form_update').toggle(300)" /><br>
	<aside id="ajax_crud_eliminate_form_update" style="display:none">
		更新日時: <span class="modified"></span><br>
		生成日時: <span class="created"></span><br>
		ユーザー名: <span class="update_user"></span><br>
		IPアドレス: <span class="ip_addr"></span><br>
		ユーザーエージェント: <span class="user_agent"></span><br>
	</aside>
	

	</div><!-- panel-body -->
</div>


<br />

<!-- 埋め込みJSON -->
<div style="display:none">
	
	<!-- CBBXS-1022 -->
	<input id="neko_group_json" type="hidden" value='<?php echo $neko_group_json; ?>' />
	<!-- CBBXE -->
</div>



<!-- ヘルプ用  -->
<input type="button" class="btn btn-info btn-sm" onclick="$('#help_x').toggle()" value="ヘルプ" />
<div id="help_x" class="help_x" style="display:none">
	<h2>ヘルプ</h2>

	<?php echo $this->element('CrudBase/crud_base_help');?>

</div>























