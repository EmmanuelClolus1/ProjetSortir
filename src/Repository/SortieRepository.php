<?php

namespace App\Repository;

use App\Entity\Participant;
use App\Entity\Sortie;
use App\Form\Model\FilterModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ManagerRegistry;
use http\Client\Curl\User;
use Symfony\Bundle\SecurityBundle\Security;

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
    public function __construct(ManagerRegistry $registry, private Security $security)
    {
        parent::__construct($registry, Sortie::class);

    }

    public function findByFilter(FilterModel $filterModel)
    {
        $qb = $this->createQueryBuilder('s')
            ->leftJoin('s.campus', 'c')
            ->leftJoin('s.organisateur', 'o')
            ->leftJoin('s.etat', 'e');

        $qb->andWhere('(:campus IS NULL OR s.campus = :campus)')
            ->andWhere('(:nom IS NULL OR s.nom LIKE :nom)')
            ->andWhere('(:date_heure_debut IS NULL OR s.dateHeureDebut >= :date_heure_debut)')
            ->andWhere('(:date_limite_inscription IS NULL OR s.dateLimiteInscription <= :date_limite_inscription)')
            ->andWhere('(:sortieInscrit IS NULL OR :sortieInscrit MEMBER OF s.participants)')
            ->andWhere('(:organisateur IS NULL OR s.organisateur = :organisateur)')
            ->andWhere('(:sortiePasInscrit IS NULL OR :sortiePasInscrit NOT MEMBER OF s.participants)')
            ->andWhere('(:sortiePassees IS NULL OR e.libelle = :etatLib)')
            ->setParameter('campus', $filterModel->getFiltreCampus())
            ->setParameter('nom', $filterModel->getFiltreRecherche() ? '%' . $filterModel->getFiltreRecherche() . '%' : null)
            ->setParameter('date_heure_debut', $filterModel->getDateDebut())
            ->setParameter('date_limite_inscription', $filterModel->getDateFin())
            ->setParameter('sortieInscrit', $filterModel->getSortieInscrit() ? $this->security->getUser() : null)
            ->setParameter('organisateur', $filterModel->getSortieOrganisateur() ? $this->security->getUser() : null)
            ->setParameter('sortiePasInscrit', $filterModel->getSortiePasInscrit() ? $this->security->getUser() : null)
            ->setParameter('sortiePassees', $filterModel->getSortiePassees() ? 'Passée' : null)
            ->setParameter('etatLib', $filterModel->getSortiePassees() ? 'Passée' : null);

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
