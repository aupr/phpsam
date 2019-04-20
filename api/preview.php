<?php

httprestmethod::post(function ($req){
    //var_dump($req);
    // create object of ritUniqueCode
    $ritUniqueCode = new RitUniqueCode();

    // setup quantity of codes
    $codeQuantity = $req->numberOfCodePreview;
    if ($codeQuantity < 1000) $codeQuantity = 1000;
    if ($codeQuantity > 10000) $codeQuantity = 10000;

    // character setup
    $codeType = $req->codeData->codeType;
    $caseType = $req->codeData->caseType;
    if ($codeType == 'numeric') {
        $ritUniqueCode->pushDigits();
    }
    elseif($codeType == 'alphabetic'){
        if ($caseType == 'upper')
            $ritUniqueCode->pushUppercase();
        elseif ($caseType == 'lower')
            $ritUniqueCode->pushLowercase();
        elseif ($caseType == 'both') {
            $ritUniqueCode->pushUppercase();
            $ritUniqueCode->pushLowercase();
        }
    }
    elseif($codeType == 'alphanumeric'){
        $ritUniqueCode->pushDigits();
        if ($caseType == 'upper')
            $ritUniqueCode->pushUppercase();
        elseif ($caseType == 'lower')
            $ritUniqueCode->pushLowercase();
        elseif ($caseType == 'both') {
            $ritUniqueCode->pushUppercase();
            $ritUniqueCode->pushLowercase();
        }
    }

    // include exclude extra characters
    $ritUniqueCode->includeCharacters($req->codeData->includeChars);
    $ritUniqueCode->excludeCharacters($req->codeData->excludeChars);


    $ritUniqueCode->setCodeLength($req->codeData->codeLength);

    $ritUniqueCode->setPrefix($req->codeData->codePrefix);

    $ritUniqueCode->setSuffix($req->codeData->codeSuffix);

    // setup the separators
    $separators = $req->codeData->separator;
    foreach ($separators as $val){
        $ritUniqueCode->setSeparators($val->position, $val->symbol);
    }

    $output = $ritUniqueCode->generateCode($codeQuantity);
    $output['headerText'] = $req->codeData->headerText;
    $output['footerText'] = $req->codeData->footerText;

    // execution time calculation
    $output['execTime'] = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];

    return $output;
});

//echo '{"data": "hello! its from backend"}';