#!/bin/sh


echo '作業ディレクトリ'
pwd

#echo "ローカルDBのパスワードを入力してください"
#read pw
pw="neko"



echo 'SQLをエクスポートします。'
#mysqldump -uroot -p$pw wakg_rsv yagis --add-drop-table > yagis$xxx.sql

#date1=`date +"%Y%m%d"`
#mysql -uroot -p$pw wakg_rsv -N -e "show tables" > test$date1.txt

#tbls_text=`cat test.txt`
#echo "$tbls_text"

tbls_text=`cat wp_table_names.txt | tr  '\n\r' ' '`
echo "$tbls_text"


echo "------------ 終わり"
cmd /k