<?php
class Message
{
    private $code;
    private $description;
    private $duree;
    private $annonceur;
    private $lesDiffusions = array();
    public function __construct($code, $description, $duree, $annonceur)
    {
        $this->code = $code;
        $this->description = $description;
        $this->duree = $duree;
        $this->annonceur = $annonceur;
    }
    public function ajouterUneDiffusion($uneDiffusion)
    {
        $this->lesDiffusions[] = $uneDiffusion;
    }
    public function toXML()
    {
        $xml = simplexml_load_string('<message/>'); //objet simpleXML
        $xml->addChild('code', $this->code);
        $xml->addChild('description', $this->description);
        $xml->addChild('duree', $this->duree);
        return $xml;
    }
}
class Diffusion
{
    private $date;
    private $tranche;
    public function __construct($date, $tranche)
    {
        $this->date = $date;
        $this->tranche = $tranche;
    }
}

//main test
//message1, avec 2 diffusions a l'antenne
$m1 = new Message('fr4312', 'spot employe CID', 32, 'Banque CID');
$d1 = new Diffusion('23/4/2006', 'matin');
$d2 = new Diffusion('23/4/2006', 'soir');
$m1->ajouterUneDiffusion($d1);
$m1->ajouterUneDiffusion($d2);
//message2, avec aucune diffusion a l'antenne
$m2 = new Message('fr4313', 'spot compte jeune', 40, 'Banque CID');
header('Content-Type:application/xml');
echo $m1->toXML()->asXML();//message1 deja diffusé
//echo $m2->toXML()->asXML();//message2 jamais diffusé