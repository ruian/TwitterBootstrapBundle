<?php

namespace Ruian\TwitterBootstrapBundle\Features\Context;

use Behat\BehatBundle\Context\BehatContext,
    Behat\BehatBundle\Context\MinkContext;
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Console\Input\StringInput;
use Ruian\TwitterBootstrapBundle\Command\CompilerCommand;
use Ruian\TwitterBootstrapBundle\Command\ClearCommand;
use Symfony\Component\Console\Output\StreamOutput;
//
// Require 3rd-party libraries here:
//
  require_once 'PHPUnit/Autoload.php';
  require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Feature context.
 */
class FeatureContext extends BehatContext //MinkContext if you want to test web
{
    protected $application;
    protected $output;

    public function __construct($kernel)
    {
        $this->application = new Application($kernel);
        $this->application->add(new CompilerCommand());
        $this->application->add(new ClearCommand());
        // add other commands if needed
    }

    /**
     * @When /^I run "([^"]*)" command$/
     */
    public function iRunCommand($cmd_line)
    {
        $input = new StringInput($cmd_line);
        $command = $this->application->find($input->getFirstArgument('command'));
        $input = new StringInput($cmd_line, $command->getDefinition());
        $this->output = new StreamOutput(fopen('php://memory', 'w', false));
        $command->run($input, $this->output);
    }

    /**
     * @Then /^I should see$/
     */
    public function iShouldSee(PyStringNode $string)
    {
        rewind($this->output->getStream());
        $display = stream_get_contents($this->output->getStream());
        assertSame($string->getRaw(), $display);
    }

    /**
     * @Then /^I should get a file "([^"]*)"$/
     */
    public function iShouldGetAFile($filename)
    {
        $assert = false;
        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/../../Resources/public/')->name('/(css$)|(js$)/');

        foreach ($finder->files() as $file) {
            if ($filename === $file->getFilename()) {
                $assert = true;
            }
        }

        assertTrue($assert);
    }

    /**
     * @Then /^I should get no file$/
     */
    public function iShouldGetNoFile()
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/../../Resources/public/')->name('/(css$)|(js$)/');

        $assert = true;
        foreach ($finder->files() as $key => $value) {
            $assert = false;
            break;
        }
        
        assertTrue($assert);
    }
}
