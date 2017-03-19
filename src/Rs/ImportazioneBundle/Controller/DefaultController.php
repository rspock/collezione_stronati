<?php

namespace Rs\ImportazioneBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Rs\CollezioneStronatiBundle\Entity\Bicchiere;
use Rs\CollezioneStronatiBundle\Entity\Foto;
use Rs\CollezioneStronatiBundle\Entity\Mignon;
use Rs\CollezioneStronatiBundle\Entity\Produttore;
use Rs\CollezioneStronatiBundle\Entity\Profumo;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Rs\ImportazioneBundle\Entity\OldProfumo;
use Rs\ImportazioneBundle\Entity\OldMignon;
use Rs\ImportazioneBundle\Entity\OldBicchiere;



class DefaultController extends Controller
{

    private $repoProduttore;
    private $bicchieriFilePath = "./immagini_bicchieri/";
    private $mignonFilePath = "./immagini_mignon/";
    private $profumiFilePath = "./immagini_profumi/";
    private $emDefault;
    private $errori = array();
    private $defaultImage;
    private $defaultImageSize;

    public function __construct(){
        $filename = "./bundles/collezionestronati/img/divieto.png";
        $handle = fopen($filename, "r");
        $defaultImageSize = filesize($filename);
        $this->defaultImage = fread($handle, $defaultImageSize);
        fclose($handle);
    }

    /**
     * @Route("/bicchiere/{numeroElementi}",defaults={"numeroElementi" = 100}, name="importazione_bicchieri")
     * @Method("GET")
     * @Template()
     */
    public function importaBicchieriAction($numeroElementi)
    {
        $this->repoProduttore = $this->get('doctrine')->getRepository('RsCollezioneStronatiBundle:Produttore', 'default');
        $this->emDefault = $this->getDoctrine()->getEntityManager("default");
        $emOldBicchieri = $this->getDoctrine()->getEntityManager("old_dati");

        $repoOldBicchieri = $this->get('doctrine')->getRepository('RsImportazioneBundle:OldBicchiere', 'old_dati');

        $i=0;
        $elementi = $repoOldBicchieri->findAllLimitato($numeroElementi);
        foreach( $elementi as $oldBicchiere){
            $emOldBicchieri->beginTransaction();
            try{
                $this->persistiNuovoBicchiere($oldBicchiere);
                $emOldBicchieri->remove($oldBicchiere);
                $emOldBicchieri->flush();
                $emOldBicchieri->commit();
                $i++;
            }catch (\Exception $e){
                $emOldBicchieri->rollback();
                throw $e;
            }
        }
        $risultati = "Importati: ".$i." bicchieri";
        return array("errori" => $this->errori,"risultato"=>$risultati);
    }

    private function persistiNuovoBicchiere($oldBicchiere){

        $nomeProduttore = \strtoupper (\trim($oldBicchiere->getDitta()));
        $produttoreBicchiere = $this->repoProduttore->findOneBy(array("nome"=> $nomeProduttore));

        $bicchiere = new Bicchiere();
        $bicchiere->setProduttore($produttoreBicchiere);
        $bicchiere->setAltezza($oldBicchiere->getAltezza());
        $bicchiere->setDescrizione($oldBicchiere->getDitta());
        $bicchiere->setLiquore($oldBicchiere->getLiquore());

        $contents=null;
        $dimensioni = null;
        try{
            $filename = $this->bicchieriFilePath . $this->getObjectFileName($oldBicchiere->getFoto());
            if(!\file_exists($filename)){
                $filename = $this->bicchieriFilePath . $oldBicchiere->getFoto();
                if(!\file_exists($filename)){
                    throw new \Exception();
                }
            }
            $handle = fopen($filename, "r");
            if($handle === false){
                throw new \Exception();
            }
            try{
                $dimensioni = filesize($filename);
            }catch (\Exception $ex){
                $dimensioni=0;
            }
            $contents = fread($handle,$dimensioni);
            fclose($handle);
        }catch (\Exception $efile){
            $this->errori[] = 'Errore apertura file: '. $this->getObjectFileName($oldBicchiere->getFoto()) . " oggetto ".$oldBicchiere->getFoto() . " codice ". $oldBicchiere->getCodice();
            $contents=$this->defaultImage;
            $dimensioni = $this->defaultImageSize;
        }

        $foto = new Foto();
        $foto->setNome($oldBicchiere->getFoto());
        $foto->setContenuto($contents);
        $foto->setDimensioni($dimensioni != null ? $dimensioni : 0 );
        $foto->setMime("image/jpg");
        $foto->setOggetto($bicchiere);
        $this->emDefault->persist($foto);
        $acFoto = new ArrayCollection();
        $acFoto->add($foto);
        $bicchiere->setFoto($acFoto);

        $this->emDefault->persist($bicchiere);
        $this->emDefault->flush();
        $this->emDefault->clear();
    }



