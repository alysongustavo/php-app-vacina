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
use App\Exception\CampanhaDatabaseException;
use App\Entity\Campanha;

class CampanhaRepository extends EntityRepository
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
     * @param Campanha $campanha
     * @return Campanha
     * @throws CampanhaDatabaseException
     */
    public function insertCampanha(Campanha $campanha): Campanha
    {
        try {
            $this->getEntityManager()->persist($campanha);
            $this->getEntityManager()->flush();
            return $campanha;
        } catch (Exception $e) {
            throw new CampanhaDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_INSERTING_RECORD,
                $e->getMessage()
            );
        }
    }

    /**
     * @param Campanha $campanha
     * @return Campanha
     * @throws CampanhaDatabaseException
     */
    public function updateCampanha(Campanha $campanha): Campanha
    {
        try {
            $this->getEntityManager()->merge($campanha);
            $this->getEntityManager()->flush();
            return $campanha;
        } catch (Exception $e) {
            throw new CampanhaDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_REGISTRY_CHANGE,
                $e->getMessage()
            );
        }
    }

    /**
     * @param Campanha $campanha
     * @throws CampanhaDatabaseException
     */
    public function deleteCampanha(Campanha $campanha): void
    {
        try {
            $this->getEntityManager()->remove($campanha);
            $this->getEntityManager()->flush();
        } catch (Exception $e) {
            throw new CampanhaDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_DELETING_RECORD,
                $e->getMessage()
            );
        }
    }

    /**
     * @param int $campanhaId
     * @return Campanha|null
     * @throws CampanhaDatabaseException
     */
    public function findByCampanhaId(int $campanhaId): ?Campanha
    {
        try {
            return $this->getEntityManager()->getRepository(Campanha::class)
                ->findOneBy(['id' => $campanhaId]);
        } catch (Exception $e) {
            throw new CampanhaDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_QUERY_A_RECORD . "id " . $campanhaId,
                $e->getMessage()
            );
        }
    }

    /**
     * @return array|null
     * @throws CampanhaDatabaseException
     */
    public function findAllCampanhas(): ?array
    {
        try {
            return $this->getEntityManager()->getRepository(Campanha::class)->findAll();
        } catch (Exception $e) {
            throw new CampanhaDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_QUERY_ALL_RECORD,
                $e->getMessage()
            );
        }
    }

    /**
     * @param string $titulo
     * @return array|null
     * @throws CampanhaDatabaseException
     * @throws SQLFileNotFoundException
     */
    public function findCampanhaByTitulo(string $titulo): ?array
    {
        try {
            $this->setInstance();
            $this->resultSetMapping->addScalarResult('id', 'id');
            $this->resultSetMapping->addScalarResult('titulo', 'titulo');
            $this->resultSetMapping->addScalarResult('descricao', 'descricao');
            $this->resultSetMapping->addScalarResult('dataIni', 'dataIni');
            $this->resultSetMapping->addScalarResult('dataFim', 'dataFim');
            $sql = $this->readSQL->readArchive('Campanha', 'SELECT_CAMPANHA_BY_TITULO');
            $query = $this->getEntityManager()->createNativeQuery($sql, $this->resultSetMapping);
            $query->setParameter('titulo', $titulo);
            return $query->getOneOrNullResult();
        } catch (SQLFileNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new CampanhaDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                "Ocorreu um erro ao buscar dados da campanha!",
                $e->getMessage()
            );
        }
    }
}