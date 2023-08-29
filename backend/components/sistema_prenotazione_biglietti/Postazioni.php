<?php
namespace backend\components\sistema_prenotazione_biglietti;

/**
 * Gestisce la piantina di un teatro permettendo le seguenti azioni:
 * - Prenotazione
 * - Cancellazione di una prenotazione
 * - Visualizzazione dei dati delle prenotazioni
 */
class Postazioni{
    private $posti;
    private $conn;
    private const TIPO_SEDUTA_DEFAULT = "poltrona";
    public static $result_update_piantina = null;
    
    
    /***=========================================
     * Colori
    *==========================================*/
    //Posti liberi
    public const COLOR_FREE    = "darkgreen";
    //Posto prenotato
    public const COLOR_BOOKED  = "grey";
    //Posto occupato
    public const COLOR_PAYED   = "darkred";
    //Colore per gli accrediti
    public const COLOR_CREDIT  = "violet";
    
    /**==========================================
     * Stati pagamento
    *==========================================*/
    private const STATO_PAYED       = 10;
    private const STATO_NOT_PAYED   = 0;
    private const STATO_CREDIT      = 11;
    
    /**==========================================
     * Dati per il database
    *==========================================*/
    /**
     * Tabella contenente le piantine per il database
     */
    private const DB_TABLE_PIANTINA = "ilt_teatro_piantina";
    /**
     * Tabella contenente gli spettacoli
     */
    private const DB_TABLE_SPETTACOLO = "ilt_teatro_spettacolo";
    /**
     * Tabella per le prenotazioni
     */
    private const DB_TABLE_PRENOTAZIONE = "teatro_prenotazione";


    /**
     * 
     * @param array $posti
     * @param mysqli $conn Connessione a mysql
     */
    public function __construct($posti, $conn = null) {
        $this->posti = $posti;
        $this->conn  = $conn;
    }
    
    /**
     * Restituisce la mappa
     */
    public function get() {
        echo '<svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">';
            foreach($this->posti as $k_posto => $v_posto) : 
                foreach($v_posto as $k_fila => $v_fila) : 
                    if($k_fila === "file"){
                        $this->getPlatea ($v_fila, $k_posto);
                    }else{
                        $this->getPalchi($v_fila, $k_posto);
                    }       
                endforeach;
            endforeach;
        echo '</svg>';
    }
    
    /**
     * Visualizza i palchi
     * 
     * @param array $p Palchi
     * @param tring $o Nome del posto
     */
    private function getPalchi($p, $o){
        foreach ($p as $k => $palco){
                                
            foreach ($palco as $k2 => $fila){
                    foreach ($fila as $k3 => $posto){
                        if(is_object($posto)){
                            foreach ($posto as $k4 => $config){
                                foreach ($config as $k5 => $v){
                                    $x = $v->x;
                                    $y = $v->y;
                                    $tipo_seduta = $v->tipo_seduta ?? self::TIPO_SEDUTA_DEFAULT;
                                    $visibilita = (isset($v->visibilita_ridotta) && $v->visibilita_ridotta ) ? "si" : "no";
                                    $color = self::COLOR_FREE;
                                    $class = "seat";
                                    if(isset($v->stato)){
                                        switch ($v->stato){
                                            case self::STATO_PAYED:
                                               $color = self::COLOR_PAYED;
                                                $class .= " busy";
                                               break;
                                            case self::STATO_CREDIT:
                                                $color = self::COLOR_CREDIT;
                                                $class .= " busy";
                                                break;
                                            case self::STATO_NOT_PAYED:
                                                $color = self::COLOR_BOOKED;
                                                break;
                                        }
                                    }
                                    //echo str_replace("_", " ", $o);
                                    echo '<circle class="'.$class.'" '
                                            . 'data-tooltip="Fila <strong>'.$k3.'</strong><br />Posto: <strong>'.$k5.'</strong><br />Tipo seduta: <strong>'.$tipo_seduta.'</strong><br />Visibilità ridotta: <strong>'.$visibilita.'</strong>" '
                                            . 'title="" '
                                            . 'data-nome="'. (str_replace("_", " ", $o)).'" '
                                            . 'data-palco='.$k.' '
                                            . 'data-fila="'.$k3.'" '
                                            . 'data-posto="'.$k5.'" '
                                            . 'cx="'.$x.'" '
                                            . 'cy="'.$y.'" '
                                            . 'r="3" '
                                            . 'stroke="'.$color.'" '
                                            . 'stroke-width="4" '
                                            . 'fill="'.$color.'" />';
                                }
                            }
                        }else{
                            if(isset($fila->non_numerato) && $fila->non_numerato){
                                $posti_liberi   = $fila->posti_totali-$fila->posti_prenotati;
                                $class = "seat nn";
                                $color          = "";
                                $postiTotali    = $fila->posti_totali;
                                $postiPagati    = $fila->posti_pagati;
                                $postiPrenotati = $fila->posti_prenotati;
                                
                                //if(isset($fila->posti_pagati)){
                                if($postiTotali === $postiPagati){
                                    $color = self::COLOR_PAYED;
                                }else if($posti_liberi===0){
                                    $color = self::COLOR_BOOKED;
                                }else{
                                    $color = self::COLOR_FREE;
                                }
                                
                                echo '<rect x="425" '
                                    . 'width="150" '
                                    . 'height="40" '
                                    . 'rx="10" '
                                    . 'y="95" '
                                    . 'title="" '
                                    . 'stroke="'.$color.'" '
                                    . 'fill="'.$color.'" '
                                    . 'class="seat nn" '
                                    . 'data-fila="'.$k3.'" '
                                    . 'data-posto="'.$k5.'" '
                                    . 'data-nome="'.str_replace("_", " ", $o).'" '
                                    . 'data-posti-totali="'.$postiTotali.'" '
                                    . 'data-posti-pagati="'.$postiPagati.'" '
                                    . 'data-posti-prenotati="'.$postiPrenotati.'" '
                                    . 'data-tooltip="Palco non numerato. I posti non sono assegnati" '
                                    . 'data-nome="'. (str_replace("_", " ", $o)).'" '
                                    . 'data-palco="'.$k.'" />';
                            }
                            break;
                        }
                    }
            }
        }
    }
    
