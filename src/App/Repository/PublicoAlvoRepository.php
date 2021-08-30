<?php

declare(strict_types=1);

namespace App\Repository;

use Exception;
use App\Util\Enum\StatusHttp;
use App\Util\Enum\ErrorMessage;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use App\Util\ReadArchive\ReadArchiveSQL;
use App\Exception\SQLFileNotFoundException;
use App\Exception\PublicoAlvoDatabaseException;
use App\Entity\PublicoAlvo;

class PublicoAlvoRepository extends EntityRepository
{
    /**
     * @var ResultSetMapping
     */
    private $resultSetMapping;

    /**
     * @var ReadArchiveSQL
     */
    private $readSQL;

    private function setInstance(): void
    {
        $this->resultSetMapping = new ResultSetMapping();
        $this->readSQL = new ReadArchiveSQL();
    }

    /**
     * @param PublicoAlvo $publicoAlvo
     * @return PublicoAlvo
     * @throws PublicoAlvoDatabaseException
     */
    public function insertPublicoAlvo(PublicoAlvo $publicoAlvo): PublicoAlvo
    {
        try {
            $this->getEntityManager()->persist($publicoAlvo);
            $this->getEntityManager()->flush();
            return $publicoAlvo;
        } catch (Exception $e) {
            throw new PublicoAlvoDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_INSERTING_RECORD,
                $e->getMessage()
            );
        }
    }

    /**
     * @param PublicoAlvo $publicoAlvo
     * @return PublicoAlvo
     * @throws PublicoAlvoDatabaseException
     */
    public function updatePublicoAlvo(PublicoAlvo $publicoAlvo): PublicoAlvo
    {
        try {
            $this->getEntityManager()->merge($publicoAlvo);
            $this->getEntityManager()->flush();
            return $publicoAlvo;
        } catch (Exception $e) {
            throw new PublicoAlvoDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_REGISTRY_CHANGE,
                $e->getMessage()
            );
        }
    }

    /**
     * @param PublicoAlvo $publicoAlvo
     * @throws PublicoAlvoDatabaseException
     */
    public function deletePublicoAlvo(PublicoAlvo $publicoAlvo): void
    {
        try {
            $this->getEntityManager()->remove($publicoAlvo);
            $this->getEntityManager()->flush();
        } catch (Exception $e) {
            throw new PublicoAlvoDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_DELETING_RECORD,
                $e->getMessage()
            );
        }
    }

    /**
     * @param int $publicoAlvoId
     * @return PublicoAlvo|null
     * @throws PublicoAlvoDatabaseException
     */
    public function findByPublicoAlvoId(int $publicoAlvoId): ?PublicoAlvo
    {
        try {
            return $this->getEntityManager()->getRepository(PublicoAlvo::class)
                ->findOneBy(['id' => $publicoAlvoId]);
        } catch (Exception $e) {
            throw new PublicoAlvoDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_QUERY_A_RECORD . "id " . $publicoAlvoId,
                $e->getMessage()
            );
        }
    }

    /**
     * @return array|null
     * @throws PublicoAlvoDatabaseException
     */
    public function findAllPublicosAlvos(): ?array
    {
        try {
            return $this->getEntityManager()->getRepository(PublicoAlvo::class)->findAll();
        } catch (Exception $e) {
            throw new PublicoAlvoDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_QUERY_ALL_RECORD,
                $e->getMessage()
            );
        }
    }

    /**
     * @param string $titulo
     * @return array|null
     * @throws PublicoAlvoDatabaseException
     * @throws SQLFileNotFoundException
     */
    public function findPublicoAlvoByTitulo(string $titulo): ?array
    {
        try {
            $this->setInstance();
            $this->resultSetMapping->addScalarResult('id', 'id');
            $this->resultSetMapping->addScalarResult('titulo', 'titulo');
            $this->resultSetMapping->addScalarResult('descricao', 'descricao');
            $this->resultSetMapping->addScalarResult('status', 'status');
            $this->resultSetMapping->addScalarResult('campanha_id', 'campanha_id');
            $sql = $this->readSQL->readArchive('PublicoAlvo', 'SELECT_PUBLICO_ALVO_BY_TITULO');
            $query = $this->getEntityManager()->createNativeQuery($sql, $this->resultSetMapping);
            $query->setParameter('titulo', $titulo);

            return $query->getOneOrNullResult();
        } catch (SQLFileNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new PublicoAlvoDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                "Ocorreu um erro ao buscar dados do publico alvo!",
                $e->getMessage()
            );
        }
    }
}