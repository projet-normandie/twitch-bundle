<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ChannelAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'pn_twitch_admin_channel';


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
            ->add('username', TextType::class, [
                'label' => 'label.username',
                'required' => true,
            ])
            ->add('isCommunity', null, [
                'label' => 'label.is_community',
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
            ->add('isCommunity', null, ['label' => 'label.is_community'])
        ;
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list): void
    {

        $list
            ->addIdentifier('id', null, ['label' => 'label.id'])
            ->add('name', null, ['label' => 'label.game', 'editable' => true])
            ->add('username', null, ['label' => 'label.username', 'editable' => true])
            ->add('isCommunity', null, ['label' => 'label.is_community'])
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
            ->add('username', null, ['label' => 'label.username'])
            ->add('isCommunity', null, ['label' => 'label.is_community'])
        ;
    }
}
