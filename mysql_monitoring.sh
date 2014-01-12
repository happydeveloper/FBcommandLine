mysql -uroot -p1111 fb_archive <./monitoring.sql

i="0"

while [ $i -lt 10 ]
do 
mysql -uroot -p1111 <./connection_verify.sql
sleep 3
i=$[$i+1]
done