    /**
     * @Route("/profumo/{numeroElementi}", defaults={"numeroElementi" = 100},name="importazione_profumi")
     * @Method("GET")
     * @Template()
     */
    public function importaProfumiAction($numeroElementi)
    {
        $this->repoProduttore = $this->get('doctrine')->getRepository('RsCollezioneStronatiBundle:Produttore', 'default');
        $this->emDefault = $this->getDoctrine()->getEntityManager("default");
        $emOldProfumi = $this->getDoctrine()->getEntityManager("old_dati");

        $repoOldProfumi = $this->get('doctrine')->getRepository('RsImportazioneBundle:OldProfumo', 'old_dati');
        $repoBicchieri = $this->get('doctrine')->getRepository('RsCollezioneStronatiBundle:Profumo', 'default');

        $i=0;
        $logger = $this->get('logger');
        $elementi = $repoOldProfumi->findAllLimitato($numeroElementi);
        foreach($elementi as $oldProfumo){
            $emOldProfumi->beginTransaction();
            try{
                $logger->info("Importo profumo: ".$oldProfumo->getCodice());
                $this->persistiNuovoProfumo($oldProfumo);
                $emOldProfumi->remove($oldProfumo);
                $emOldProfumi->flush();
                $emOldProfumi->commit();
                $i++;
            }catch (\Exception $e){
                $emOldProfumi->rollback();
                $logger->error($e->getTrace());
                throw $e;
            }
        }
        $risultati = "Importati: ".$i." profumi";
        return array("errori" => $this->errori,"risultato"=>$risultati);
    }

    private function persistiNuovoProfumo(OldProfumo $oldProfumo){

        $nomeProduttore = \strtoupper (\trim($oldProfumo->getProduttore()));
        $produttoreProfumo = $this->repoProduttore->findOneBy(array("nome"=> $nomeProduttore));

        $profumo = new Profumo();
        $acFoto = new ArrayCollection();


        $profumo->setContenuto($oldProfumo->getContenuto());
        if($oldProfumo->getScatola() == "Si" || $oldProfumo->getScatola() == "si" || $oldProfumo->getScatola() == "SI"){
            $profumo->setScatola(true);
        }else{
            $profumo->setScatola(false);
        }

        $profumo->setNote($oldProfumo->getNome());
        $profumo->setLocalita($oldProfumo->getLocalita());
        $profumo->setProduttore($produttoreProfumo);
        $profumo->setAltezza($oldProfumo->getAltezza());
        $profumo->setDescrizione($oldProfumo->getDescrizione());

        $contents=null;
        $dimensioni = null;

        $contentsRetro=null;
        $dimensioniRetro = null;
        try{
            $filename = $this->profumiFilePath . $this->getObjectFileName($oldProfumo->getFoto());
            if(!\file_exists($filename)){
                $filename = $this->profumiFilePath . $oldProfumo->getFoto();
                if(!\file_exists($filename)){
                    throw new \Exception();
                }
            }
            $handle = fopen($filename, "r");
            if($handle === false){
                throw new \Exception();
            }
            try{
                $dimensioni = filesize($filename);
            }catch (\Exception $ex){
                $dimensioni=0;
            }
            $contents = fread($handle,$dimensioni);
            fclose($handle);
        }catch (\Exception $efile){
            $this->errori[] = 'Errore apertura file: '. $this->getObjectFileName($oldProfumo->getFoto()) . " oggetto ".$oldProfumo->getFoto() . " codice ". $oldProfumo->getCodice();
            $contents=$this->defaultImage;
            $dimensioni = $this->defaultImageSize;
        }

        $foto = new Foto();
        $foto->setNome($oldProfumo->getFoto());
        $foto->setContenuto($contents);
        $foto->setDimensioni($dimensioni != null ? $dimensioni : 0 );
        $foto->setMime("image/jpg");
        $foto->setOggetto($profumo);
        $this->emDefault->persist($foto);

        $acFoto->add($foto);

        if($oldProfumo->getFotoRetro() != "none"){
            try{
                $filenameRetro = $this->profumiFilePath . $oldProfumo->getCodice()."_retro.jpg";
                $handleRetro = fopen($filenameRetro, "r");
                if($handleRetro === false){
                    throw new \Exception();
                }
                try{
                    $dimensioniRetro = filesize($filenameRetro);
                }catch (\Exception $ex){
                    $dimensioniRetro=0;
                }
                $contentsRetro = fread($handleRetro,$dimensioniRetro);
                fclose($handleRetro);
            }catch (\Exception $efile){
                $this->errori[] = 'Errore apertura file: '. $oldProfumo->getCodice()."_retro.jpg";
                $contentsRetro=$this->defaultImage;
                $dimensioniRetro = $this->defaultImageSize;
            }

            $fotoRetro = new Foto();
            $fotoRetro->setNome($oldProfumo->getFotoRetro());
            $fotoRetro->setContenuto($contentsRetro);
            $fotoRetro->setDimensioni($dimensioniRetro != null ? $dimensioniRetro : 0 );
            $fotoRetro->setMime("image/jpg");
            $fotoRetro->setOggetto($profumo);
            $this->emDefault->persist($foto);

            $acFoto->add($fotoRetro);

        }

        $profumo->setFoto($acFoto);

        $this->emDefault->persist($profumo);
        $this->emDefault->flush();
        $this->emDefault->clear();
    }

