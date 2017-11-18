<?php

namespace Silver\Ghost\Components;

class Statments
{
    public function render($params)
    {
        $body = $params[0];

        $body = preg_replace_callback("/(?s)#if.*#endif/", function ($match) {

            //
            $conditions = explode("\n", $match[0]);
            $conditions = array_filter($conditions);

            //
            $conditions = array_map(function ($elem) {
                return trim($elem);
            }, array_values($conditions));

            $ifPosition = key(preg_grep("/^#if/", $conditions));
            $elseIf     = preg_grep("/^#elseif/", $conditions);
            $elseIf     = preg_grep("/^#else/", $conditions);
            $else       = key(preg_grep("/^#else$/", $conditions));
            $end        = key(preg_grep("/^#endif$/", $conditions));

            // if condition

            if (preg_match("/=|==|===|!==|!=|<>|<=|>=|<|>|&&|and|or| (\|\|) |\+|\*|\-|\//i", $conditions[$ifPosition])) {

                $firstIf = preg_replace("/#if\s/", null, $conditions[$ifPosition]);


                if (eval("return $firstIf;")) {

                    $start = $ifPosition + 1;

                    if ($else) {
                        for ($i = $start; $i < $else; $i++) {

                            echo $conditions[$i];
                        }

                        return ;
                    }


                    for ($i = $start; $i < $end; $i++) {
                        echo  $conditions[$i];
                    }

                    return;


                } else {


                    foreach ($elseIf as $key => $value) {
                        $cond = preg_replace("/^#elseif|#else|\s{2,}/", null, trim($value));

                        next($elseIf);

                        $stop = key($elseIf);

                        if (eval("return $cond ;")) {
                            $start = $key + 1;

                            for ($i = $start; $i < $stop; $i++) {

                                echo $conditions[$i];
                            }

                            return;
                        }

                    }


                    // else condition
                    if ($else) {
                        for ($i = $else + 1; $i < $end; $i++) {
                            echo $conditions[$i];
                        }
                    }

                    return;
                }
            }


        }, $body);


        return $body;

    }
}