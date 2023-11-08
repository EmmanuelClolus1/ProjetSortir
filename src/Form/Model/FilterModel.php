<?php

namespace App\Form\Model;
use App\Entity\Campus;
use App\Form\FilterModelType;
use Symfony\Component\Form\FormTypeInterface;


class FilterModel
{

    private $sortieOrganisateur;

    private $sortieInscrit;

    private $sortiePasInscrit;

    private $sortiePassees;

    private ?Campus $filtreCampus = null;

    private $filtreRecherche;

    private $dateDebut;

    private $dateFin;

    /**
     * @return mixed
     */
    public function getSortieOrganisateur()
    {
        return $this->sortieOrganisateur;
    }

    /**
     * @param mixed $sortieOrganisateur
     */
    public function setSortieOrganisateur($sortieOrganisateur): void
    {
        $this->sortieOrganisateur = $sortieOrganisateur;
    }

    /**
     * @return mixed
     */
    public function getSortieInscrit()
    {
        return $this->sortieInscrit;
    }

    /**
     * @param mixed $sortieInscrit
     */
    public function setSortieInscrit($sortieInscrit): void
    {
        $this->sortieInscrit = $sortieInscrit;
    }

    /**
     * @return mixed
     */
    public function getSortiePasInscrit()
    {
        return $this->sortiePasInscrit;
    }

    /**
     * @param mixed $sortiePasInscrit
     */
    public function setSortiePasInscrit($sortiePasInscrit): void
    {
        $this->sortiePasInscrit = $sortiePasInscrit;
    }

    /**
     * @return mixed
     */
    public function getSortiePassees()
    {
        return $this->sortiePassees;
    }

    /**
     * @param mixed $sortiePassees
     */
    public function setSortiePassees($sortiePassees): void
    {
        $this->sortiePassees = $sortiePassees;
    }

    /**
     * @return mixed
     */
    public function getFiltreCampus()
    {
        return $this->filtreCampus;
    }

    /**
     * @param mixed $filtreCampus
     */
    public function setFiltreCampus($filtreCampus): void
    {
        $this->filtreCampus = $filtreCampus;
    }

    /**
     * @return mixed
     */
    public function getFiltreRecherche()
    {
        return $this->filtreRecherche;
    }

    /**
     * @param mixed $filtreRecherche
     */
    public function setFiltreRecherche($filtreRecherche): void
    {
        $this->filtreRecherche = $filtreRecherche;
    }

    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param mixed $dateDebut
     */
    public function setDateDebut($dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param mixed $dateFin
     */
    public function setDateFin($dateFin): void
    {
        $this->dateFin = $dateFin;
    }


}