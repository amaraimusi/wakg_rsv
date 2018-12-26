#!/bin/sh

echo 'サーバー先でwakg_rsv_rsc.tar.gzを解凍します。'
ssh -l amaraimusi amaraimusi.sakura.ne.jp "
	cd www/wakg_rsv/app/webroot;
	pwd;
	tar vxzf wakg_rsv_rsc.tar.gz;
	exit;
	"

echo "------------ 解凍完了"
cmd /k