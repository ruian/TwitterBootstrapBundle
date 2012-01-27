<?php
namespace Ruian\TwitterBootstrapBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Ruian\TwitterBootstrapBundle\Exception\TwitterBootstrapVersionException;
use lessc;

class CompilerCommand extends ContainerAwareCommand
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
            ->setName('twitter-bootstrap:compile')
            ->setDescription('Compile a version of twitter-bootstrap and paste it into RuianTwitterBundle public folder')
            ->addArgument('version', InputArgument::OPTIONAL, 'Main version v1 or v2', 'v1')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $version = $input->getArgument('version');
        if (false === in_array($version, $this->versions)) {
            throw new TwitterBootstrapVersionException("Version you have selected is not supported, or inexistant. Please choose one of these versions " . implode(' or ', $this->versions));
        }

        if (true === $this->writeCss($version, $output)) {
            $output->writeln('<info>Success, bootstrap'.$version.'.css has been write in /Ruian/TwitterBootstrapBundle/Resources/public/css/bootstrap'.$version.'.css</info>');
        }

        if (true === $this->writeJs($version, $output)) {
            $output->writeln('<info>Success, bootstrap'.$version.'.js has been write in  /Ruian/TwitterBootstrapBundle/Resources/public/js/bootstrap'.$version.'.js</info>');
        }
    }

    protected function writeCss($version, $output)
    {
        $in = __DIR__ . '/../../../../twitter/bootstrap/'.$version.'/lib/bootstrap.less';
        $out = __DIR__ . '/../Resources/public/css/bootstrap' . $version . '.css';
        lessc::ccompile($in, $out);
        $output->writeln('<comment>Writing bootstrap'.$version.'.css from bootstrap.less</comment>');
        $output->writeln('<comment>You can add bundles/ruiantwitterbootstrap/css/bootstrap'.$version.'.css to your layout</comment>');

        if ('v2' === $version) {
            $in = __DIR__ . '/../../../../twitter/bootstrap/'.$version.'/lib/responsive.less';
            $out = __DIR__ . '/../Resources/public/css/bootstrap' . $version . '-responsive.css';
            lessc::ccompile($in, $out);
            $output->writeln('<comment>Writing bootstrap'.$version.'-responsive.css from responsive.less</comment>');
            $output->writeln('<comment>You can add bundles/ruiantwitterbootstrap/css/bootstrap'.$version.'-responsive.css to your layout</comment>');
        }
        
        return true;
    }

    protected function writeJs($version, $output)
    {
        // Compiler tout les fichier js/*.js Ruian\TwitterBootstrap\Resources\public\js\bootstrap'version'.js
        $finder = new Finder();
        $finder->depth('== 0');
        $finder->files()->in(__DIR__ . '/../../../../twitter/bootstrap/'.$version.'/js/')->name('*.js');

        $bootstrapjs = null;
        foreach ($finder as $file) {
            $bootstrapjs .= file_get_contents($file->getRealPath());
            $output->writeln('<comment>Adding '.$file->getFilename().'</comment>');
        }
        file_put_contents(__DIR__ . '/../Resources/public/js/bootstrap'.$version.'.js', $bootstrapjs);
        $output->writeln('<comment>Writing bootstrap'.$version.'.js</comment>');
        $output->writeln('<comment>You can add bundles/ruiantwitterbootstrap/js/bootstrap'.$version.'.js to your layout</comment>');
        return true;
    }
}