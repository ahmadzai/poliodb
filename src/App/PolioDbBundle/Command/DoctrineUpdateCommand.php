<?php
/**
 * Created by PhpStorm.
 * User: wakhan
 * Date: 11/26/2016
 * Time: 10:07 AM
 */
namespace App\PolioDbBundle\Command;

use Doctrine\Bundle\DoctrineBundle\Command\Proxy\UpdateSchemaDoctrineCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Doctrine\ORM\Tools\SchemaTool;

class DoctrineUpdateCommand extends UpdateSchemaDoctrineCommand
{
//    protected function configure()
//    {
//        $this
//            // the name of the command (the part after "bin/console")
//            ->setName('doctrine:schema:myupdate')
//
//            // the short description shown while running "php bin/console list"
//            ->setDescription('This will update the schema using customized class')
//
//            // the full command description shown when running the command with
//            // the "--help" option
//            ->setHelp("This allow you to ignore some entities to be updated...")
//        ;
//    }

    protected $ignoredEntities = array(
        'App\PolioDbBundle\Entity\RevisitData',
        'App\PolioDbBundle\Entity\AdminData4',
        'App\PolioDbBundle\Entity\DistrictAgg',
        'App\PolioDbBundle\Entity\ProvinceAgg',
        'App\PolioDbBundle\Entity\RegionAgg',
        'App\PolioDbBundle\Entity\ProvinceData',
        'App\PolioDbBundle\Entity\DistrictData',
        'App\PolioDbBundle\Entity\ClusterAgg',
    );


    protected function executeSchemaCommand(InputInterface $input, OutputInterface $output, SchemaTool $schemaTool, array $metadatas) {

        /** @var $metadata \Doctrine\ORM\Mapping\ClassMetadata */
        $newMetadatas = array();
        foreach ($metadatas as $metadata) {
            if (!in_array($metadata->getName(), $this->ignoredEntities)) {
                array_push($newMetadatas, $metadata);
            }
        }


        parent::executeSchemaCommand($input, $output, $schemaTool, $newMetadatas);
    }
}