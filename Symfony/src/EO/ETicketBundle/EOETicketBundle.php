<?php

namespace EO\ETicketBundle;

use Doctrine\DBAL\Types\Type;
use EO\ETicketBundle\Type\BookingType;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EOETicketBundle extends Bundle
{

    /**
     * @throws \Doctrine\DBAL\DBALException
     */
    public function boot()
    {
        if(!Type::hasType('BookingType')){
            Type::addType('BookingType', "EO\\ETicketBundle\\Type\\BookingType");
        }

        if(!Type::hasType('RateType')){
            Type::addType('RateType', "EO\\ETicketBundle\\Type\\RateType");
        }

        $entityMgr = $this->container->get('doctrine.orm.entity_manager');
        if(!$entityMgr->getConnection()->getDatabasePlatform()->hasDoctrineTypeMappingFor('BookingType')) {
            $entityMgr->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'BookingType');
        }

        if(!$entityMgr->getConnection()->getDatabasePlatform()->hasDoctrineTypeMappingFor('RateType')) {
            $entityMgr->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'RateType');
        }

        //parent::boot(); // TODO: Change the autogenerated stub
    }
}
