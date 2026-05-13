<?php

namespace App\Controller\Admin;

use App\Entity\CoursLangue;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CoursLangueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CoursLangue::class;
    }

     public function configureFields(string $pageName): iterable
    {
    return [

        IdField::new('id')->hideOnForm(),

        TextField::new('langue'),

        TextField::new('niveau'),

        TextEditorField::new('descriptifProgramme'),
        AssociationField::new('prestation'),
    ];
    }
}
