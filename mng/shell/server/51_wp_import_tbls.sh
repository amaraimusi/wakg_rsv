#!/bin/bash

echo 'さくらスタンダードのコントロールパネルで先にデータベースを作成してくだい'
echo "DBパスワードを入力してください"
read pw

mysql -h mysql716.db.sakura.ne.jp -u amaraimusi -p$pw -B amaraimusi_wakg_rsv < www/wakg_rsv/shell/wp_tbls.sql
echo "出力完了"