#!/bin/sh

echo '作業ディレクトリ'
pwd

echo "ローカルDBのパスワードを入力してください"
read pw

echo 'SQLをエクスポートします。'
mysqldump -uroot -p$pw wakg_rsv > wakg_rsv.sql
echo 'エクスポートしました。'

echo 'SQLファイルをサーバーに転送します。'
scp wakg_rsv.sql amaraimusi@amaraimusi.sakura.ne.jp:www/wakg_rsv/shell
echo '転送しました。'

echo "------------ 終わり"
cmd /k