    /**
     * @Route("/mignon/{numeroElementi}",defaults={"numeroElementi" = 100}, name="importazione_mignon")
     * @Method("GET")
     * @Template()
     */
    public function importaMignonAction($numeroElementi)
    {
        $this->repoProduttore = $this->get('doctrine')->getRepository('RsCollezioneStronatiBundle:Produttore', 'default');
        $this->emDefault = $this->getDoctrine()->getEntityManager("default");
        $emOldMignon = $this->getDoctrine()->getEntityManager("old_dati");

        $repoOldMignon = $this->get('doctrine')->getRepository('RsImportazioneBundle:OldMignon', 'old_dati');
        $repoMignon = $this->get('doctrine')->getRepository('RsCollezioneStronatiBundle:Mignon', 'default');

        $i=0;
        foreach($repoOldMignon->findAllLimitato($numeroElementi) as $oldMignon){
            $emOldMignon->beginTransaction();
            try{
                $this->persistiNuovoMignon($oldMignon);
                $emOldMignon->remove($oldMignon);
                $emOldMignon->flush();
                $emOldMignon->commit();
                $i++;
            }catch (\Exception $e){
                $emOldMignon->rollback();
                throw $e;
            }
        }
        $risultati = "Importati: ".$i." mignon";
        return array("errori" => $this->errori,"risultato"=>$risultati);
    }

    private function persistiNuovoMignon(OldMignon $oldMignon){

        $nomeProduttore = \strtoupper (\trim($oldMignon->getProduttore()));
        $produttoreMignon = $this->repoProduttore->findOneBy(array("nome"=> $nomeProduttore));

        $mignon = new Mignon();
        $acFoto = new ArrayCollection();


        $mignon->setContenuto($oldMignon->getContenuto());
        if($oldMignon->getSigillo() == "Si" || $oldMignon->getSigillo() == "si" || $oldMignon->getSigillo() == "SI"){
            $mignon->setSigillo(true);
        }else{
            $mignon->setSigillo(false);
        }

        $mignon->setLocalita($oldMignon->getLocalita());
        $mignon->setProduttore($produttoreMignon);
        $mignon->setAltezza($oldMignon->getAltezza());
        $mignon->setDescrizione($oldMignon->getDescrizione());

        $contents=null;
        $dimensioni = null;

        $contentsRetro=null;
        $dimensioniRetro = null;
        try{
            $filename = $this->mignonFilePath . $this->getObjectFileName($oldMignon->getFoto());
            if(!\file_exists($filename)){
                $filename = $this->mignonFilePath . $oldMignon->getFoto();
                if(!\file_exists($filename)){
                    throw new \Exception();
                }
            }
            $handle = fopen($filename, "r");
            if($handle === false){
                throw new \Exception();
            }
            try{
                $dimensioni = filesize($filename);
            }catch (\Exception $ex){
                $dimensioni=0;
            }
            $contents = fread($handle,$dimensioni);
            fclose($handle);
        }catch (\Exception $efile){
            $this->errori[] = 'Errore apertura file: '. $this->getObjectFileName($oldMignon->getFoto()) . " oggetto ".$oldMignon->getFoto() . " codice ". $oldMignon->getCodice();
            $contents=$this->defaultImage;
            $dimensioni = $this->defaultImageSize;
        }

        $foto = new Foto();
        $foto->setNome($oldMignon->getFoto());
        $foto->setContenuto($contents);
        $foto->setDimensioni($dimensioni != null ? $dimensioni : 0 );
        $foto->setMime("image/jpg");
        $foto->setOggetto($mignon);
        $this->emDefault->persist($foto);

        $acFoto->add($foto);

        if($oldMignon->getFotoRetro() != "none"){
            try{
                $filenameRetro = $this->mignonFilePath . $oldMignon->getCodice()."_retro.jpg";
                $handleRetro = fopen($filenameRetro, "r");
                if($handleRetro === false){
                    throw new \Exception();
                }
                try{
                    $dimensioniRetro = filesize($filenameRetro);
                }catch (\Exception $ex){
                    $dimensioniRetro=0;
                }
                $contentsRetro = fread($handleRetro,$dimensioniRetro);
                fclose($handleRetro);
            }catch (\Exception $efile){
                $this->errori[] = 'Errore apertura file: '. $oldMignon->getCodice()."_retro.jpg";
                $contentsRetro=$this->defaultImage;
                $dimensioniRetro = $this->defaultImageSize;
            }

            $fotoRetro = new Foto();
            $fotoRetro->setNome($oldMignon->getFotoRetro());
            $fotoRetro->setContenuto($contentsRetro);
            $fotoRetro->setDimensioni($dimensioniRetro != null ? $dimensioniRetro : 0 );
            $fotoRetro->setMime("image/jpg");
            $fotoRetro->setOggetto($mignon);
            $this->emDefault->persist($foto);

            $acFoto->add($fotoRetro);

        }

        $mignon->setFoto($acFoto);

        $this->emDefault->persist($mignon);
        $this->emDefault->flush();
        $this->emDefault->clear();
    }

