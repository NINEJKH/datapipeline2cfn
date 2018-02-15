<?php

namespace App\Commands;

use App\Converter;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class ConvertCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('convert')
            ->setDescription('Convert DataPipeline export to CFN PipelineObjects.')
            ->addArgument('file', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!file_exists($input->getArgument('file'))) {
            throw new Exception(sprintf('Unable to open: %s', $input->getArgument('file')));
        }

        $pipeline = json_decode(file_get_contents($input->getArgument('file')), true);

        $converted_objects = Converter::convert($pipeline['objects']);

        echo Yaml::dump(Converter::export($converted_objects), 4, 2);
    }
}
