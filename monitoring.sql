
SHOW TABLES;

SELECT COUNT(*) FROM stream;

SELECT * FROM stream WHERE created > '2014-01-01' ORDER BY source_id DESC LIMIT 30\G;

SELECT * FROM stream ORDER BY created_time desc LIMIT 10\G;

SELECT COUNT(*) FROM stream;
EXIT