    /**
     * Restituisce la platea
     * 
     * @param array $p Dati della platea
     */
    private function getPlatea($p, $nome){
        //Ciclo sulle file
        
            foreach($p as $k_fila2 => $v_fila2) : 
                //Ciclo posti 
                foreach($v_fila2 as $k_pos => $v_pos) : 
                    //Ciclo sulle posizioni 
                        foreach($v_pos as $k_posizione => $v_posizione) : 
                           $x = $v_posizione->x;
                           $y = $v_posizione->y;
                           $tipo_seduta = $v_posizione->tipo_seduta ?? self::TIPO_SEDUTA_DEFAULT;
                           $color = self::COLOR_FREE;
                           $class = "seat";
                           if(isset($v_posizione->stato)){
                               switch ($v_posizione->stato){
                                    case self::STATO_PAYED:
                                       $color = self::COLOR_PAYED;
                                        $class .= " busy";
                                       break;
                                    case self::STATO_CREDIT:
                                        $color = self::COLOR_CREDIT;
                                        $class .= " busy";
                                        break;
                                    case self::STATO_NOT_PAYED:
                                        $class .= " busy";
                                        $color = self::COLOR_BOOKED;
                                        break;
                               }
                           }
                           echo '<circle class="'.$class.'" '
                                   . 'data-tooltip="Fila: <strong>'.$k_fila2.'</strong><br /> Posto: <strong>'.$k_posizione.'</strong><br />Tipo seduta: <strong>'.$tipo_seduta.'</strong>" '
                                   . 'title="" '
                                   //Informazioni sul posto
                                   . 'data-nome="'.$nome.'" '
                                   . 'data-fila="'.$k_fila2.'" '
                                   . 'data-posto="'.$k_posizione.'" '
                                   . 'cx="'.$x.'" '
                                   . 'cy="'.$y.'" '
                                   . 'r="3" '
                                   . 'stroke="'. $color.'" '
                                   . 'stroke-width="4" '
                                   . 'fill="'.$color.'" />';
                        endforeach; 
                    //Fine ciclo posizioni 
                endforeach; 
                //Fine ciclo posti 
            endforeach;
        //Fine ciclo delle file 
    }
    
