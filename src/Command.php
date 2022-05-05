<?php
declare(strict_types=1);

namespace Yng\Console;

use Yng\Framework\App;

abstract class Command
{
    /**
     * @var App
     */
    protected $app;

    /**
     * 命令名
     *
     * @var string
     */
    protected $name = '';

    /**
     * 命令描述
     *
     * @var string
     */
    protected $description = '';

    /**
     * @var Input
     */
    protected $input;

    /**
     * @var Output
     */
    protected $output;

    /**
     * 参数列表
     *
     * @var array
     */
    private $arguments = [];

    /**
     * 选项
     *
     * @var array
     */
    private $options = [];

    //    /**
    //     * 实际执行的方法
    //     * @return mixed
    //     */
    //    abstract public function handle();

    /**
     * @return string
     */
    final public function getName(): string
    {
        return $this->name;
    }

    /**
     * 设置命令描述
     *
     * @param string $description
     */
    final public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    final public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * 设置命令名
     *
     * @param string $name
     *
     * @return $this
     */
    final public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    final public function addOption(string $option, string $description = '', string $alias = '')
    {
        $this->options[$option] = $description;
        return $this;
    }

    final public function getOptions()
    {
        return $this->options;
    }

    final public function addArgument(string $argument)
    {
        $this->arguments[$argument] = $argument;
    }

    final protected function writeLine(string $output, string $style = Output::COLOR_BLACK)
    {
        return $this->output->writeLine($output, $style);
    }

    public static function dispatch()
    {
        return (new static)->handle();
    }

    public function help()
    {

    }

    final public static function __new(App $app, Input $input, Output $output)
    {
        $command         = new static($app);
        $command->app    = $app;
        $command->input  = $input;
        $command->output = $output;
        return $command;
    }

    public function setInputAndOutput(Input $input, Output $output)
    {
        $this->input  = $input;
        $this->output = $output;

        return $this;
    }

}
