<?php
App::uses('AppController', 'Controller');
// Composerによるベンダーライブラリを読み込む
require '../Vendor/Composer/vendor/autoload.php';
use Google\Cloud\Translate\TranslateClient;
/**
 * WP投稿のコントローラ
 */
class WpPostController extends AppController {
	
	public $uses = array('WpPost'); // 仕様モデルクラス
	public $components = null;//ログイン認証不要
	public $logout_flg = false;//ログアウトリンクを非表示	/// 使用しているモデル[CakePHPの機能]
	
	
	public function beforeFilter() {


		parent::beforeFilter();
		
	}

	public function demo1() {
		
		$data = $this->WpPost->getDataByIdList([1,5,10,17,19]);

		$this->set(array(
				'header' => 'front_a_header',
				'title_for_layout'=>'WPデモ1',
				'data'=> $data,
		));
		
		
	}
	
	/**
	 * Ajax | Google翻訳
	 * @return string JSON
	 */
	public function google_translation_ajax(){
		
		$this->autoRender = false;//ビュー(ctp)を使わない。

		if($_SERVER['SERVER_NAME'] != 'localhost' && date('U') > strtotime('2019-2-1')){
			echo '2019月2月1日にて公開停止';
			return;
		}
		
		$json_param = $_POST['key1'];
		$param = json_decode($json_param,true);//JSON文字を配列に戻す

		//Google APIの「プロジェクトID」
		$projectId = 'api-project-577997945594';
		
		//「Google Cloud Translation API」の「APIキー」
		$apiKey = 'AIzaSyBFdIWjLXlyGV8aDzTkg28BU_SbjjhbB6k';
		
		//「TranslateClient」クラスを呼び出し
		$translate = new TranslateClient([
				'projectId' => $projectId,
				'key' => $apiKey,
		]);
		
		$lang = $param['lang']; // 言語コードを指定
		
		
		//翻訳開始
		$result = $translate->translate($param['text1'], [
				'target' => $lang,
		]);
		$json = json_encode($result,JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
		
		return $json;
		
	}
	



}