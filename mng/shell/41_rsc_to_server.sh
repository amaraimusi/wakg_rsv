#!/bin/sh
echo 'sqlファイルをサーバーに送信します。'

cd ../app/webroot
echo '作業ディレクトリ'
pwd
scp wakg_rsv_rsc.tar.gz amaraimusi@amaraimusi.sakura.ne.jp:www/wakg_rsv/app/webroot
echo "wakg_rsv_rsc.tar.gzの送信完了"


cmd /k