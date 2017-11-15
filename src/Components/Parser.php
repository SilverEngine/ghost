<?php

namespace Silver\Ghost\Components;

class Parser
{
    private $config = [
        "{{{([^}]*)}}}",
        "@{{([^}]*)}}",
        "{{([^}]*)}}",
    ];
    //parse data

    /**
     * @param string $pattern
     * @return mixed
     */
    public function trim($pattern = '')
    {
        $body = preg_replace_callback("/$pattern/", function ($match) {
            $name = trim($match[1]);
            return "{{{ \$_block_{$name} }}}";
        }, $body);

        return $body;
    }

    /**
     * @return mixed
     */
    public function substr()
    {
        $body = preg_replace_callback("/#if.*/", function ($match) {
            $if = substr(trim($match[0]), 1);
            return "<?php $if { ?>";
        }, $body);

        return $body;
    }

    /**
     * @param int $config
     * @return mixed
     */
    public function vars($config = 0)
    {
        $body = preg_replace_callback("/" . $this->config[$config] . "/", function ($match) {
            $var = trim($match[1]);
            if ($config == 'normal')
                return "<?php echo @$var;?>";
            if ($config == 'vue')
                return '{@{@' . htmlentities($var) . '@}@}';
            else
                return "<?php echo @htmlentities($var); ?>";
        }, $body);

        return $body;
    }
}