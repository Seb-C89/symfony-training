<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * @return Post[]
     */
    public function getAllDistinctGameName(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT DISTINCT p.game
            FROM App\Entity\Post p
            WHERE p.status = 'OK'
            ORDER BY p.game ASC"
        );

        // returns an array of Product objects
        return $query->getResult();
    }

    public function getMorePosts($id): array {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQueryBuilder()
            ->select("p")
            ->from('App\Entity\Post', 'p')
            ->where("p.status = 'OK' AND p.id < :id")
            ->orderBy('p.date', 'DESC')
            ->setMaxResults(5)
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getResult();
    }

//    /**
//     * @return Post[] Returns an array of Post objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Post
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
