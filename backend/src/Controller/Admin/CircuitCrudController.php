<?php

namespace App\Controller\Admin;

use App\Entity\Circuit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class CircuitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Circuit::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
             ->showEntityActionsInlined();
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titreCircuit', 'Titre'),
            TextareaField::new('descriptionLongue', 'Description')->hideOnIndex(),
            TextareaField::new('itineraire', 'Itinéraire')->hideOnIndex(),
            TextField::new('duree', 'Durée'),
            ChoiceField::new('statut', 'Statut')->setChoices([
                'actif' => 'actif',
                'inactif' => 'inactif',
            ]),
            AssociationField::new('prestation', 'Prestation'),
            ImageField::new('prestation.photo.urlFichier')
                 ->setBasePath('uploads/photos')
                 ->setLabel('Photo')
                 ->onlyOnIndex(),
            
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Circuit) return;

        if (empty($entityInstance->getTitreCircuit())) {
            $this->addFlash('danger', 'Le titre du circuit est obligatoire.');
            return;
        }

        $this->addFlash('success', 'Circuit ajouté avec succès.');
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Circuit) return;

        if (empty($entityInstance->getTitreCircuit())) {
            $this->addFlash('danger', 'Le titre est obligatoire.');
            return;
        }

        $this->addFlash('success', 'Circuit modifié avec succès.');
        parent::updateEntity($entityManager, $entityInstance);
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Circuit) return;

        if ($entityInstance->getStatut() === 'actif') {
            $this->addFlash('danger', 'Impossible de supprimer un circuit actif.');
            return;
        }

        $this->addFlash('success', 'Le circuit a été supprimé avec succès.');
        parent::deleteEntity($entityManager, $entityInstance);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::EDIT,
                fn (Action $action) => $action->setIcon('fa fa-pen')->setLabel('Modifier')
            )
            ->update(Crud::PAGE_INDEX, Action::DELETE,
                fn (Action $action) => $action->setIcon('fa fa-trash')->setLabel('Supprimer')
            );
    }
}