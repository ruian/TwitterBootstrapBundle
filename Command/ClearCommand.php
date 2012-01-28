<?php
namespace Ruian\TwitterBootstrapBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

class ClearCommand extends ContainerAwareCommand
{
    protected $versions;


    public function __construct()
    {
        parent::__construct($name = null);
        $this->versions = array(
            'v1',
            'v2'
        );
    }

    protected function configure()
    {
        $this
            ->setName('twitter-bootstrap:clear')
            ->setDescription('Delete any css and js in RuianTwitterBootstrapBundle Resources')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/../Resources/public/')->name('/(js$)|(css$)/');

        foreach ($finder->files() as $file) {
            unlink($file->getRealPath());
            $output->writeln('<comment>Delete '. $file->getFilename() .'</comment>');
        }
        $output->writeln('<info>Success every files had been removed</info>');
    }
}