<?php


/**
 * Class env
 */
class env
{


    /**
     * env constructor.
     */
    public function __construct()
    {
        echo "I am ENV";
    }

    public function readEnv()
    {
        if(file_exists('../env.php')) {
            include '../env.php';
        }

        if(!function_exists('env')) {
            function env($key, $default = null)
            {
                $value = getenv($key);

                if ($value === false) {
                    return $default;
                }

                return $value;
            }
        }
    }
}