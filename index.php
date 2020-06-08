<?php
include 'Orszag.php';

function beolvas(){
    $tomb=array();
    
    try {
        $file= fopen('EUcsatlakozas.txt', 'r');
        while(!feof($file)){
            $sor= fgetcsv($file, 50, ";");
//            print_r($sor);echo '<br>';
//                var_dump($sor[0]);echo '<br>';
                $o=new Orszag(
                        $sor[0], 
                        $sor[1]);//substr($sor[1],0, strlen($sor[1])-2));
                $tomb[]=$o;
        }
    } catch (Exception $exc) {
        die('Hiba a beolvasásnál. '.$exc);
    }
    return $tomb;
}

$a=beolvas();
$behuzas="&nbsp&nbsp&nbsp&nbsp&nbsp";
echo '3. feladat: EU tagállamainak száma: '.count($a).'db<br>';
$szamlalo=0;
$magyaro="";
$majus='Májusban nem volt csatlakozás.<br>';

foreach ($a as $item) {
    if(strpos($item->getEv(),"2007")!==false){
        $szamlalo++;
    }
    if(strpos($item->getOrszag(), 'Magyarország')!==false){
        $magyaro=$item->getEv();
    }
    if(strpos($item->getEv(), ".05.")!==false){
        $majus='Májusban  volt csatlakozás!<br>';
    }
}
echo '4. feladat: 2007-ben '.$szamlalo.' ország csatlakozott. <br>';
echo '5. feladat: Magyarország csatlakozásának dátuma: '.$magyaro.'<br>';
echo '6. feladat: '.$majus;
$stat=array();
foreach ($a as $item) {
    $date[$item->getOrszag()]= date_create_from_format('Y.m.j',$item->getEv());
    $stat[]= substr($item->getEv(),0,4);
}
arsort($date);
echo '7. feladat: Legutoljára csatlakozott ország: '.key($date).'<br>';

$stat=array_count_values($stat);
foreach ($stat as $key=>$value) {
    echo $behuzas.$key.' - '.$value.' ország <br>';
}
