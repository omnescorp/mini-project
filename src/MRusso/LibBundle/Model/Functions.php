<?php

namespace MRusso\LibBundle\Model;

//use Symfony\Component\Console\Input\InputInterface;
//use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

class Functions {

    public static function sanitizeText($cadena) {
        $patron = array(
            '/\/|"|&|<|>| |¡|¢|£|¤/' => '-',
            '/\?|¿|\!/' => '-',
            '/¥|¦|§|¨|©|«|¬|­|®|¯/' => '-',
            '/±|&sup2;|&sup3;|´|µ|¶|·|÷/' => '-',
            '/°|&sup1;|,|»|&frac14;|&frac12;|&frac34;|¿/' => '-',
            // Sustituir vocales con signo por las vocales ordinarias.//
            '/à|á|â|ã|ä|å|æ|ª/' => 'a',
            '/À|Á|Â|Ã|Ä|Å|Æ/' => 'A',
            '/è|é|ê|ë|ð/' => 'e',
            '/È|É|Ê|Ë|Ð/' => 'E',
            '/ì|í|î|ï/' => 'i',
            '/Ì|Í|Î|Ï/' => 'I',
            '/ò|ó|ô|õ|ö|ø|º/' => 'o',
            '/Ò|Ó|Ô|Õ|Ö|Ø/' => 'o',
            '/ù|ú|û|ü/' => 'u',
            '/Ù|Ú|Û|Ü/' => 'U',
            // Algunas consonantes especiales como la ç, la y, la ñ y otras.//
            '/ç|ć/' => 'c',
            '/Ç/' => 'C',
            '/ý|ÿ/' => 'y',
            '/Ý|Ÿ/' => 'Y',
            '/ñ/' => 'n',
            '/Ñ/' => 'N',
            '/þ/' => 't',
            '/Þ/' => 'T',
            '/ß/' => 's',
        );

        return strtolower(preg_replace(array_keys($patron), array_values($patron), $cadena));
    }

    public static function sanitizeWord($cadena) {
        $patron = array(
            '/\/|"|&|<|>| |¡|¢|\.|£|¤/' => '',
            '/\?|¿|\!/' => '',
            '/¥|¦|§|¨|©|«|¬|­|®|¯/' => '',
            '/±|&sup2;|&sup3;|´|µ|¶|·|÷/' => '',
            '/°|&sup1;|,|»|&frac14;|&frac12;|&frac34;|¿/' => '',
        );

        return strtolower(preg_replace(array_keys($patron), array_values($patron), $cadena));
    }

    public static function alphaID($in, $to_num = false, $pad_up = false, $passKey = null) {
        $index = "abcdefghijklmnopqrstuvwxyz.-ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        if ($passKey !== null) {
            /* Although this function's purpose is to just make the
             *         * ID short - and not so much secure,
             *                 * with this patch by Simon Franz (http://blog.snaky.org/)
             *                         * you can optionally supply a password to make it harder
             *                                 * to calculate the corresponding numeric ID */

            for ($n = 0; $n < strlen($index); $n++) {
                $i[] = substr($index, $n, 1);
            }

            $passhash = hash('sha256', $passKey);

            $passhash = (strlen($passhash) < strlen($index)) ? hash('sha512', $passKey) : $passhash;

            for ($n = 0; $n < strlen($index); $n++) {
                $p[] = substr($passhash, $n, 1);
            }

            array_multisort($p, SORT_DESC, $i);
            $index = implode($i);
        }

        $base = strlen($index);

        if ($to_num) {
            // Digital number  <<--  alphabet letter code
            $in = strrev($in);
            $out = 0;
            $len = strlen($in) - 1;

            for ($t = 0; $t <= $len; $t++) {
                $bcpow = bcpow($base, $len - $t);
                $out = $out + strpos($index, substr($in, $t, 1)) * $bcpow;
            }

            if (is_numeric($pad_up)) {
                $pad_up--;
                if ($pad_up > 0) {
                    $out -= pow($base, $pad_up);
                }
            }
            $out = sprintf('%F', $out);
            $out = substr($out, 0, strpos($out, '.'));
        } else {
            // Digital number  -->>  alphabet letter code
            if (is_numeric($pad_up)) {
                $pad_up--;
                if ($pad_up > 0) {
                    $in += pow($base, $pad_up);
                }
            }

            $out = "";
            for ($t = floor(log($in, $base)); $t >= 0; $t--) {
                $bcp = bcpow($base, $t);
                $a = floor($in / $bcp) % $base;
                $out = $out . substr($index, $a, 1);
                $in = $in - ($a * $bcp);
            }
            $out = strrev($out); // reverse
        }
        return $out;
    }

}
