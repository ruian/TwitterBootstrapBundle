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
use Ruian\TwitterBootstrapBundle\Command\CompilerCommand;
use Ruian\TwitterBootstrapBundle\Command\ClearCommand;
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
//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        $container = $this->getContainer();
//        $container->get('some_service')->doSomethingWith($argument);
//    }
//
    private $application;
    private $tester;
    protected $cmd_line;

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
        $this->cmd_line = $cmd_line;
        $name = $this->getCommandName();
        $command = $this->application->find($name);

        $arguments = $this->getCommandArguments($command);
        $options = $this->getCommandOptions();
        
        $this->tester = new CommandTester($command);
        $this->tester->execute(array_merge(array('command' => $name), $arguments, $options));
    }

    protected function getCommandName()
    {
        $position = strlen($this->cmd_line);
        if (strpos($this->cmd_line, ' ')) {
            $position = strpos($this->cmd_line, ' ');
        }

        $rest = substr($this->cmd_line, 0, $position);
        if (false !== $rest) {
            $this->cmd_line = substr($this->cmd_line, $position + 1);
            return $rest;
        }

        return $this->cmd_line;
    }

    protected function getCommandArguments($command)
    {
        $space = false;
        $position_end = strlen($this->cmd_line);
        $length = strlen($this->cmd_line);
        for ($i = 0;$i < $length; $i++) {
            if ($this->cmd_line[$i] === ' ') {
                $space = true;
            } elseif ($space === true && $this->cmd_line[$i] === '-') {
                $position_end = $i - 1;
                break;
            } else {
                $space = false;
            }
        }
        
        $cmd_args_has_string = substr($this->cmd_line, 0, $position_end);
        $this->cmd_line = substr($this->cmd_line, $position_end + 1);
        
        $cmd_args_has_array = explode(' ', $cmd_args_has_string);
        $cmd_def_args = $command->getDefinition()->getArguments();
        
        $cmd_args = array();
        $i = 0;
        foreach ($cmd_def_args as $key => $argument) {
            $cmd_args[$argument->getName()] = $cmd_args_has_array[$i];
            $i++;
        }

        return $cmd_args;
    }

    protected function getCommandOptions()
    {
        if (false === $this->cmd_line) {
            return array();
        }

        $cmd_options_has_array = explode(' ', $this->cmd_line);

        $cmd_options = array();
        foreach ($cmd_options_has_array as $option) {
            $option_has_array = explode('=', $option);
            $cmd_options[$option_has_array[0]] = array_key_exists(1, $option_has_array) ? $option_has_array[1] : null;
        }

        return $cmd_options;
    }

    /**
     * @Then /^I should see$/
     */
    public function iShouldSee(PyStringNode $string)
    {
        $assert = false;
        if (1 === strcmp($string->getRaw(), $this->tester->getDisplay()) 
        || -1 === strcmp($string->getRaw(), $this->tester->getDisplay())) {
            $assert = true;
        }

        assertTrue($assert);
    }

    /**
     * @Then /^I should get a file "([^"]*)"$/
     */
    public function iShouldGetAFile($filename)
    {
        $assert = false;
        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/../../Resources/public/');

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
        $finder->files()->in(__DIR__ . '/../../Resources/public/');

        assertTrue(0 < count($finder->files()));
    }
}
