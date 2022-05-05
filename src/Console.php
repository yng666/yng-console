<?php
declare(strict_types=1);

namespace Yng\Console;

use Yng\Framework\App;

class Console
{
    /**
     * @var ?App
     */
    protected ?App $app;

    /**
     * @var array
     */
    protected array $buildIn = [];

    /**
     * 用户自定义命令
     *
     * @var array
     */
    protected array $commands = [];

    /**
     * 服务提供者
     *
     * @var array
     */
    protected array $providers = [];

    /**
     * Console constructor.
     *
     * @param App    $app
     * @param Input  $input
     * @param Output $output
     */
    public function __construct(App $app = null)
    {
        if ($app) {
            $this->app = $app;
            $app->register(...array_map([$app, 'make'], $this->providers));
            $app->boot();
        }
    }

    /**
     * 添加命令
     *
     * @param $command
     * @param $handle
     */
    public function add($command, $handler)
    {
        $this->commands[$command] = $handler;
        return $this;
    }

    /**
     * 获取所有命令
     *
     * @return array
     */
    public function getAllCommands(): array
    {
        return array_merge($this->commands, $this->buildIn);
    }

    public function run(Input $input, Output $output)
    {
        $commands = $this->getAllCommands();
        $command  = $input->getCommand();
        if (isset($commands[$command])) {
            $command = $commands[$command];
            $command = $this->app ? $this->app->make($command) : new $command;
            $command->setInputAndOutput($input, $output);

            return $command->handle();
        }

        return $output->error("命令{$command}无效，输入php max help查看支持的命令！");
    }
}
