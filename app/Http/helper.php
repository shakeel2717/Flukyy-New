<?php
// Generating Random String

use App\Models\transaction;

function random($qtd)
{
    $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
    $QuantidadeCaracteres = strlen($Caracteres);
    $QuantidadeCaracteres--;
    $Hash = NULL;
    for ($x = 1; $x <= $qtd; $x++) {
        $Posicao = rand(0, $QuantidadeCaracteres);
        $Hash .= substr($Caracteres, $Posicao, 1);
    }
    return $Hash;
}

function balanceUSD()
{
    // gettin gall Balance In
    $queryIn = transaction::where('sum','In')->usdBalance()->sum('amount');
    $queryOut = transaction::where('sum','Out')->usdBalance()->sum('amount');
    return $queryIn - $queryOut;
}


function balanceReward()
{
    // gettin gall Balance In
    $queryIn = transaction::where('sum','In')->rewardBalance()->sum('amount');
    $queryOut = transaction::where('sum','Out')->rewardBalance()->sum('amount');
    return $queryIn - $queryOut;
}


function userTransactions()
{
    // gettin gall Balance In
    $queryIn = transaction::thisUser()->get();
    return $queryIn;
}


function balanceToken()
{
    // gettin gall Balance In
    $queryIn = transaction::where('sum','In')->tokenBalance()->sum('amount');
    $queryOut = transaction::where('sum','Out')->tokenBalance()->sum('amount');
    return $queryIn - $queryOut;
}
?>