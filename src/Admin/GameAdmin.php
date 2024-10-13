<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GameAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'pn_twitch_admin_game';

    /**
     * @param RouteCollectionInterface $collection
     */
    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        parent::configureRoutes($collection);
        $collection
            ->remove('create')
            ->remove('delete')
        ;
    }


    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('name', TextType::class, [
                'label' => 'label.name',
                'required' => true,
            ])
            ->add('picture', TextType::class, [
                'label' => 'label.picture',
                'required' => false,
            ])
            ->add('url', TextType::class, [
                'label' => 'label.url',
                'required' => false,
            ])
        ;

    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id', null, ['label' => 'label.id'])
            ->add('name', null, ['label' => 'label.name'])
            ->add('picture', null, ['label' => 'label.picture'])
            ->add('url', null, ['label' => 'label.url'])
        ;
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list): void
    {

        $list
            ->addIdentifier('id', null, ['label' => 'label.id'])
            ->add('name', null, ['label' => 'label.name', 'editable' => true])
            ->add('picture', null, ['label' => 'label.picture', 'editable' => true])
            ->add('url', null, ['label' => 'label.url', 'editable' => true])
            ->add('_action', 'actions', [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                ]
            ]);
    }

    /**
     * @param ShowMapper $show
     */
    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id', null, ['label' => 'label.id'])
            ->add('name', null, ['label' => 'label.name'])
            ->add('picture', null, ['label' => 'label.picture'])
            ->add('url', null, ['label' => 'label.url'])
        ;
    }
}
