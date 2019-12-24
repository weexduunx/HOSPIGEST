<?php

namespace App\Repository;

use App\Entity\Medecin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Medecin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medecin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medecin[]    findAll()
 * @method Medecin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedecinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Medecin::class);
    }

    // /**
    //  * @return Medecin[] Returns an array of Medecin objects
    //  */
    
    public function findByExampleField($matricule)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('service_id = :1')
            ->setParameter('val', $matricule)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    
    public function findOneBySomeField($matricule): ?Medecin
    {
        return $this->createQueryBuilder('m')
            ->andWhere('service_id = :1')
            ->setParameter('val', $matricule)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
}
