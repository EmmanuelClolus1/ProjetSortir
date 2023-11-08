<?php

namespace App\Repository;

use App\Entity\Participant;
use App\Entity\Sortie;
use App\Form\Model\FilterModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sortie>
 *
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);

    }

    public function findByFilter(FilterModel $filterModel)
    {
        $qb = $this->createQueryBuilder('s');


        if ($filterModel->getFiltreCampus()) {

        $qb->leftJoin('s.campus', 'c');

            $qb->andWhere('s.campus = :campus')
                ->setParameter('campus', $filterModel->getFiltreCampus());
        }
        if ($filterModel->getFiltreRecherche()) {
            $recherche = $filterModel->getFiltreRecherche(); // Get the search value from the filter model

            $qb->andWhere('s.nom LIKE :nom')
                ->setParameter('nom', '%' . $recherche . '%');
        }
            if($filterModel->getDateDebut()){

            }
            if ($filterModel->getDateFin()){

            }
            if ($filterModel->getSortieInscrit()){

            }
            if ($filterModel->getSortieOrganisateur()){

            }
            if ($filterModel->getSortiePasInscrit()){


            }
//            if ($filterModel->getSortiePassees()){
//                $qb->leftJoin('s.etat', 'e' );
//
//                $qb->andWhere('s.etat = :Passee')
//                    ->setParameter('etat', $filterModel->getSortiePassees());
//
//            }
        $query = $qb->getQuery();
        return $query->getResult();
    }



//    /**
//     * @return Sortie[] Returns an array of Sortie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Sortie
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
