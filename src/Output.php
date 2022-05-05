<?php

namespace Yng\Console;

use Yng\Console\Output\Formatter;

class Output
{
    /**
     * @var Formatter
     */
    protected Formatter $formatter;

    public function __construct()
    {
        $this->formatter = new Formatter();
    }

    /**
     * 黑色字体
     */
    public const COLOR_BLACK = "\033[30m";

    /**
     * 红色字体
     */
    public const COLOR_RED = "\033[31m";

    /**
     * 绿色字体
     */
    public const COLOR_GREEN = "\033[32m";

    /**
     * 黄色字体
     */
    public const COLOR_YELLOW = "\033[33m";

    /**
     * 蓝色字体
     */
    public const COLOR_BLUE = "\033[34m";

    /**
     * 紫色字体
     */
    public const COLOR_PURPLE = "\033[35m";

    /**
     * 天蓝色字体
     */
    public const COLOR_AZURE = "\033[36m";

    /**
     * 白色字体
     */
    public const COLOR_WHITE = "\033[37m";

    /**
     * 蓝底白字
     */
    public const STYLE_BW = "\033[40;37m";

    /**
     * 红底黑字
     */
    public const STYLE_RB = "\033[41;30m";

    /**
     * 绿底蓝字
     */
    public const STYLE_GB = "\033[42;34m";

    /**
     * 黄底蓝字
     */
    public const STYLE_YB = "\033[43;34m";

    /**
     * 蓝底黑字
     */
    public const STYLE_BB = "\033[44;30m";

    /**
     * 紫底黑字
     */
    public const STYLE_PB = "\033[45;30m";

    /**
     * 天蓝底黑字
     */
    public const STYLE_AB = "\033[46;30m";

    /**
     * 白底蓝字
     */
    public const STYLE_WB = "\033[47;34m";

    public function warning($content)
    {
        $this->writeLine($content, self::COLOR_YELLOW);
    }

    public function info($content)
    {
        $this->writeLine($content, self::COLOR_GREEN);
    }

    public function error($content)
    {
        $this->writeLine($content, self::STYLE_RB);
    }

    public function notice(string $content)
    {
        return $this->formatter
            ->setForeground('green')
            ->apply($content);
    }

    public function styled($content, $style)
    {
        return sprintf("%s%s\033[0m", $style, $content);
    }

    /**
     * 输出一行
     *
     * @param        $output
     * @param string $style
     */
    public function writeLine($output, $style = self::COLOR_BLACK)
    {
        $this->write($output, $style);
        echo "\n";
    }

    /**
     * 输出
     *
     * @param string $content
     * @param        $style
     *
     * @return string
     */
    public function write(string $content, string $style = self::COLOR_BLACK)
    {
        echo $this->styled($content, $style);
    }

}
