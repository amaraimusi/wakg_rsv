#!/bin/sh

cd ../../
echo '作業ディレクトリ'
pwd
echo 'wakg_rsvを圧縮開始'
tar cvzf wakg_rsv.tar.gz wakg_rsv
echo 'wakg_rsv.tar.gzを作成'
echo "------------ 終わり"
cmd /k