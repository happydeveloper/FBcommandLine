while [ true ]
do
net_status=`netstat -t | wc -l`
dt=`date`
echo "${dt} : ${net_status}"

done
