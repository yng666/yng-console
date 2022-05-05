<?php

namespace Yng\Console;

class Input
{
    /**
     * 当前命令名
     *
     * @var string
     */
    protected string $command;

    /**
     * 选项
     *
     * @var array
     */
    protected array $options = [];

    /**
     * 参数
     *
     * @var array
     */
    protected array $arguments = [];

    /**
     * 是否有参数
     *
     * @var bool
     */
    protected bool $hasParameter = false;

    /**
     * Input constructor.
     */
    public function __construct()
    {
        global $argv;
        $this->command = $argv[1] ?? 'help';
        if (!empty($parameters = array_slice($argv, 2))) {
            $this->parseParameters($parameters);
        }
    }

    /**
     * 判断是否有参数
     *
     * @return bool
     */
    public function hasParameters(): bool
    {
        return $this->hasParameter;
    }

    /**
     * 解析参数
     *
     * @param array $parameters
     */
    protected function parseParameters(array $parameters)
    {
        $this->hasParameter = true;
        $parameters         = implode(' ', $parameters);
        preg_match_all('/(-{1,2}[\w-]+)\s+(?!-)([\/\w\.\-]+)/', $parameters, $matches);
        if (!empty($matches)) {
            $this->options   = array_combine($matches[1], $matches[2]);
            $this->arguments = array_filter(explode(' ', str_replace($matches[0], '', $parameters)));
        }
    }

    /**
     * 判断是否有选项，例如 -c index
     *
     * @param string $option
     *
     * @return bool
     */
    public function hasOption(string $option): bool
    {
        return isset($this->options[$option]);
    }

    /**
     * 根据选项的名字取值
     *
     * @param string $option
     *
     * @return string
     */
    public function getOption(string $option): string
    {
        return $this->options[$option];
    }

    /**
     * 获取所有选项
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * 获取所有参数
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * 判断是否有参数, 例如 -H 或者 --help
     *
     * @param string $argument
     *
     * @return bool
     */
    public function hasArgument(string $argument): bool
    {
        $arguments = array_flip($this->arguments);
        return isset($arguments[$argument]);
    }

    /**
     * 获取参数
     *
     * @param string $argument
     *
     * @return string
     */
    public function getArgument(string $argument): string
    {
        return $this->arguments[$argument];
    }

    /**
     * 获取命令
     *
     * @return mixed|string
     */
    public function getCommand()
    {
        return $this->command;
    }
    
}
