<?php

namespace App\Controller\Admin;

use App\Entity\Example;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ExampleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Example::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
