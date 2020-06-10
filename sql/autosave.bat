rem *******************************Code Start*****************************
@echo off

set "Ymd=%date:~,4%%date:~5,2%%date:~8,2%"
D:\xampp\mysql\bin\mysqldump --opt -u root --password=aKw92vwX5bpfyNMe project > D:\OneDrive\web\project\project_%Ymd%.sql
@echo on
rem *******************************Code End*****************************
