SELECT `distrib`.`name`
FROM `distrib`
WHERE`distrib`.`id_distrib` = 42
OR(`distrib`.`id_distrib` >= 62 AND `distrib`.`id_distrib` <= 69)
OR `distrib`.`id_distrib` = 71 OR `distrib`.`id_distrib` = 88 OR `distrib`.`id_distrib` = 89
OR `distrib`.`id_distrib` = 90 OR (CHAR_LENGTH(`distrib`.`name`) - CHAR_LENGTH(REPLACE(LOWER(`distrib`.`name`), 'y', '')) = 2)
LIMIT 2, 5;
