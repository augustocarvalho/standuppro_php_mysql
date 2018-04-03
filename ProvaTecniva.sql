ATUALIZAR cod_cbsup

UPDATE atleta SET cod_cbsup = (SELECT distinct numero FROM inscricao WHERE etapa_idetapa = 5 AND inscricao.atleta_cpf = atleta.cpf)

SELECT nome, cod_cbsup FROM atleta;

CONFERENCIA DE cod_cbsup PREENCHIDO
SELECT  a.cod_cbsup, a.cpf, i.numero, a.nome, c.idcategoria, c.descricao
FROM inscricao i
JOIN atleta a ON i.atleta_cpf = a.cpf 
JOIN categoria c ON c.idcategoria = i.categoria_idcategoria
WHERE etapa_idetapa = 5 
--AND (a.cod_cbsup <> i.numero or a.cod_cbsup is null)
--AND i.categoria_idcategoria not in (19,20, 33, 39, 21)
--and not EXISTS (SELECT  1 FROM inscricao i2 WHERE i2.etapa_idetapa = 5 and a.cpf = i2.atleta_cpf and a.cod_cbsup = i2.numero)


----- Ordenar 
--- POR CATEGORIA

SET @ponto_1 = 0;
SET @ponto_2 = 0;
SET @rank = 0;
SET @cat = 13;

SELECT 
 a.race_l + b.race_t as total
, a.race_l 
, b.race_t
, a.nome 
, a.numero as numero_prova
, a.cod_cbsup
, a.descricao
FROM
(SELECT
@ponto_1 := @ponto_1+1 as race_l
, i.numero
, p.nome
, p.cod_cbsup
, p.estado
, i.tempo
, c.descricao  
FROM inscricao i join atleta p join categoria c 
WHERE i.etapa_idetapa = 4 and i.atleta_cpf = p.cpf 
and i.tempo <> '00:00:00' 
and i.categoria_idcategoria = c.idcategoria 
AND c.idcategoria = @cat
order by i.tempo) a 
JOIN 
(
SELECT
@ponto_2 := @ponto_2 + 1 as race_t
, i.numero
, p.nome
, p.cod_cbsup
, p.estado
, i.tempo_2
, c.descricao  
FROM inscricao i join atleta p join categoria c 
WHERE i.etapa_idetapa = 4 and i.atleta_cpf = p.cpf 
and (i.tempo_2 <> '00:00:00' or i.tempo_2 is not null)
and i.categoria_idcategoria = c.idcategoria 
AND c.idcategoria = @cat
order by i.tempo_2) b
ON b.numero = a.numero
order by 1




<<<<<<< HEAD
DADOS DA INSCRICAO POR CATEGORIA
SELECT i.podio_longa, i.tempo, i.podio_tecnica, i.tempo_t , i.numero, a.nome, a.estado, c.descricao 
FROM inscricao i 
JOIN atleta a ON i.atleta_cpf = a.cpf
JOIN categoria c ON c.idcategoria = i.categoria_idcategoria
WHERE i.etapa_idetapa = 5 
AND i.podio_longa <> 0
and i.categoria_idcategoria = 1
ORDER by 1


=======
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
