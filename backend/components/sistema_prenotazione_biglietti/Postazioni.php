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
    public function prenotazione($prenotazione_posti, $dati, $id_spettacolo) {
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
        
        $prenotazione_posti_utente = json_encode($prenotazione_posti_utente);
        
        //$prenotazione_posti_utente = json_encode($prenotazione_posti);//Verificare questo errore e sistemare di conseguenza la lettura e il resto
        $piantina_json      = json_encode($this->posti);
        
        $tbl_teatro_spettacolo = self::DB_TABLE_SPETTACOLO;
        $tbl_prenotazione      = self::DB_TABLE_PRENOTAZIONE;
        
        return [
            'piantina'                  => $piantina_json,
            'prenotazione_posti_utente' => $prenotazione_posti_utente
        ];
        
        /*$update_posti_piantina_q = <<<UPDATE_Q
UPDATE {$tbl_teatro_spettacolo} SET piantina = '{$piantina_json}' WHERE id = {$id_spettacolo};
UPDATE_Q;

            $nome           = addslashes($dati['nome']);
            $cognome        = addslashes($dati['cognome']);
            $email          = $dati['email'];
            $cellulare      = $dati['cellulare'];
            $spettacolo_id  = $dati['spettacolo_id'];
            echo $insert_prenotazione_q = <<<Q
INSERT INTO {$tbl_prenotazione} (id, nome, cognome, email, cellulare, prenotazione, id_spettacolo)
VALUES (NULL, '{$nome}', '{$cognome}', '{$email}', '{$cellulare}', '{$prenotazione_posti_utente}', {$spettacolo_id});
Q;

        return $this->conn->query($update_posti_piantina_q) && $this->conn->query($insert_prenotazione_q);
        */
    }
    
    /**
     * Restituisce tutte le prenotazioni di uno spettacolo
     * 
     * @param int $spettacolo_id Codice dello spettacolo
     */
    public function getPrenotazioni($spettacolo_id){
        $tbl_prenotazioni = self::DB_TABLE_PRENOTAZIONE;
        $tbl_spettacolo   = self::DB_TABLE_SPETTACOLO;
        $prenotazioni_q = <<<Q
SELECT tp.id as id_prenotazione, tp.*, ts.* 
FROM {$tbl_prenotazioni} tp
INNER JOIN {$tbl_spettacolo} ts ON ts.id = tp.id_spettacolo
WHERE ts .id = {$spettacolo_id} 
-- GROUP By tp.email
Q;

        $out_prenotazioni = array();
        if(($res = $this->conn->query($prenotazioni_q))){
            $i = 0;
            while(($row = $res->fetch_object())){
                $out_prenotazioni['spettacolo']['nome']           = $row->spettacolo;
                //$out_prenotazioni['prenotazione'][$row->email]['id_prenotazione']         = $row->id_prenotazione;
                $out_prenotazioni['prenotazione'][$row->email]['nome']                    = $row->nome;
                $out_prenotazioni['prenotazione'][$row->email]['cognome']                 = $row->cognome;
                $out_prenotazioni['prenotazione'][$row->email]['cellulare']               = $row->cellulare;
                $out_prenotazioni['prenotazione'][$row->email]['email']                   = $row->email;
                
                //Query per selezionare le prenotazioni
                $out_prenotazioni['prenotazione'][$row->email]['posti'][$i] = 
                    $this->decodePrenotazione(
                            $row->prenotazione, 
                            $row->id_prenotazione,
                            $out_prenotazioni['prenotazione'][$row->email]['posti'] ?? null
                );
                $out_prenotazioni['prenotazione'][$row->email]['posti'][$i]['id_prenotazione'] = $row->id_prenotazione;
        
                $i ++;
            }
        }
        
        
        return $out_prenotazioni;
    }
    
    /**
     * Trova tutte le prenotazioni corrispondenti ad un unico ID
     * (le prenotazioni effettuate contestualmente)
     * 
     * @param int $id_prenotazione
     */
    public function getPrenotazioneById($id_prenotazione){
        $tbl_prenotazioni = self::DB_TABLE_PRENOTAZIONE;
        
        $query = <<<PRENOTAZIONE
SELECT * FROM {$tbl_prenotazioni} WHERE id = {$id_prenotazione};
PRENOTAZIONE;

        $prenotazione = [];
        if(($res = $this->conn->query($query))){
            while(($row = $res->fetch_object())){
                $prenotazione['nome']           = $row->nome;
                $prenotazione['cognome']        = $row->cognome;
                $prenotazione['email']          = $row->email;
                $prenotazione['cellulare']      = $row->cellulare;
                $prenotazione['prenotazione']   = json_decode($row->prenotazione);
            }
        }
        
        return $prenotazione;
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
     * Restituisce uno spettacolo
     * 
     * @param int $spettacolo_id Codice dello spettacolo
     */
    public function getSpettacolo($spettacolo_id){
        $tbl_spettacolo = self::DB_TABLE_SPETTACOLO;
        $query = <<<QUERY
SELECT * FROM {$tbl_spettacolo} WHERE id = {$spettacolo_id};
QUERY;

        if(($res = $this->conn->query($query))){
            return $res->fetch_object();
        }
        
        return null;
    }
    
    /**
     * Cancella una prenotazione
     * 
     * @param int $id_prenotazione Codice della prenotazione
     * @return boolean true se la prenotazione è stata cancellata, false altrimenti
     */
    public function deletePrenotazione($id_prenotazione, $dati_ricerca) {
        $piantina = json_decode($this->getPiantinaSpettacolo($dati_ricerca['id_spettacolo']));
        
        $prenotazione = $this->getPrenotazioneById($id_prenotazione);
        
        //Recupera la prenotazione specifica
        //da cancellare, in base ai dati del tipo
        //(platea, ordini, ecc), al palco (se presente)
        //e alla fila
        $prenotazione_specifica = [];
        
        foreach($prenotazione['prenotazione'] as $k_prenotazione => $v_prenotazione){            
            //Ciclo in base al tipo e rimuovo i riscontri
            foreach ($v_prenotazione->nome as $k_nome => $v_nome){
                if($v_nome === $dati_ricerca['tipo']){
                    if($dati_ricerca['fila'] == $v_prenotazione->fila[$k_nome]){
                        if(isset($dati_ricerca['palco']) && !empty($dati_ricerca['palco'])){
                            if($dati_ricerca['palco'] == $v_prenotazione->palco[$k_nome] && $dati_ricerca['fila'] == $v_prenotazione->fila[$k_nome]){
                               unset($v_prenotazione->nome[$k_nome]);
                               unset($v_prenotazione->palco[$k_nome]);
                               unset($v_prenotazione->fila[$k_nome]);
                               unset($v_prenotazione->posto[$k_nome]);
                            }
                        }else{///platea
                           unset($v_prenotazione->nome[$k_nome]);
                           unset($v_prenotazione->fila[$k_nome]);
                           unset($v_prenotazione->posto[$k_nome]);
                        }
                    }
                }
            }
            
        }
        
        $tbl_prenotazione      = self::DB_TABLE_PRENOTAZIONE;
        
        $prenotazione_aggiornata_json = [];
        foreach ($prenotazione['prenotazione'] as $k => $v){
            foreach ($v->nome as $k1 => $v1){
                if(isset($dati_ricerca['palco'])){
                    $prenotazione_aggiornata_json[$k]['nome'][] = $k;
                    $prenotazione_aggiornata_json[$k]['palco'][] = $v->palco[$k1];
                    $prenotazione_aggiornata_json[$k]['fila'][] = $v->fila[$k1];
                    $prenotazione_aggiornata_json[$k]['posto'][] = $v->posto[$k1];
                }else{
                    $prenotazione_aggiornata_json[$k]['nome'][] = $k;
                    if(isset($v->palco)){
                       $prenotazione_aggiornata_json[$k]['palco'][] = $v->palco[$k1];
                    }
                    $prenotazione_aggiornata_json[$k]['fila'][] = $v->fila[$k1];
                    $prenotazione_aggiornata_json[$k]['posto'][] = $v->posto[$k1];
                }
            }
        }
        $prenotazione_aggiornata_json = json_encode($prenotazione_aggiornata_json);
        
        $query = <<<UPDATE_Q
UPDATE {$tbl_prenotazione} SET prenotazione = '{$prenotazione_aggiornata_json}' WHERE id = {$id_prenotazione};
UPDATE_Q;
        
        //Controllo se il campo prenotazione è vuoto,
        //in quel caso elimino l'intero record
        //return $this->conn->query($query);      
        $q_prenotazione = "SELECT * FROM ".$tbl_prenotazione." WHERE id = {$id_prenotazione}";
        if( ($res = $this->conn->query($query)) ){
            if( ( $res_sel = $this->conn->query($q_prenotazione))){
                while(($row=$res_sel->fetch_object())){
                    $jd = json_decode($row->prenotazione);
                    
                    $query_delete = "DELETE FROM ".self::DB_TABLE_PRENOTAZIONE." WHERE id = ".$id_prenotazione;
                    $esiste_jd = false;
                    foreach ($jd as $k => $v){
                        $esiste_jd = true;
                        //echo $v->nome." == null || ".$v->nome." == || ".sizeof($v->nome)." == 0";
                        //echo sizeof($v->nome)." == 0";
                        if(is_countable($v->nome) &&    sizeof($v->nome) == 0) {
                            $this->conn->query($query_delete);
                        }
                    }
                    
                    if(!$esiste_jd){
                        $this->conn->query($query_delete);
                    }
                    
                }
            }
            
            
            //Aggiorna la piantina col nuovo stato (free)
            foreach ($piantina as $k_p => $v_p){
                if($dati_ricerca['tipo'] === "platea"){
                    foreach ($v_p->file as $k_fila => $v_fila){
                        foreach ($v_fila->posti as $k_posto => $v_posto){
                            if($dati_ricerca['fila'] == $k_fila && $this->controllaStato($v_posto->stato??"")){
                                unset($v_posto->stato);
                            }
                        }
                    }
                } else {
                    foreach ($v_p->palco as $k_palco => $v_palco){
                        foreach ($v_palco->fila as $k_fila => $v_fila){
                            foreach ($v_fila->posti as $k_posto => $v_posto){
                                if($dati_ricerca['palco'] == $k_palco && $dati_ricerca['fila'] == $k_fila && $this->controllaStato($v_posto->stato??"")){
                                   unset($v_posto->stato);
                                }
                            }
                        }
                    }
                }
            }
            
            $this->aggiornaPiantinaSpettacolo($dati_ricerca['id_spettacolo'], json_encode($piantina));
            //Fine aggiornamento stato
            
            return true;
        }
        
        return false;
    }
    
    /**
     * 
     * Aggiorna i posti sulla piantina dello spettacolo
     * 
     * @param type $id_spettacolo
     * @return boolean true se la piantina viene aggiornata, false altrimenti
     */
    private function aggiornaPiantinaSpettacolo($id_spettacolo, $piantina_modificata) {
        $tbl_spettacolo = self::DB_TABLE_SPETTACOLO;
        $query = <<<QUERY
UPDATE {$tbl_spettacolo} SET piantina = '{$piantina_modificata}' WHERE id = {$id_spettacolo};
QUERY;

        return $this->conn->query($query);
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
    
}