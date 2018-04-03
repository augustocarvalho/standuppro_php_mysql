SQL IMPORTANTES

-- Quantidade de inscritos 
select count(distinct(atleta_cpf)) from inscricao
where etapa_idetapa = 1


-- Quantidade de inscritos por categoria
SELECT count(*), c.descricao as NOME  FROM inscricao i join atleta p join categoria c
WHERE etapa_idetapa = 1 and i.atleta_cpf = p.cpf and i.categoria_idcategoria = c.idcategoria group by c.descricao


-- Geral de inscritos por categoria
SELECT p.nome, c.descricao as categoria  FROM inscricao i join atleta p join categoria c
WHERE etapa_idetapa = 1 and i.atleta_cpf = p.cpf and i.categoria_idcategoria = c.idcategoria order by c.descricao