    /**
     * @Route("/produttori", name="importazione_produttori")
     * @Method("GET")
     * @Template()
     */
    public function persistiProduttoriAction(){

        $this->repoProduttore = $this->get('doctrine')->getRepository('RsCollezioneStronatiBundle:Produttore', 'default');
        $this->emDefault = $this->getDoctrine()->getEntityManager("default");

        $this->persistiProduttoriBicchieri();
        $this->persistiProduttoriMignon();
        $this->persistiProduttoriProfumi();

        return new Response("Ok", 200);
    }

    private function persistiProduttoriBicchieri(){

        $repoOldBicchieri = $this->get('doctrine')->getRepository('RsImportazioneBundle:OldBicchiere', 'old_dati');

        $prooduttori =$repoOldBicchieri->getProduttoriDistinct();

        foreach($prooduttori as $key => $prooduttore){
            $nome = \strtoupper (\trim($prooduttore['ditta']));
            if($this->repoProduttore->findBy(array("nome"=>$nome)) == null ){
                $nuovoProd = new Produttore();
                $nuovoProd->setNome($nome);
                $this->emDefault->persist($nuovoProd);
                $this->emDefault->flush();
                $this->emDefault->clear();
            }
        }
    }

    private function persistiProduttoriProfumi(){

        $repoOldProfumi = $this->get('doctrine')->getRepository('RsImportazioneBundle:OldProfumo', 'old_dati');

        $prooduttori =$repoOldProfumi->getProduttoriDistinct();

        foreach($prooduttori as $key => $prooduttore){
            $nome = \strtoupper (\trim($prooduttore['produttore']));
            if($this->repoProduttore->findBy(array("nome"=>$nome)) == null ){
                $nuovoProd = new Produttore();
                $nuovoProd->setNome($nome);
                $this->emDefault->persist($nuovoProd);
                $this->emDefault->flush();
                $this->emDefault->clear();
            }
        }
    }

    private function persistiProduttoriMignon(){

        $repoOldMignon = $this->get('doctrine')->getRepository('RsImportazioneBundle:OldMignon', 'old_dati');

        $prooduttori =$repoOldMignon->getProduttoriDistinct();

        foreach($prooduttori as $key => $prooduttore){
            $nome = \strtoupper (\trim($prooduttore['produttore']));
            if($this->repoProduttore->findBy(array("nome"=>$nome)) == null ){
                $nuovoProd = new Produttore();
                $nuovoProd->setNome($nome);
                $this->emDefault->persist($nuovoProd);
                $this->emDefault->flush();
                $this->emDefault->clear();
            }
        }
    }

    private function getObjectFileName($originalFileName){
        $splitName =  explode("_",$originalFileName);
        $id = str_replace("_", "", $splitName[0]);
        if(\is_numeric($id)){
            return $id.".jpg";
        }else{
            return $originalFileName;
        }
    }
}
