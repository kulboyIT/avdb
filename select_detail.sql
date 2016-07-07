SELECT amov.`code`,amov.`title`,amov.`have`,amov.`actress`,avideo.`store`,picture.`picdata` 
FROM amov,picture,avideo 
WHERE amov.`code` = picture.`code` AND amov.`code` = avideo.`code` AND amov.`code` = 'STAR-284'