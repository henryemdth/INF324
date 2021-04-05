select resultado.sigla, 
IFNULL(sum(CH)/sum(case when CH<>0 then 1 end),0) CH,
IFNULL(sum(LP)/sum(case when LP<>0 then 1 end),0) LP,
IFNULL(sum(CB)/sum(case when CB<>0 then 1 end),0) CB,
IFNULL(sum('OR')/sum(case when 'OR'<>0 then 1 end),0) 'OR',
IFNULL(sum(PT)/sum(case when PT<>0 then 1 end),0) PT,
IFNULL(sum(TJ)/sum(case when TJ<>0 then 1 end),0) TJ,
IFNULL(sum(SC)/sum(case when SC<>0 then 1 end),0) SC,
IFNULL(sum(BE)/sum(case when BE<>0 then 1 end),0) BE,
IFNULL(sum(PD)/sum(case when PD<>0 then 1 end),0) PD
FROM (SELECT sigla, 
    avg(case when departamento='01' then notafinal else 0 end) CH, 
	avg(case when departamento='02' then notafinal else 0 end) LP,
    avg(case when departamento='03' then notafinal else 0 end) CB,
    avg(case when departamento='04' then notafinal else 0 end) 'OR',
    avg(case when departamento='05' then notafinal else 0 end) PT,
    avg(case when departamento='06' then notafinal else 0 end) TJ,
    avg(case when departamento='07' then notafinal else 0 end) SC,
    avg(case when departamento='08' then notafinal else 0 end) BE,
    avg(case when departamento='09' then notafinal else 0 end) PD
	FROM nota,persona 
	WHERE nota.ci=persona.ci
	group by sigla,departamento) as resultado
group by resultado.sigla