SELECT COUNT(id_sub) AS nb_susc, FLOOR(Sum(price) / COUNT(price)) AS av_susc, (Sum(duration_sub) % 42) AS ft
FROM subscription;
