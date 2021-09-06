SELECT 
    pa.id,
    pa.titulo,
    pa.descricao,
    pa.status,
    pa.campanha_id
     FROM publico_alvo pa
        WHERE pa.titulo like '%' :titulo '%'