    /**
    * Salvataggio dei posti prenotati dagli utenti
    * e salva i dati dell'utente che ha prenotato
    * 
    * @param array $prenotazione_posti Array dei posti prenotati
    * @param array $dati Dati dell'utente che sta prenotando
    * @param int $id_spettacolo ID dello spettacolo da prenotare
    */
    public function prenotazione($prenotazione_posti, $prenotazione_esistente, $dati, $id_spettacolo) {
        /*$prenotazione_posti = $_POST['prenotazione'];
        $dati = $_POST['dati'];
        $id_spettacolo = $dati['spettacolo_id'];*/
        $conteggio_prenotazione_utente_non_numerato = 0;

        //costruisco il json per la prenotazione dell'utente
        //e modifico la piantina
        $prenotazione_posti_utente = [];
        foreach($prenotazione_posti as $k_pp => $v_pp){
            $prenotazione_posti_utente[$k_pp] = [];

            if(isset($this->posti->$k_pp->file)){//Se ha solo file

                foreach ($v_pp['fila'] as $k_fila => $v_fila){

                    $posto = $v_pp['posto'][$k_fila];
                    $this->posti->$k_pp->file->$v_fila->posti->$posto->stato = 0;

                    //dati prenotazione utente
                    $prenotazione_posti_utente[$k_pp]['file'][$v_fila]['posti'][] = $posto;
                }
            }else if(isset($this->posti->$k_pp->palco)){//se ci sono dei palchi
                foreach ($v_pp['palco'] as $k_palco => $v_palco){
                    $fila = $v_pp['fila'][$k_palco];
                    if($fila == "non_numerato"){                        
                        $this->posti->$k_pp->palco->$v_palco[0]->posti_prenotati += 1;
                        $conteggio_prenotazione_utente_non_numerato += 1;
                        
                        $prenotazione_posti_utente[$k_pp]['palco'][$v_palco]['non_numerato'] = $conteggio_prenotazione_utente_non_numerato;
                        
                    }else{
                        $posto = $v_pp['posto'][$k_palco];
                        $this->posti->$k_pp->palco->$v_palco->fila->$fila->posti->$posto->stato = 0;

                        //dati prenotazione utente
                        $prenotazione_posti_utente[$k_pp]['palco'][$v_palco]['fila'][$fila]['posti'][] = $posto;
                    }
                }

            }
        }
        
        
        $prenotazione_posti_utente = !is_null($prenotazione_esistente)?json_encode(array_merge_recursive($prenotazione_esistente, $prenotazione_posti_utente)): json_encode($prenotazione_posti_utente);
        
        
        //$prenotazione_posti_utente = json_encode($prenotazione_posti);//Verificare questo errore e sistemare di conseguenza la lettura e il resto
        $piantina_json      = json_encode($this->posti);
        
        $tbl_teatro_spettacolo = self::DB_TABLE_SPETTACOLO;
        $tbl_prenotazione      = self::DB_TABLE_PRENOTAZIONE;
        
        return [
            'piantina'                  => $piantina_json,
            'prenotazione_posti_utente' => $prenotazione_posti_utente
        ];
    }
    
    
    /**
     * Restituisce la piantina di un dato spettacolo
     * 
     * @param int $spettacolo_id Codice dello spettacolo
     */
    public function getPiantinaSpettacolo($spettacolo_id){
        return $this->getSpettacolo($spettacolo_id)->piantina;
    }
    
    
    
    /**
     * Verifica se lo stato è valido
     * 
     * @param string|int $stato
     * @return boolean
     */
    private function controllaStato(string|int $stato) {
        switch ($stato){
            case self::STATO_CREDIT:
            case self::STATO_NOT_PAYED:
            case self::STATO_PAYED:
                return true;
        }
        
        return false;
        
    }
    
    /**
     * Converte le prenotazioni da JSON ad ARRAY
     * 
     * @param string $prenotazione JSON della prenotazione
     * @param int $id_prenotazione Codice della prenotazione
     * @param array $old Contiene le informazioni su altre prenotazioni dello
     *                   stesso utente
     * @return array Prenotazioni decodificate
     */
    private function decodePrenotazione($prenotazione, $id_prenotazione, $old){
        $out = array();
        
        $decode = json_decode($prenotazione);
        
        foreach ($decode as $k => $v){
            $n = $k;

            if($n === "platea"){
                //$i = 0;
                $out[$n] = $old[$n]??[];

                foreach ($v->file as $k_fila => $v_fila){

                    foreach ($v_fila->posti as $k_posto => $v_posto){
                        $out[$n][$k_fila][] = $v_posto;

                        sort($out[$n][$k_fila]);
                    }


                }

                ksort($out[$n]);

            }else{
                $out[$n] = $old[$n]??[];

                foreach ($v->palco as $k_palco => $v_palco){
                    if(isset($v_palco->fila)){
                        foreach ($v_palco->fila as $k_fila => $v_fila){
                            foreach ($v_fila->posti as $k_posto => $v_posto){
                                $out[$n][$k_palco][$k_fila][] = $v_posto;

                                if(isset($out[$n][$k_palco][$k_fila]) && !is_null($out[$n][$k_palco][$k_fila])){
                                    $out[$n][$k_palco][$k_fila] = array_unique($out[$n][$k_palco][$k_fila]);
                                }

                                //Ordino i posti
                                asort($out[$n][$k_palco][$k_fila]);
                            }


                            //Ordino i palchi
                            ksort($out);
                            //Ordino le file
                            ksort($out[$n][$k_palco]);
                        }
                    } else if(isset ($v_palco->non_numerato)){
                        $out[$n][$k_palco]['non_numerato'] = $v_palco->non_numerato;
                    }
                }
            }
        }
        
        return $out;
    }
    
