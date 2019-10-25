SELECT ABS(DATEDIFF(MAX(`member_history`.`date`), MIN(`member_history`.`date`))) AS 'uptime'
FROM `member_history`;
