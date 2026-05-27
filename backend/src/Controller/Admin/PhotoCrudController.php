<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Doctrine\ORM\EntityManagerInterface;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class PhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photo::class;
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

            TextField::new('legende'),

            ImageField::new('urlFichier')
                ->setBasePath('uploads/photos')
                ->setUploadDir('public/uploads/photos'),
        ];
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
public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
{
    if (!$entityInstance instanceof Photo) {
        return;
    }

    if (empty($entityInstance->getUrlFichier())) {

        $this->addFlash(
            'danger',
            'L’URL de la photo est obligatoire.'
        );

        return;
    }

    $this->addFlash(
        'success',
        'Photo ajoutée avec succès.'
    );

    parent::persistEntity($entityManager, $entityInstance);
}
public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
{
    if (!$entityInstance instanceof Photo) {
        return;
    }

    $this->addFlash(
        'success',
        'Photo modifiée avec succès.'
    );

    parent::updateEntity($entityManager, $entityInstance);
}
public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
{
    if (!$entityInstance instanceof Photo) {
        return;
    }

    $this->addFlash(
        'success',
        'Photo supprimée avec succès.'
    );

    parent::deleteEntity($entityManager, $entityInstance);
}

}