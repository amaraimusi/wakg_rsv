#!/bin/sh
echo 'sqlファイルをサーバーに送信します。'

scp wakg_rsv.sql amaraimusi@amaraimusi.sakura.ne.jp:www/wakg_rsv/shell
echo "------------ 送信完了"
cmd /k