    /**
     * Aggiorna la piantina rimuovendo le prenotazioni selezionate.
     * 
     * @param array $prenotazione
     * @param array $piantina
     * @return boolean|array Restituisce false se la prenotazione non è corretta.
     *                       Restituisce l'array della piantina modificata,
     *                          se i dati della prenotazione passati sono corretti.
     */
    public static function updatePiantina(array $prenotazione, array $piantina){
        /*echo "<pre>";
        print_r($prenotazione);
        echo "</pre>";*/
        
        //non è una prenotazione valida
        if(!is_array($prenotazione)){return false;}
        
        foreach ($piantina as $k_piantina => $v_piantina){
            if(strtolower($k_piantina) === "platea"){
                $piantina = self::updatePrenotazionePlatea($v_piantina, $prenotazione, $piantina);
            }
        }
        
        
        /*echo "<pre>";
        print_r($piantina);
        echo "</pre>";*/
        
        return $piantina;
    }
    
    /**
     * Aggiorna la piantina delle prenotazioni per la platea
     * 
     * @param array $platea          Dati della platea
     * @param array $prenotazione    Dati della prenotazione
     * @param array $piantina        Piantina da aggiornare
     * @return array Piantina aggiornata
     */
    private static function updatePrenotazionePlatea(array $platea, array $prenotazione, array $piantina){
        foreach($platea['file'] as $fila => $a_posti_fila){
            $piantina = self::updatePosti($a_posti_fila, $fila, $prenotazione, $piantina);
        }
        
        return $piantina;
    }
    
    /**
     * Aggiorna i posti
     * 
     * @param array $posti           Array dei posti
     * @param string|int $fila       Fila a cui si riferiscono i posti
     * @param array $prenotazione    Dati della prenotazione
     * @param array $piantina        Piantina da aggiornare
     * @return array Piantina aggiornata
     */
    private static function updatePosti(array $posti, $fila, array $prenotazione, array $piantina){
        foreach ($posti['posti'] as $posto => $dati_posto){
            if(isset($dati_posto['stato'])){
                $piantina = self::deleteStato($prenotazione, $fila, $posto, $piantina);
            }
        }
        
        return $piantina;
    }
    
    /**
     * Cancella lo stato per le prenotazioni cancellate.
     * Viene ripristinata la piantina liberando i posti.
     * 
     * @param array $prenotazione    Dati della prenotazione
     * @param string|int $fila       Fila a cui si riferiscono i posti
     * @param int $posto             Posto della fila
     * @param array $piantina        Dati della prenotazione
     * @param string $tipo           Indica il tipo della piantina (platea, I Ordine, ecc.)
     * @return type
     */
    private static function deleteStato(array $prenotazione, $fila, $posto, array $piantina, string $tipo = "platea"){
        //Salvo gli stati dei posti prenotati
        $stati_posti_prenotati = [];
        echo "STATO";
        echo "<pre>";
        print_r($prenotazione);
        echo "</pre>";
        
        if(isset($prenotazione[$tipo]['file'][$fila]['posti'])){
            foreach ($prenotazione[$tipo]['file'][$fila]['posti'] as $k_posto => $v_posto){
                //echo "$v_posto<br />";
                $stati_posti_prenotati[$fila][$v_posto] = $piantina[$tipo]['file'][$fila]['posti'][$posto]['stato'];
            }
        }
        
        //Cancello tutti gli stati
        foreach ($prenotazione as $k_prenotazione => $v_prenotazione){
            //echo "$k<br />";
            if(strtolower($k_prenotazione) === "platea"){
                foreach ($v_prenotazione['file'] as $fila_prenotazione => $posti_prenotazione){
                    foreach ($posti_prenotazione['posti'] as $k_posto_prenotazione => $posto_prenotato){
                        //echo "$fila <> $fila_prenotazione && $posto <> $posto_prenotato<br />";
                        if(strtolower("platea")){
                            unset($piantina[$tipo]['file'][$fila]['posti'][$posto]['stato']);
                        }
                    }
                }
            }
        }
        
        //Ripristino gli stati per i posti prenotati
        foreach ($stati_posti_prenotati as $fila_stato => $posti){
            foreach ($posti as $posto_stato => $stato){
                if($fila_stato == $fila && $posto_stato == $posto){
                    $piantina[$tipo]['file'][$fila]['posti'][$posto]['stato'] = $stato;
                }
            }
        }
        
        return $piantina;
    }
    
    
}