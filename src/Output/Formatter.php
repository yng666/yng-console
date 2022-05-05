<?php

namespace Yng\Console\Output;

class Formatter
{
    /**
     * 前景色
     *
     * @var \int[][]
     */
    private static $foregroundColors = [
        'black'   => ['set' => 30, 'unset' => 39],
        'red'     => ['set' => 31, 'unset' => 39],
        'green'   => ['set' => 32, 'unset' => 39],
        'yellow'  => ['set' => 33, 'unset' => 39],
        'blue'    => ['set' => 34, 'unset' => 39],
        'magenta' => ['set' => 35, 'unset' => 39],
        'cyan'    => ['set' => 36, 'unset' => 39],
        'white'   => ['set' => 37, 'unset' => 39],
        'default' => ['set' => 39, 'unset' => 39],
    ];

    /**
     * 背景色
     *
     * @var \int[][]
     */
    private static $backgroundColors = [
        'black'   => ['set' => 40, 'unset' => 49],
        'red'     => ['set' => 41, 'unset' => 49],
        'green'   => ['set' => 42, 'unset' => 49],
        'yellow'  => ['set' => 43, 'unset' => 49],
        'blue'    => ['set' => 44, 'unset' => 49],
        'magenta' => ['set' => 45, 'unset' => 49],
        'cyan'    => ['set' => 46, 'unset' => 49],
        'white'   => ['set' => 47, 'unset' => 49],
        'default' => ['set' => 49, 'unset' => 49],
    ];

    /**
     * 选项
     *
     * @var \int[][]
     */
    private static $options = [
        'bold'       => ['set' => 1, 'unset' => 22],
        'underscore' => ['set' => 4, 'unset' => 24],
        'blink'      => ['set' => 5, 'unset' => 25],
        'reverse'    => ['set' => 7, 'unset' => 27],
        'conceal'    => ['set' => 8, 'unset' => 28],
    ];

    protected $foreground;
    protected $background;
    protected $option;

    public function __construct($foreground = null, $background = null, $option = null)
    {
        isset($foreground) && $this->setForeground($foreground);
        isset($background) && $this->setBackground($background);
        isset($option) && $this->setOption($option);
    }

    /**
     * @param mixed $foreground
     */
    public function setForeground($foreground)
    {
        $this->foreground = self::$foregroundColors[$foreground];

        return $this;
    }

    /**
     * @param mixed $background
     */
    public function setBackground($background)
    {
        $this->background = self::$backgroundColors[$background];

        return $this;
    }

    /**
     * @param mixed $option
     */
    public function setOption($option)
    {
        $this->option = self::$options[$option];

        return $this;
    }

    public function apply($text)
    {
        $setCodes   = array();
        $unsetCodes = array();

        if (null !== $this->foreground) {
            $setCodes[]   = $this->foreground['set'];
            $unsetCodes[] = $this->foreground['unset'];
        }
        if (null !== $this->background) {
            $setCodes[]   = $this->background['set'];
            $unsetCodes[] = $this->background['unset'];
        }
        if (count($this->options)) {
            foreach ($this->options as $option) {
                $setCodes[]   = $option['set'];
                $unsetCodes[] = $option['unset'];
            }
        }

        if (0 === count($setCodes)) {
            return $text;
        }

        return sprintf("\033[%sm%s\033[%sm", implode(';', $setCodes), $text, implode(';', $unsetCodes));
    }
}
