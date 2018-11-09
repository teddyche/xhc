<?php

namespace App\Repository;

use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Video|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video[]    findAll()
 * @method Video[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Video::class);
    }

    /**
     * @return Video[]
     * Return all approved videos.
     * TODO finish the correct request.
     * Created  : 20181109 - TCH
     * Modified :
     */
    public function findAllVideos(): array
    {
        return $this->findAllApprovedQuery()
            ->orWhere('v.visible = false')
            ->orWhere('v.visible is null')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Video[]
     * Return latest videos added.
     * All returned videos need to be approved.
     * TODO finish the correct request.
     * Created  : 20181109 - TCH
     * Modified :
     */
    public function findLatest(): array
    {
        return $this->findAllApprovedQuery()
            ->orWhere('v.visible = false')
            ->orWhere('v.visible is null')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return QueryBuilder
     * Return a default query with filter on approved videos.
     * TODO finish the correct request.
     * Created  : 20181109 - TCH
     * Modified :
     */
    private function findAllApprovedQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('v')
            ->where('v.visible is null')
            ;
    }
    // /**
    //  * @return Video[] Returns an array of Video objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Video
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
