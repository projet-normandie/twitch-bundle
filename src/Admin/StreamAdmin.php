<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class StreamAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'pn_twitch_admin_stream';

    /**
     * @param RouteCollectionInterface $collection
     */
    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        parent::configureRoutes($collection);
        $collection
            ->remove('create')
        ;
    }


    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('title', null, [
                'label' => 'label.title',
            ])
            ->add('game', ModelListType::class, [
                'label' => 'label.game',
                'required' => true,
                'btn_add' => false,
                'btn_list' => true,
                'btn_edit' => false,
                'btn_delete' => false,
            ])
            ->add('channel', ModelListType::class, [
                'label' => 'label.channel',
                'required' => true,
                'btn_add' => false,
                'btn_list' => true,
                'btn_edit' => false,
                'btn_delete' => false,
            ])
            ->add('type', null, [
                'label' => 'label.type',
            ])
            ->add('language', null, [
                'label' => 'label.language',
            ])
            ->add('isMature', CheckboxType::class, [
                'label' => 'label.is_mature',
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
            ->add('title', null, ['label' => 'label.title'])
            ->add('game', null, ['label' => 'label.game'])
            ->add('channel', null, ['label' => 'label.channel'])
        ;
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list): void
    {

        $list
            ->addIdentifier('id', null, ['label' => 'label.id'])
            ->add('title', null, ['label' => 'label.title', 'editable' => true])
            ->add('game', null, ['label' => 'label.game'])
            ->add('channel', null, ['label' => 'label.channel'])
            ->add('startedAt', null, ['label' => 'label.started_at'])
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
            ->add('title', null, ['label' => 'label.title', 'editable' => true])
            ->add('game', null, ['label' => 'label.game'])
            ->add('channel', null, ['label' => 'label.channel'])
            ->add('startedAt', null, ['label' => 'label.started_at'])
            ->add('isMature', null, ['label' => 'label.is_mature'])
            ->add('tags', null, ['label' => 'label.tags'])
        ;
    }
}
