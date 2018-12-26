#!/bin/bash

echo "DBパスワードを入力してください"
mysqldump -Q -h mysql716.db.sakura.ne.jp -u amaraimusi -p amaraimusi_wakg_rsv --add-drop-table > www/wakg_rsv/shell/wakg_rsv.sql 2> www/wakg_rsv/shell/dump.error.txt

echo "出力完了"