﻿#!/bin/sh
echo 'サーバーへtarファイルを送信する処理を開始'
cd ../../
echo '作業ディレクトリ'
pwd
scp wakg_rsv.tar.gz amaraimusi@amaraimusi.sakura.ne.jp:www
echo "------------ 送信完了"
cmd /k