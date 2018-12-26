<?php
App::uses('Model', 'Model');
App::uses('CrudBase', 'Model');

/**
 * WordPressのWpPostテーブルを取り扱うモデル
 *
 * @date 2018-12-11
 * @version 0.0.1
 *
 */
class WpPost extends AppModel {

	public $name='WpPost';
	
	// 関連付けるテーブル CBBXS-1040
	public $useTable = 'wp_posts';

	// CBBXE


	/// バリデーションはコントローラクラスで定義
	public $validate = null;
	

	public function __construct() {
		parent::__construct();
		
	}
	
	/**
	 * 投稿IDリストに紐づくWP投稿データを取得する
	 * @param array $idList 投稿IDリスト
	 * @return array WP投稿データ
	 */
	public function getDataByIdList($idList){
		if(empty($idList)) return array();
		$ids_str = "'".implode("','",$idList)."'";
		
		$conditions = array(
				"ID IN ({$ids_str})",
		);
		
		//DBからデータを取得
		$data = $this->find(
				'all',
				Array(
						'conditions' => $conditions,
						)
				);
		
		$data = Hash::combine($data, '{n}.WpPost.ID','{n}.WpPost');

		return $data;
	}
	
	/**
	 * WP投稿エンティティを取得
	 *
	 * WP投稿テーブルからidに紐づくエンティティを取得します。
	 *
	 * @param int $id WP投稿ID
	 * @return array WP投稿エンティティ
	 */
	public function findEntity($id){

		$conditions='ID = '.$id;

		//DBからデータを取得
		$data = $this->find(
				'first',
				Array(
						'conditions' => $conditions,
				)
		);

		$ent=array();
		if(!empty($data)){
			$ent=$data['WpPost'];
		}
		
		return $ent;
	}



}