#!/bin/sh


echo '作業ディレクトリ'
pwd

#echo "ローカルDBのパスワードを入力してください"
#read pw
pw="neko"

# wp_から始まるテーブル名一覧を取得し、テキストファイルに出力する。
mysql -uroot -p$pw wakg_rsv -N -e "show tables like 'wp_%'" > wp_table_names.txt

# テキストファイルを読み込む。その際、改行はスペースに変換する。 改行コードはWindowsなら\n\r、Linuxなら\nに書き換えるように。
tbls_text=`cat wp_table_names.txt | tr  '\n\r' ' '`
echo "$tbls_text"

echo 'SQLをエクスポートします。'
mysqldump -uroot -p$pw wakg_rsv $tbls_text --add-drop-table > wp_tbls.sql
echo 'エクスポートしました。'

echo 'SQLファイルをサーバーに転送します。'
scp wp_tbls.sql amaraimusi@amaraimusi.sakura.ne.jp:www/wakg_rsv/shell
echo '転送しました。'

echo 'serverフォルダ内のシェルを転送します。'
scp -r server amaraimusi@amaraimusi.sakura.ne.jp:www/wakg_rsv/shell/
echo '転送しました。'

echo 'サーバー側のシェルを実行します。'
ssh -l amaraimusi amaraimusi.sakura.ne.jp "
	sh www/wakg_rsv/shell/server/51_wp_import_tbls.sh;
	"

echo "サーバー側のシェルをすべて実行しました。"

echo "------------ 終わり"
cmd /k