<?php
class RitUniqueCode
{
    private $digits;
    private $uppdrcase;
    private $lowercase;
    private $character;
    private $excludeCharacters;
    private $maximumLimit;
    private $totalCharacter;
    private $codeLength;
    private $saparator;
    private $prefix;
    private $suffix;

    /**
     * uniquecode constructor.
     */
    public function __construct()
    {
        $this->digits = array('0','1','2','3','4','5','6','7','8','9');
        $this->uppdrcase = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $this->lowercase = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
        $this->character = array();
        $this->saparator = array();
        $this->prefix = '';
        $this->suffix = '';
        $this->codeLength = 8;
    }

    /**
     *
     */
    private function updateParams() {
        $this->character = array_diff(array_unique($this->character), str_split($this->excludeCharacters));
        sort($this->character);
        $this->totalCharacter = sizeof($this->character);
        $this->maximumLimit = bcpow((string)$this->totalCharacter, (string)$this->codeLength, 0);
    }

    /**
     *
     */
    public function pushDigits() {
        $this->character = array_merge($this->character, $this->digits);
        $this->updateParams();
    }

    /**
     *
     */
    public function pushUppercase() {
        $this->character = array_merge($this->character, $this->uppdrcase);
        $this->updateParams();
    }

    /**
     *
     */
    public function pushLowercase() {
        $this->character = array_merge($this->character, $this->lowercase);
        $this->updateParams();
    }

    /**
     * @param $extraCharacters
     */
    public function pushExtraCharacters($extraCharacters) {
        $this->character = array_merge($this->character, str_split($extraCharacters));
        $this->updateParams();
    }

    /**
     * @param $excludeCharacters
     */
    public function excludeCharacters($excludeCharacters) {
        $this->excludeCharacters = $excludeCharacters;
        $this->updateParams();
    }

    /**
     * @return mixed
     */
    public function getTotalCharacter() {
        return $this->totalCharacter;
    }

    /**
     * @return mixed
     */
    public function getMaximumLimit() {
        return $this->maximumLimit;
    }

    /**
     * @param $l
     */
    public function setCodeLength($l) {
        $this->codeLength = $l;
        $this->updateParams();
    }

    /**
     * @param $decVal
     * @return string
     * @throws Exception
     */
    private function decimalToCode($decVal) {
        if (bccomp($this->maximumLimit, "$decVal") == 1) {
            $result='';
            while ($this->totalCharacter) {
                $result = $result . $this->character[bcmod("$decVal", (string)$this->totalCharacter)];
                $decVal=bcdiv("$decVal", (string)$this->totalCharacter, 0);

                if (bccomp("$decVal", '0', 0)==0) {
                    for ($i = $this->codeLength-strlen($result); $i > 0; $i--) {
                        $result=$result . $this->character[0];
                    };
                    $result=strrev($result);
                    break;
                }
            }
            return $result;
        } else {
            throw new \Exception("Error: Decimal value $decVal limit $this->maximumLimit exceeded!");
        }
    }

    /**
     * @param $string
     */
    public function setPrefix($string) {
        $this->prefix = $string;
    }

    /**
     * @param $string
     */
    public function setSuffix($string) {
        $this->suffix = $string;
    }

    public function setSaparator($offset, $string) {
        $this->saparator[$offset] = $string;
        krsort($this->saparator);
    }

    /**
     * @param $decVal
     * @return string
     */
    public function codeCompose($decVal) {
        $compose = $this->decimalToCode($decVal);

        foreach ($this->saparator as $key=>$value) {
            $compose = substr_replace($compose, $value, $key, 0);
        }

        return $this->prefix . $compose . $this->suffix;
    }

    /**
     * @param $quantity
     * @param $startValue
     * @param $endValue
     * @param $code
     * @return array
     */
    private function codeReturnSchema($quantity, $startValue, $endValue, $code) {
        $saparator = array();
        foreach ($this->saparator as $key=>$value) {
            $saparator[] = array("offset"=>$key, "string"=>$value);
        }
        sort($saparator);
        return array(

            "codeLength"=>(string)$this->codeLength,
            "stringLength"=>(string)strlen($code[0]),
            "pssLength"=>(string)(strlen($code[0]) - $this->codeLength),
            "maximumLimit"=>(string)$this->maximumLimit,
            "startValue"=>(string)$startValue,
            "endValue"=>(string)$endValue,
            "totalCode"=>(string)$quantity,
            "totalCharacter"=>(string)$this->totalCharacter,
            "character"=>(array)$this->character,
            "prefix"=>(string)$this->prefix,
            "suffix"=>(string)$this->suffix,
            "saparator"=>(array)$saparator,
            "code"=>(array)$code
        );
    }

    /**
     * @param $quantity
     * @param bool $ordered
     * @param string $starter
     * @return array
     * @throws Exception
     */
    public function generateCode($quantity, $ordered = false, $starter = "-1") {
        if (bccomp("$quantity", $this->maximumLimit) == 1) {
            throw new \Exception("Error: Number of unique code quantity exceeds the maximum limit!");
        } elseif (bccomp("$starter", $this->maximumLimit) == 1) {
            throw new \Exception("Error: Unique code given starter value exceeds the maximum limit!");
        }

        $codes = array();

        if ($ordered == false and $starter == "-1" and bccomp($this->maximumLimit, bcmul("$quantity", "2", 0)) == 1) {
            $segments = 71; // Range btn 1 to 99
            $possible_number=bcsub($this->maximumLimit,'1');
            $devided_number = bcdiv($possible_number,$segments);
            $devided_number_const = $devided_number;
            $total_count=0;

            while (bccomp($devided_number,'0') >= 0) {
                $final_number = $devided_number;
                for ($dcr=$segments; $dcr-1>0; $dcr--) {  // Warning: $decr-1 eliminate the last segments result because of ugliness (It's safely possible if the number of possible code is 2 time grater then quantity)
                    $total_count++;

                    $codes[] = $this->codeCompose($final_number);

                    if ($total_count >= $quantity) {
                        break;
                    }

                    $final_number = bcadd($final_number,$devided_number_const);
                }
                if ($total_count >= $quantity) {
                    break;
                }
                $devided_number = bcsub($devided_number,1);
            }

            return $this->codeReturnSchema($quantity, "", "", $codes);
        } else {
            if (bccomp("0", "$starter") == 1) {
                $starter = bcsub(bcdiv($this->maximumLimit,"2"), bcdiv("$quantity", "2"));
            } elseif (bccomp("$starter", $this->maximumLimit) == 0) {
                $starter = "0";
            }

            $runner = $starter;

            for ($i=0; $i<$quantity; $i++) {
                $codes[] = $this->codeCompose($runner);

                $runner = bcadd($runner, "1");

                if (bccomp("$runner", $this->maximumLimit) == 0) {
                    $runner = "0";
                }
            }

            $runner = bcsub($runner, "1");

            if (!$ordered) {
                shuffle($codes);
            }

            return $this->codeReturnSchema($quantity, $starter, $runner, $codes);
        }
    }
}