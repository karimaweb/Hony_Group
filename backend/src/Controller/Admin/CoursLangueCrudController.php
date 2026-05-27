<?php

namespace App\Controller\Admin;

use App\Entity\CoursLangue;
use Doctrine\ORM\EntityManagerInterface;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use App\Repository\PrestationRepository;

class CoursLangueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CoursLangue::class;
    }
public function __construct(
    private PrestationRepository $prestationRepository
) {
}
    public function configureFields(string $pageName): iterable
{
    return [

        IdField::new('id')->hideOnForm(),

        TextField::new('langue', 'Cours'),

        TextField::new('niveau', 'Niveau'),

        TextareaField::new(
            'descriptifProgramme',
            'Programme'
        )->hideOnIndex(),

        ChoiceField::new('statut', 'Statut')->setChoices([
            'Actif' => 'actif',
            'Inactif' => 'inactif',
        ]),
        AssociationField::new('prestation', 'Prestation'),
        

    ];
}
public function configureCrud(Crud $crud): Crud
{
    return $crud
    
         ->showEntityActionsInlined()
         ->setEntityLabelInSingular('Formation')
        ->setEntityLabelInPlural('Formations');
}

public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
{
    if (!$entityInstance instanceof CoursLangue) {
        return;
    }

    if (empty($entityInstance->getLangue())) {

        $this->addFlash('danger', 'La langue est obligatoire.');

        return;
    }

    $this->addFlash(
        'success',
        'Cours de langue ajouté avec succès.'
    );

    parent::persistEntity($entityManager, $entityInstance);
}
public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
{
    if (!$entityInstance instanceof CoursLangue) {
        return;
    }

    if ($entityInstance->getStatut() === 'actif') {

        $this->addFlash(
            'danger',
            'Impossible de supprimer un cours actif.'
        );

        return;
    }

    $this->addFlash(
        'success',
        'Le cours de langue a été supprimé avec succès.'
    );

    parent::deleteEntity($entityManager, $entityInstance);
}
public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
{
    if (!$entityInstance instanceof CoursLangue) {
        return;
    }

    if (empty($entityInstance->getLangue())) {

        $this->addFlash('danger', 'La langue est obligatoire.');

        return;
    }

    $this->addFlash('success', 'Cours de langue modifié avec succès.');

    parent::updateEntity($entityManager, $entityInstance);
}
public function configureActions(Actions $actions): Actions
{
    return $actions
        ->update(Crud::PAGE_INDEX, Action::EDIT,
            fn (Action $action) => $action
                ->setIcon('fa fa-pen')
                ->setLabel('Modifier')
        )
        ->update(Crud::PAGE_INDEX, Action::DELETE,
            fn (Action $action) => $action
                ->setIcon('fa fa-trash')
                ->setLabel('Supprimer')
        );
}
}
