SELECT 
    c.id,
    c.titulo,
    c.descricao,
    c.dataIni,
    c.dataFim
     FROM campanha c
        WHERE c.titulo like '%'  :titulo  '%'