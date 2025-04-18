<?php
namespace backend\components\sistema_prenotazione_biglietti;

use Yii;

/**
 * Gestisce la piantina di un teatro permettendo le seguenti azioni:
 * - Prenotazione
 * - Cancellazione di una prenotazione
 * - Visualizzazione dei dati delle prenotazioni
 * 
 * @version 2.0.0
 * @copyright (c) 2022, MSD Technologies
 */
class Postazioni{
    private $posti;
    private $conn;
    /**
     * Posti prenotati da un cliente
     * @var string
     */
    private $my_booked;
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
    //Colore per gli accrediti della stampa
    public const COLOR_CREDIT  = "violet";
    //Colore per gli accrediti delle compagnie
    public const COLOR_CREDIT_THEATRE  = "orange";
    //Colore per gli accrediti della giuria
    public const COLOR_CREDIT_JURYMAN = "#F70CE0";
    //colore per i posti riservati agli sponsor
    public const COLOR_CREDIT_SPONSOR = "#D9AA59";
    //Colore per le prenotazioni di uno specifico utente
    public const COLOR_MY_BOOKED = "yellow";
    //Colore per gli abbonamenti
    public const COLOR_SUBSCRIPTION = "#33B1F5";
    
    /**==========================================
     * Campi per dropdown menu
    ==========================================*/
    public const CREDIT_DROPDOWN = [
        self::STATO_NOT_PAYED       => 'Cliente',
        self::STATO_CREDIT          => 'Stampa',
        self::STATO_CREDIT_THEATRE  => 'Compagnia',
        self::STATO_CREDIT_JURYMAN  => 'Giurato',
        self::STATO_CREDIT_SPONSOR  => 'Sponsor',
    ];
    
    /**==========================================
     * Stati pagamento
    *==========================================*/
    //Stati per abbonamenti
    public const STATO_SUBSCRIPTION_NOT_PAYED   = 14;//Abbonamento non pagato
    public const STATO_SUBSCRIPTION_PAYED       = 15;//Abbonamento pagato
    
    //Stati ticket clienti
    public const STATO_PAYED           = 10;//Pagato
    public const STATO_NOT_PAYED       = 0;//Non Pagato
    
    //Stati CREDIT
    public const STATO_CREDIT          = 11;//Stampa
    public const STATO_CREDIT_THEATRE  = 12;//Compagnia teatrale
    public const STATO_CREDIT_JURYMAN  = 13;//Giurato del festival
    public const STATO_CREDIT_SPONSOR  = 16;//sponsor del festival
    
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
     * @param array $posti_piantina
     *              Vale sia per i posti prenotati che per indicare la piantina
     *              nel caso in cui si accede alla parte di gestione delle prenotazioni
     *              di un cliente
     * @param string $my_booked Posti prenotati da un cliente. Di default vale null (nessuna prenotazione di posti)
     * @param mixed $conn
     * @param mysqli $conn Connessione a mysql
     */
    public function __construct($posti_piantina, $my_booked = null, $conn = null) {
        $this->posti     = $posti_piantina;
        $this->conn      = $conn;
        $this->my_booked = $my_booked;
        
    }
    
    /**
     * Restituisce la mappa
     * 
     * @param boolean $guest Indica se la mappa viene visualizzata nella pagina
     *                       di amministrazione (false) o in quella del cliente (true).
     */
    public function get($guest = true) {
        echo '<svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">';
            foreach($this->posti as $k_posto => $v_posto) : 
                foreach($v_posto as $k_fila => $v_fila) : 
                    if($k_fila === "file"){
                        $this->getPlatea ($v_fila, $k_posto, $guest);
                    }else{
                        $this->getPalchi($v_fila, $k_posto, $guest);
                    }       
                endforeach;
            endforeach;
        echo '</svg>';
    }
    
    /**
     * Cancella le prenotazioni selezionate.
     * 
     * @param string $prenotazioni_da_cancellare Prenotazioni da cancellare
     * @param string $prenotazioni Tutte le prenotazioni
     */
    public function cancellaPrenotazione(string $prenotazioni_da_cancellare, string $prenotazioni){
        $prenotazioni_da_cancellare = json_decode($prenotazioni_da_cancellare, true);
        $prenotazioni               = json_decode($prenotazioni, true);
        
        /*echo "<pre>";
        print_r($prenotazioni_da_cancellare);
        echo "</pre>";*/
                
        //Modifico i posti prenotati
        foreach($prenotazioni_da_cancellare as $k_pp => $v_pp){
            if(isset($this->posti->$k_pp->file)){//Se ha solo file
                foreach ($v_pp['file'] as $k_fila => $v_fila){
                    foreach ($v_pp['file'][$k_fila]['posti'] as $p => $posto){
                        if(isset($this->posti->$k_pp->file->$k_fila->posti->{$posto}->stato)){
                            unset($this->posti->$k_pp->file->$k_fila->posti->{$posto}->stato);//Rimuovo lo stato che indica la prenotazione
                        }
                    }
                }
            }else{//Se ha anche i palchi
                foreach ($v_pp['palco'] as $k_palco => $v_palco){
                    foreach ($v_palco['file'] as $k_fila => $v_fila){
                        foreach ($v_fila['posti'] as $p => $posto){
                            if(isset($this->posti->$k_pp->palco->$k_palco->fila->$k_fila->posti->$posto->stato)){
                                unset($this->posti->$k_pp->palco->$k_palco->fila->$k_fila->posti->$posto->stato);//Rimuovo lo stato che indica la prenotazione
                            }else if($k_fila === "non_numerato"){
                                //Decremento i posti attualmente prenotati (dal totale dei posti)
                                $this->posti->$k_pp->palco->$k_palco[0]->posti_prenotati -= $prenotazioni_da_cancellare[$k_pp]['palco'][$k_palco]['file'][$k_fila]['posti'][0];
                            }
                        }
                    }
                }
            }
        }
        //--------------------------------------------
       
        //Cancello le prenotazioni dell'utente
        foreach ($prenotazioni_da_cancellare as $k_p => $v_p){
            if(isset($v_p['palco'])){//Ci sono palchi
                foreach ($v_p['palco'] as $palco => $file){
                    foreach ($file['file'] as $fila => $posti){
                        foreach ($posti as $posto){
                            try{
                                $key_to_remove = array_search($posto, $prenotazioni[$k_p]['palco'][$palco]['fila'][$fila]['posti']);
                            } catch (\Exception $ex) {
                                try{
                                    $prenotazioni[$k_p]['palco'][$palco]['non_numerato'] -= $prenotazioni_da_cancellare[$k_pp]['palco'][$k_palco]['file'][$k_fila]['posti'][0];
                                    
                                    //Non ci sono più posti non numerati prenotati
                                    //Rimuovo la prenotazione del tutto
                                    if($prenotazioni[$k_p]['palco'][$palco]['non_numerato'] === 0){
                                        unset($prenotazioni[$k_p]);
                                    }
                                } catch (Exception $ex) {}
                            }
                            
                            if(empty($prenotazioni[$k_p]['palco'][$palco]['fila'][$fila]['posti'])){
                                unset($prenotazioni[$k_p]['palco'][$palco]['fila'][$fila]['posti']);
                            }
                        }
                        
                        
                        if(empty($prenotazioni[$k_p]['palco'][$palco]['fila'])){
                            unset($prenotazioni[$k_p]['palco'][$palco]['fila']);
                        }
                    }
                    
                    if(empty($prenotazioni[$k_p]['palco'])){
                        unset($prenotazioni[$k_p]['palco']);
                    }
                }
            }else{//Non ci sono palchi
                foreach ($v_p as $file){
                    foreach ($file as $fila => $v_posti){
                        foreach ($v_posti as $posti){
                            foreach ($posti as $posto){
                                //trovo la chiave del posto da rimuovere dalla prenotazione
                                try{
                                    $key_to_remove = array_search($posto, $prenotazioni[$k_p]['file'][$fila]['posti']);
                                    unset($prenotazioni[$k_p]['file'][$fila]['posti'][$key_to_remove]);
                                }catch(\Exception $ex){}

                                if(empty($prenotazioni[$k_p]['file'][$fila]['posti'])){
                                    unset($prenotazioni[$k_p]['file'][$fila]);
                                }
                            }
                        }
                    }

                    if(empty($prenotazioni[$k_p]['file'])){
                        unset($prenotazioni[$k_p]['file']);
                    }
                }
            }
            
            if(empty($prenotazioni[$k_p])){
                unset($prenotazioni[$k_p]);
            }
        }
        
        return [
            'prenotazioni'  => (empty($prenotazioni))?null:$prenotazioni,
            'posti'         => $this->posti,
        ];
    }

    /**
    * Salvataggio dei posti prenotati dagli utenti
    * e salva i dati dell'utente che ha prenotato
    * 
    * @param array $prenotazione_posti Array dei posti prenotati
    * @param array $prenotazione_esistente Prenotazione giÃ  esistente. NULL se non ci sono prenotazioni esistenti
    * @param int $tipo_di_prenotazione Tipologia della prenotazione (Cliente, Stampa, Compagnia, ecc.)
    */
    public function prenotazione($prenotazione_posti, $prenotazione_esistente, $tipo_di_prenotazione = self::STATO_NOT_PAYED) {
        $conteggio_prenotazione_utente_non_numerato = 0;

        //costruisco il json per la prenotazione dell'utente
        //e modifico la piantina
        $prenotazione_posti_utente = [];
        foreach($prenotazione_posti as $k_pp => $v_pp){
            $prenotazione_posti_utente[$k_pp] = [];

            if(isset($this->posti->$k_pp->file)){//Se ha solo file

                foreach ($v_pp['fila'] as $k_fila => $v_fila){

                    $posto = $v_pp['posto'][$k_fila];
                    $this->posti->$k_pp->file->$v_fila->posti->$posto->stato = $tipo_di_prenotazione;

                    //dati prenotazione utente
                    $prenotazione_posti_utente[$k_pp]['file'][$v_fila]['posti'][] = $posto;
                }
            }else if(isset($this->posti->$k_pp->palco)){//se ci sono dei palchi
                foreach ($v_pp['palco'] as $k_palco => $v_palco){
                    $fila = $v_pp['fila'][$k_palco];
                    
                    if(
                        $fila == "non_numerato"//Compatibilità con le versioni precedenti
                        ||
                        $fila == "Non assegnata"//usato dalla versione 2.0 (nuovo nome per i posti non numerati)
                    ){
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
        
        return [
            'piantina'                  => $piantina_json,
            'prenotazione_posti_utente' => $prenotazione_posti_utente
        ];
    }
    
    /**
     * Segna una prenotazione come pagata
     * 
     * @param string $prenotazione_posti
     * @param string $prenotazione_esistente
     * @return string Piantina delle prenotazioni aggiornata
     */
    public function buy($prenotazione_posti, $prenotazione_esistente){
        $prenotazione_posti_utente = [];
        foreach($prenotazione_posti as $k_pp => $v_pp){            
            $prenotazione_posti_utente[$k_pp] = [];
            
            if(isset($this->posti->$k_pp->file)){//Se ha solo file
                foreach ($v_pp['fila'] as $k_fila => $v_fila){

                    $posto = $v_pp['posto'][$k_fila];
                    //$this->posti->$k_pp->file->$v_fila->posti->$posto->stato = $tipo_di_prenotazione;
                    
                    switch($this->posti->$k_pp->file->$v_fila->posti->$posto->stato){
                        case self::STATO_NOT_PAYED:
                            $this->posti->$k_pp->file->$v_fila->posti->$posto->stato = self::STATO_PAYED;
                            break;
                        case self::STATO_SUBSCRIPTION_NOT_PAYED:
                            $this->posti->$k_pp->file->$v_fila->posti->$posto->stato = self::STATO_SUBSCRIPTION_PAYED;
                            break;
                    }

                    //Aggiorno i dati della prenotazione dell'utente
                    $prenotazione_posti_utente[$k_pp]['file'][$v_fila]['posti'][] = $posto;
                }
            }else if(isset($this->posti->$k_pp->palco)){//se ci sono dei palchi
                foreach ($v_pp['palco'] as $k_palco => $v_palco){
                    $fila = $v_pp['fila'][$k_palco];
                    if($fila == "non_numerato"){//Palco non numerato
                        $this->posti->$k_pp->palco->$v_palco[0]->posti_prenotati += 1;
                        $conteggio_prenotazione_utente_non_numerato += 1;
                        
                        $prenotazione_posti_utente[$k_pp]['palco'][$v_palco]['non_numerato'] = $conteggio_prenotazione_utente_non_numerato;
                    } else {//Palco numerato
                        $posto = $v_pp['posto'][$k_palco];
                        
                        switch ($this->posti->$k_pp->palco->$v_palco->fila->$fila->posti->$posto->stato){
                            case self::STATO_NOT_PAYED:
                                $this->posti->$k_pp->palco->$v_palco->fila->$fila->posti->$posto->stato = self::STATO_PAYED;
                                break;
                            case self::STATO_SUBSCRIPTION_NOT_PAYED:
                                $this->posti->$k_pp->palco->$v_palco->fila->$fila->posti->$posto->stato = self::STATO_SUBSCRIPTION_PAYED;
                                break;
                        }
                        
                        //Aggiorno i dati della prenotazione dell'utente
                        $prenotazione_posti_utente[$k_pp]['palco'][$v_palco]['fila'][$fila]['posti'][] = $posto;
                    }
                }

            }
        }
        
        $piantina_json      = json_encode($this->posti);
        
        return [
            'piantina'                  => $piantina_json,
            'prenotazione_posti_utente' => $prenotazione_posti_utente,
        ];
    }
    
    /**
     * Prenota un abbonamento.
     * 
     * @param array $prenotazione_posti
     * @param array $prenotazione_esistente Abbonamenti giÃ  presi
     * @param int $tipo_di_prenotazione
     * @return array
     */
    public function abbonamento($prenotazione_posti, $prenotazione_esistente, $tipo_di_prenotazione = self::STATO_SUBSCRIPTION_NOT_PAYED){
        $prenotazione_posti_utente = [];
        foreach($prenotazione_posti as $k_pp => $v_pp){
            $prenotazione_posti_utente[$k_pp] = [];

            if(isset($this->posti->$k_pp->file)){//Se ha solo file

                foreach ($v_pp['fila'] as $k_fila => $v_fila){

                    $posto = $v_pp['posto'][$k_fila];
                    $this->posti->$k_pp->file->$v_fila->posti->$posto->stato = $tipo_di_prenotazione;

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
        $piantina_json = json_encode($this->posti);
        
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
     * Numero di ticket totali, in base al tipo
     * (pagati, non pagati, crediti, ecc).
     * 
     * @param int $state Stato del posto (STATO_PAYED, ecc)
     * @return int Numero totale di ticket trovati
     */
    public static function getNumberOfTicket($prenotazioni, int $state = self::STATO_PAYED){
        $prenotazioni = json_decode($prenotazioni, true);
        
        $tot = 0;
        if(isset($prenotazioni['platea'])){
            foreach ($prenotazioni['platea'] as $file){
                foreach ($file as $posti){
                    foreach ($posti['posti'] as $posto => $info){
                        if(isset($info['stato'])){
                            $p_state = $info['stato'];
                            if($p_state == $state){
                                $tot ++;
                            }
                        }
                    }
                }
            }
        }
        
        return $tot;
    }
    
    /**
     * Restituisce il numero di abbonamenti
     * @param string $prenotazioni Prenotazioni effettuate
     * @return int
     */
    public static function getNumberOfSubscription($prenotazioni){
        return self::getNumberOfTicket($prenotazioni, self::STATO_SUBSCRIPTION_PAYED);
    }
    
    /**
     * Visualizza i palchi
     * 
     * @param array $p Palchi
     * @param string $nome Nome del posto (I Ordine, ecc)
     * @param boolean $guest Se siamo nella sezione amministrazione (false) o
     *                       pubblica (true)
     */
    private function getPalchi($p, $nome, bool $guest){
        $this->my_booked = (is_array($this->my_booked)) ? $this->my_booked : json_decode($this->my_booked, true);
        
        foreach ($p as $k => $palco){
                                
            foreach ($palco as $k2 => $fila){
                    foreach ($fila as $k3 => $posto){
                        if(is_object($posto)){
                            foreach ($posto as $k4 => $config){
                                foreach ($config as $k5 => $v){                  
                                    $x = $v->x;
                                    $y = $v->y;
                                    $visibilita = (isset($v->visibilita_ridotta) && $v->visibilita_ridotta ) ? "si" : "no";
                                    $tipo_seduta = $v->tipo_seduta ?? self::TIPO_SEDUTA_DEFAULT;
                                    $color_fill   = self::COLOR_FREE;
                                    $color_stroke = self::COLOR_FREE;
                                    $class = "seat";
                                    
                                    //Colori per i posti prenotati da un utente
                                    if(isset($this->my_booked[$nome]['palco'][$k]['fila'][$k3]['posti']) && $this->verificaPostoPrenotato($this->my_booked[$nome]['palco'][$k]['fila'][$k3]['posti'], $k5)){
                                        
                                        
                                        if(isset($v->stato) && $this->controllaStato($v->stato)){                                            
                                            $color_stroke = "black";
                                            $color_fill   = self::COLOR_MY_BOOKED;
                                            $class       .= " my-busy ";

                                            //if(isset($v->stato) && $this->controllaStato($v->stato)){
                                                switch ($v->stato){
                                                    case self::STATO_NOT_PAYED:
                                                        $class .= " busy not-payed";
                                                        break;
                                                    case self::STATO_PAYED:
                                                        $color_stroke   = self::COLOR_PAYED;
                                                        $class .= " busy";
                                                       break;
                                                    case self::STATO_CREDIT:
                                                        $color_stroke = $color_fill = self::COLOR_CREDIT;
                                                        $class .= " busy credit";
                                                        break;
                                                    case self::STATO_CREDIT_THEATRE:
                                                        $color_stroke = $color_fill = self::COLOR_CREDIT_THEATRE;
                                                        $class .= " busy credit";
                                                        break;
                                                    case self::STATO_CREDIT_JURYMAN:
                                                        $color_stroke = $color_fill = self::COLOR_CREDIT_JURYMAN;
                                                        $class .= " busy credit SI";
                                                        break;
                                                    case self::STATO_SUBSCRIPTION_NOT_PAYED:
                                                        $color_stroke = $color_fill = self::COLOR_SUBSCRIPTION;
                                                        $class .= " busy subscription-not-payed";
                                                        break;
                                                    case self::STATO_SUBSCRIPTION_PAYED:
                                                        $color_stroke   = self::COLOR_PAYED;
                                                        $color_fill     = self::COLOR_SUBSCRIPTION;
                                                        $class .= " busy subscription-payed";
                                                        break;
                                                    case self::STATO_CREDIT_SPONSOR:
                                                        $color_stroke = $color_fill = self::COLOR_CREDIT_SPONSOR;
                                                        break;

                                                }
                                            //}
                                        }
                                    }else if(isset($v->stato) && $this->controllaStato($v->stato)){//prenotazioni di altri utenti
                                        
                                        
                                        switch ($v->stato){
                                            case self::STATO_PAYED:
                                                $color_stroke = $color_fill = self::COLOR_PAYED;
                                                $class .= " busy";
                                                break;
                                            case self::STATO_NOT_PAYED:
                                                $color_stroke = $color_fill = self::COLOR_BOOKED;
                                                $class .= " busy";
                                                break;
                                            case self::STATO_CREDIT:
                                                $color_stroke = $color_fill = self::COLOR_BOOKED;
                                                $class .= " busy";

                                                if($guest){
                                                    //Stati dei posti non visualizzabili all'interno
                                                    //della pagina del cliente ma solo nella
                                                    //pagina di amministrazione.
                                                    //Nella pagina del cliente vengono visualizzati
                                                    //solo come posto occupato (pagato)
                                                    $color_stroke = $color_fill = self::COLOR_PAYED;
                                                }
                                                break;
                                            case self::STATO_CREDIT_THEATRE:
                                                $color_stroke = $color_fill = self::COLOR_BOOKED;
                                                $class .= " busy";

                                                if($guest){
                                                    //Stati dei posti non visualizzabili all'interno
                                                    //della pagina del cliente ma solo nella
                                                    //pagina di amministrazione.
                                                    //Nella pagina del cliente vengono visualizzati
                                                    //solo come posto occupato (pagato)
                                                    $color_stroke = $color_fill = self::COLOR_PAYED;
                                                }
                                                break;
                                            case self::STATO_CREDIT_JURYMAN:
                                                $color_stroke = $color_fill = self::COLOR_CREDIT_JURYMAN;
                                                $class .= " busy";

                                                if($guest){
                                                    //Stati dei posti non visualizzabili all'interno
                                                    //della pagina del cliente ma solo nella
                                                    //pagina di amministrazione.
                                                    //Nella pagina del cliente vengono visualizzati
                                                    //solo come posto occupato (pagato)
                                                    $color_stroke = $color_fill = self::COLOR_PAYED;
                                                }
                                                break;
                                            case self::STATO_SUBSCRIPTION_NOT_PAYED:
                                                $color_stroke = $color_fill = self::COLOR_BOOKED;
                                                $class .= " busy";
                                                break;
                                            case self::STATO_SUBSCRIPTION_PAYED:
                                                $color_stroke = $color_fill = self::COLOR_BOOKED;
                                                $class .= " busy";

                                                if($guest){
                                                    //Stati dei posti non visualizzabili all'interno
                                                    //della pagina del cliente ma solo nella
                                                    //pagina di amministrazione.
                                                    //Nella pagina del cliente vengono visualizzati
                                                    //solo come posto occupato (pagato)
                                                    $color_stroke = $color_fill = self::COLOR_PAYED;
                                                }
                                                break;
                                            case self::STATO_CREDIT_SPONSOR:
                                                $color_stroke = $color_fill = self::COLOR_CREDIT_SPONSOR;
                                                $class .= " busy";

                                                if($guest){
                                                    //Stati dei posti non visualizzabili all'interno
                                                    //della pagina del cliente ma solo nella
                                                    //pagina di amministrazione.
                                                    //Nella pagina del cliente vengono visualizzati
                                                    //solo come posto occupato (pagato)
                                                    $color_stroke = $color_fill = self::COLOR_PAYED;
                                                }
                                                break;
                                        }

                                    }
                                    
                                    //echo str_replace("_", " ", $o);
                                    echo '<circle class="'.$class.'" '
                                            . 'data-tooltip="Fila <strong>'.$k3.'</strong><br />Posto: <strong>'.$k5.'</strong><br />Tipo seduta: <strong>'.$tipo_seduta.'</strong><br />VisibilitÃ  ridotta: <strong>'.$visibilita.'</strong>" '
                                            . 'title="" '
                                            . 'data-nome="'. (str_replace("_", " ", $nome)).'" '
                                            . 'data-palco='.$k.' '
                                            . 'data-fila="'.$k3.'" '
                                            . 'data-posto="'.$k5.'" '
                                            . 'cx="'.$x.'" '
                                            . 'cy="'.$y.'" '
                                            . 'r="5" '
                                            . 'stroke="'.$color_stroke.'" '
                                            . 'stroke-width="2" '
                                            . 'fill="'.$color_fill.'" />';
                                }
                            }
                        }else{
                            if(isset($fila->non_numerato) && $fila->non_numerato){
                                /*
                                 * RIVEDERE ASSOCIA A TUTTI GLI UTENTI
                                 * LA PRENOTAZIONE DEI POSTI DI UN UTENTE SPECIFICO
                                 */
                                $posti_liberi   = $fila->posti_totali-$fila->posti_prenotati;
                                //classe per i posti da pagare
                                $class_da_pagare = ($fila->posti_prenotati-$fila->posti_pagati)>0
                                                    ? " my-busy busy not-payed"
                                                    : ($fila->posti_prenotati-$fila->posti_pagati);
                                
                                
                                $class = "seat nn {$class_da_pagare}";
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
                                    . 'class="'.$class.'" '
                                    . 'data-fila="Non assegnata" '
                                    . 'data-posto="Non assegnato" '
                                    . 'data-nome="'.str_replace("_", " ", $nome).'" '
                                    . 'data-posti-totali="'.$postiTotali.'" '
                                    . 'data-posti-pagati="'.$postiPagati.'" '
                                    . 'data-posti-prenotati="'.$postiPrenotati.'" '
                                    . 'data-tooltip="Palco non numerato. I posti non sono assegnati" '
                                    . 'data-nome="'. (str_replace("_", " ", $nome)).'" '
                                    . 'data-palco="'.$k.'" />';
                                
                                
                                /*echo "<pre>";
                                print_r($this->my_booked);
                                echo "</pre>";*/
                                
                            }
                            break;
                        }
                    }
            }
        }
    }
    
    /**
     * Restituisce le prenotazioni prenotate e/o pagate
     * dell'utente
     * 
     * @return array Prenotazione posti
     */
    public function getMyBooked(){
        return $this->my_booked;
    }
    
    /**
     * Restituisce la platea
     * 
     * @param array $p Dati della platea
     * @param string $nome Nome assegnato alla platea
     * @param string $guest Indica se la mappa viene visualizzata nella pagina
     *                      di amministrazione (true) o in quella del cliente (false).
     */
    private function getPlatea($p, $nome, $guest){
        $this->my_booked = (is_array($this->my_booked)) ? $this->my_booked : json_decode($this->my_booked, true);
        
        //Ciclo sulle file
        foreach($p as $k_fila2 => $v_fila2) : 
            //Ciclo posti 
            foreach($v_fila2 as $k_pos => $v_pos) : 
                //Ciclo sulle posizioni 
                    foreach($v_pos as $k_posizione => $v_posizione) :                             
                        $x = $v_posizione->x;
                        $y = $v_posizione->y;
                        $tipo_seduta = $v_posizione->tipo_seduta ?? self::TIPO_SEDUTA_DEFAULT;
                        $color_fill   = self::COLOR_FREE;
                        $color_stroke = self::COLOR_FREE;
                        $class = "seat";
                        
                        //Colori per i posti prenotati da un utente
                        if(isset($this->my_booked[$nome]['file'][$k_fila2]['posti']) && $this->verificaPostoPrenotato($this->my_booked[$nome]['file'][$k_fila2]['posti'], $k_posizione)){
                            
                            $color_stroke = "black";
                            $color_fill   = self::COLOR_MY_BOOKED;
                            $class       .= " my-busy ";
                            
                            if(isset($v_posizione->stato) && $this->controllaStato($v_posizione->stato)){

                                switch ($v_posizione->stato){
                                    case self::STATO_NOT_PAYED:
                                        $class .= " busy not-payed";
                                        break;
                                    case self::STATO_PAYED:
                                        $color_stroke   = self::COLOR_PAYED;
                                        $class .= " busy";
                                       break;
                                    case self::STATO_CREDIT:
                                        $color_stroke = $color_fill = self::COLOR_CREDIT;
                                        $class .= " busy credit";
                                        break;
                                    case self::STATO_CREDIT_THEATRE:
                                        $color_stroke = $color_fill = self::COLOR_CREDIT_THEATRE;
                                        $class .= " busy credit";
                                        break;
                                    case self::STATO_CREDIT_JURYMAN:
                                        $color_stroke = $color_fill = self::COLOR_CREDIT_JURYMAN;
                                        $class .= " busy credit";
                                        break;
                                    case self::STATO_SUBSCRIPTION_NOT_PAYED:
                                        $color_stroke = $color_fill = self::COLOR_SUBSCRIPTION;
                                        $class .= " busy subscription-not-payed";
                                        break;
                                    case self::STATO_SUBSCRIPTION_PAYED:
                                        $color_stroke   = self::COLOR_PAYED;
                                        $color_fill     = self::COLOR_SUBSCRIPTION;
                                        $class .= " busy subscription-payed";
                                        break;
                                    case self::STATO_CREDIT_SPONSOR:
                                        $color_stroke = $color_fill = self::COLOR_CREDIT_SPONSOR;
                                        break;
                                        
                                }
                            }
                        }else if(isset($v_posizione->stato) && $this->controllaStato($v_posizione->stato)){//prenotazioni di altri utenti
                            switch ($v_posizione->stato){
                                case self::STATO_PAYED:
                                    $color_stroke = $color_fill = self::COLOR_PAYED;
                                    $class .= " busy";
                                    break;
                                case self::STATO_NOT_PAYED:
                                    $color_stroke = $color_fill = self::COLOR_BOOKED;
                                    $class .= " busy";
                                    break;
                                case self::STATO_CREDIT:
                                    $color_stroke = $color_fill = self::COLOR_BOOKED;
                                    $class .= " busy";

                                    if($guest){
                                        //Stati dei posti non visualizzabili all'interno
                                        //della pagina del cliente ma solo nella
                                        //pagina di amministrazione.
                                        //Nella pagina del cliente vengono visualizzati
                                        //solo come posto occupato (pagato)
                                        $color_stroke = $color_fill = self::COLOR_PAYED;
                                    }
                                    break;
                                case self::STATO_CREDIT_THEATRE:
                                    $color_stroke = $color_fill = self::COLOR_BOOKED;
                                    $class .= " busy";

                                    if($guest){
                                        //Stati dei posti non visualizzabili all'interno
                                        //della pagina del cliente ma solo nella
                                        //pagina di amministrazione.
                                        //Nella pagina del cliente vengono visualizzati
                                        //solo come posto occupato (pagato)
                                        $color_stroke = $color_fill = self::COLOR_PAYED;
                                    }
                                    break;
                                case self::STATO_CREDIT_JURYMAN:
                                    $color_stroke = $color_fill = self::COLOR_CREDIT_JURYMAN;
                                    $class .= " busy";

                                    if($guest){
                                        //Stati dei posti non visualizzabili all'interno
                                        //della pagina del cliente ma solo nella
                                        //pagina di amministrazione.
                                        //Nella pagina del cliente vengono visualizzati
                                        //solo come posto occupato (pagato)
                                        $color_stroke = $color_fill = self::COLOR_PAYED;
                                    }
                                    break;
                                case self::STATO_SUBSCRIPTION_NOT_PAYED:
                                    $color_stroke = $color_fill = self::COLOR_BOOKED;
                                    $class .= " busy";
                                    break;
                                case self::STATO_SUBSCRIPTION_PAYED:
                                    $color_stroke = $color_fill = self::COLOR_BOOKED;
                                    $class .= " busy";
                                    
                                    if($guest){
                                        //Stati dei posti non visualizzabili all'interno
                                        //della pagina del cliente ma solo nella
                                        //pagina di amministrazione.
                                        //Nella pagina del cliente vengono visualizzati
                                        //solo come posto occupato (pagato)
                                        $color_stroke = $color_fill = self::COLOR_PAYED;
                                    }
                                    break;
                                case self::STATO_CREDIT_SPONSOR:
                                    $color_stroke = $color_fill = self::COLOR_CREDIT_SPONSOR;
                                    $class .= " busy";
                                    
                                    if($guest){
                                        //Stati dei posti non visualizzabili all'interno
                                        //della pagina del cliente ma solo nella
                                        //pagina di amministrazione.
                                        //Nella pagina del cliente vengono visualizzati
                                        //solo come posto occupato (pagato)
                                        $color_stroke = $color_fill = self::COLOR_PAYED;
                                    }
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
                               . 'r="5" '
                               . 'stroke="'. $color_stroke.'" '
                               . 'stroke-width="2" '
                               . 'fill="'.$color_fill.'" />';
                    endforeach; 
                //Fine ciclo posizioni 
            endforeach;
            //Fine ciclo posti 
        endforeach;
        //Fine ciclo delle file
        
        $this->my_booked = json_encode($this->my_booked);
    }
    
    /**
     * Verifica se un posto è presente tra quelli prenotati.
     * 
     * @param type $posti
     * @param type $posto
     */
    private function verificaPostoPrenotato($posti, $posto){
        foreach ($posti as $k_posto => $v_posto){
            if($v_posto == $posto){
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Verifica se lo stato Ã¨ valido
     * 
     * @param string|int $stato
     * @return boolean
     */
    private function controllaStato(string|int $stato) {
        switch ($stato){
            case self::STATO_CREDIT:
            case self::STATO_NOT_PAYED:
            case self::STATO_PAYED:
            case self::STATO_CREDIT_THEATRE:
            case self::STATO_CREDIT_JURYMAN:
            case self::STATO_CREDIT_SPONSOR:
            case self::STATO_SUBSCRIPTION_NOT_PAYED:
            case self::STATO_SUBSCRIPTION_PAYED:
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
     * @param boolean $nuova_prenotazione Indica se Ã¨ una nuova prenotazione (true) o no (false)
     * @param mixed $conn
     * @return boolean|array Restituisce false se la prenotazione non Ã¨ corretta.
     *                       Restituisce l'array della piantina modificata,
     *                          se i dati della prenotazione passati sono corretti.
     */
    public static function updatePiantina(array $prenotazione, $piantina, $nuova_prenotazione = true){
        //non Ã¨ una prenotazione valida
        if(!is_array($prenotazione)){return false;}
        
        /*echo "<pre>";
        print_r($prenotazione);
        echo "</pre>";*/
        
        foreach ($piantina as $k_piantina => $v_piantina){
            if(strtolower($k_piantina) === "platea"){
               $piantina = self::updatePrenotazionePlatea($v_piantina, $prenotazione, $piantina);
            }else{                
               $piantina = self::updatePrenotazioneOrdini($v_piantina, $prenotazione, $piantina, $k_piantina);
            }
        }
        
        return $piantina;
    }
    
    /**
     * Conta il numero di prenotazioni totali effettuate.
     * 
     * @param type $prenotazione Prenotazioni effettuate
     * @param type $abbonamenti Abbonamenti prenotati
     * @return int Numero totale di prenotazioni
     */
    public static function nOfSeatBooked($prenotazione, $abbonamenti){
        $searchKey  = "file";
        $searchKey2 = "posti";
        $searchKey3 = "palco";
        $searchKey4 = "fila";
        $nOfSeatBooked = 0;
        
        $func = function ($subarray) use ($searchKey, &$func, $searchKey2, $searchKey3, $searchKey4, &$nOfSeatBooked) {
            //Controllo se il valore di $subarray è un array
            //e non contiene la chiave cercata.
            //In questo caso si ripassa ala funzione stessa il valore
            //del nuovo sotto array
            if(!isset($subarray[$searchKey]) && is_array($subarray)){
                $func($subarray[key($subarray)]);
            
            //Controllo se il valore di $subarray è un array
            //e non contiene la chiave cercata.
            //In questo caso si ripassa ala funzione stessa il valore
            //del nuovo sotto array
            }else{
                if(isset($subarray[$searchKey])){
                    foreach($subarray[$searchKey] as $v){
                        if(isset($v[$searchKey2])){
                            array_filter($v, function($sa) use (&$nOfSeatBooked){
                                foreach ($sa as $v){
                                    $nOfSeatBooked ++; 
                                }
                            });
                        }
                    }
                }
            }
            
            //Prenotazione tenendo in considerazione anche i palchi
            if(!isset($subarray[$searchKey3]) && is_array($subarray)){
                $func($subarray[key($subarray)]);
                
            //Se invece la chiave è trovata calcolo
            //restituisco i valori (solitamente un array)
            }else{
                if(isset($subarray[$searchKey3])){//Ci sono palchi
                    foreach($subarray[$searchKey3] as $p){
                        if(isset($p[$searchKey4])){
                            foreach($p[$searchKey4] as $f){
                                if(isset($f[$searchKey2])){
                                    array_filter($f, function($sa) use (&$nOfSeatBooked){
                                        foreach ($sa as $v){
                                            $nOfSeatBooked ++;
                                        }
                                    });
                                }
                            }
                        }
                    }
                }
            }
            
        };
        
        if(!is_null(json_decode($prenotazione, true))) array_filter(json_decode($prenotazione, true), $func);
        if(!is_null(json_decode($abbonamenti, true))) array_filter(json_decode($abbonamenti, true), $func);
        
        return $nOfSeatBooked;
    }
    
    /**
     * Restituisce gli stati dei biglietti (pagato, non pagato, stampa, ecc.).
     * 
     * @param string|array $posti
     * @param type $prenotazione
     * @return array Restituisce un array contenente gli stati dei posti
     *               prenotati.
     */
    public static function nOfSeatState(string|array $posti, string|array $prenotazione) /*: array|false*/{
        $searchKey      = 'file';
        $searchKey2     = "posti";
        $searchKey3     = "stato";
        $searchKey4     = "palco";
        $nOfSeatPaid    = 0;//Numero di posti pagati
        $nOfSeatNotPaid = 0;//Numero di posti non pagati
        $nOfSeatPress   = 0;//Numero di posti riservati per la stampa
        
        //Se i parametri sono di tipo stringa allora li converto in array
        //decodificando il json
        if(is_string($posti)){
            $posti          = json_decode($posti, true);
        }
        if(is_string($prenotazione)){
            $prenotazione   = json_decode($prenotazione, true);
        }
        //-----------------------------------------------------------------
        
        foreach ($posti as $k_p => $p_v){
            if(isset($prenotazione[$k_p])){
                //Controllo se il posto contiene file o palchi
                if(isset($posti[$k_p]['file'])){//se contiene file...
                    foreach ($posti[$k_p]['file'] as $k_fila => $posti){
                        if(isset($prenotazione[$k_p][$searchKey][$k_fila])){
                            foreach ($posti[$searchKey2] as $posto => $info){                            
                                if(array_search($posto, $prenotazione[$k_p]['file'][$k_fila]['posti']) !== false){
                                    if(isset($info[$searchKey3])){
                                        switch ($info[$searchKey3]){
                                            case self::STATO_PAYED:
                                            case self::STATO_SUBSCRIPTION_PAYED:
                                                $nOfSeatPaid ++;
                                                break;
                                            case self::STATO_NOT_PAYED:
                                            case self::STATO_SUBSCRIPTION_NOT_PAYED:
                                                $nOfSeatNotPaid ++;
                                                break;
                                            case self::STATO_CREDIT:
                                                $nOfSeatPress ++;
                                                break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }else{//se contiene palchi...
                    foreach ($p_v[$searchKey4] as $k_palco => $file){//Ciclo i palchi
                        if(isset($prenotazione[$k_p][$searchKey4][$k_palco])){//Verifico se esiste una prenotazione per quel palco
                            if(isset($file['fila'])){
                                foreach ($file['fila'] as $k_fila => $posti){//Ciclo le file
                                    foreach ($posti[$searchKey2] as $posto => $info){//Ciclo i posti
                                        //Verifico che esista la prenotazione per il posto specifico
                                        if(isset($prenotazione[$k_p][$searchKey4][$k_palco]['fila'][$k_fila][$searchKey2]) && array_search($posto, $prenotazione[$k_p][$searchKey4][$k_palco]['fila'][$k_fila][$searchKey2]) !== false){
                                            if(isset($info[$searchKey3])){
                                                switch ($info[$searchKey3]){
                                                    case self::STATO_PAYED:
                                                    case self::STATO_SUBSCRIPTION_PAYED:
                                                        $nOfSeatPaid ++;
                                                        break;
                                                    case self::STATO_NOT_PAYED:
                                                    case self::STATO_SUBSCRIPTION_NOT_PAYED:
                                                        $nOfSeatNotPaid ++;
                                                        break;
                                                    case self::STATO_CREDIT:
                                                        $nOfSeatPress ++;
                                                        break;
                                                }
                                            }
                                        }
                                    }
                                }
                            }else{
                                foreach ($file as $k => $v){
                                    $nOfSeatNotPaid += $prenotazione[$k_p][$searchKey4][$k_palco]['non_numerato'];//conto i posti non numerati e non pagati
                                    $nOfSeatPaid    += $v['posti_pagati'];
                                }
                            }
                        }
                    }   
                }
            }
        }
        
        return [
            'nOfSeatPaid'       => $nOfSeatPaid,
            'nOfSeatNotPaid'    => $nOfSeatNotPaid,
            'nOfSeatPress'      => $nOfSeatPress,
            'tot'               => $nOfSeatPaid+$nOfSeatNotPaid+$nOfSeatPress,
        ];
    }
    
    /**
     * Visualizza la legenda della mappa
     * 
     * 
     * @param bool $guest Se <b>true</b> visualizza la legenda per il cliente.
     *                       Se <b>false</b> visualizza la legenda per l'amministratore.
     * @param bool $complete Se <b>true</b> visualizza la legenda completa.
     *                       Se <b>false</b> visualizza la legenda limitata.
     */
    public static function legend(bool $guest = false, bool $complete = false){
        echo '<svg width="100%" height="200" xmlns="http://www.w3.org/2000/svg">';
            echo '<circle class="" r="5" stroke-width="4" cx="10" cy="10" fill="'. self::COLOR_FREE.'"  stroke="'. self::COLOR_FREE.'"/>';
            echo '<text x="20" y="15">'.Yii::t('app', 'Posti liberi').'</text>';
            
            echo '<circle class="" r="5" stroke-width="4" cx="10" cy="30" fill="'. self::COLOR_BOOKED.'"  stroke="'. self::COLOR_BOOKED.'"/>';
            echo '<text x="20" y="35">'.Yii::t('app', 'Posti prenotati').'</text>';
            
            if($guest){
                echo '<circle class="" r="5" stroke-width="4" cx="10" cy="50" fill="'. self::COLOR_PAYED.'"  stroke="'. self::COLOR_PAYED.'"/>';
                echo '<text x="20" y="55">'.Yii::t('app', 'Posti occupati').'</text>';
            }else{
                echo '<circle class="" r="5" stroke-width="4" cx="10" cy="50" fill="'. self::COLOR_PAYED.'"  stroke="'. self::COLOR_PAYED.'"/>';
                echo '<text x="20" y="55">'.Yii::t('app', 'Posti pagati').'</text>';
            }
            
            if($complete){
                echo '<circle class="" r="5" stroke-width="4" cx="10" cy="70" fill="'. self::COLOR_CREDIT.'"  stroke="'. self::COLOR_CREDIT.'"/>';
                echo '<text x="20" y="75">'.Yii::t('app', 'Posto riservato per la stampa').'</text>';

                echo '<circle class="" r="5" stroke-width="4" cx="10" cy="90" fill="'. self::COLOR_CREDIT_THEATRE.'"  stroke="'. self::COLOR_CREDIT_THEATRE.'"/>';
                echo '<text x="20" y="95">'.Yii::t('app', 'Posto riservato per la compagnia').'</text>';

                echo '<circle class="" r="5" stroke-width="4" cx="10" cy="110" fill="'. self::COLOR_CREDIT_JURYMAN.'"  stroke="'. self::COLOR_CREDIT_JURYMAN.'"/>';
                echo '<text x="20" y="115">'.Yii::t('app', 'Posto riservato per la giuria').'</text>';

                echo '<circle class="" r="5" stroke-width="4" cx="10" cy="130" fill="'. self::COLOR_CREDIT_SPONSOR.'"  stroke="'. self::COLOR_CREDIT_SPONSOR.'"/>';
                echo '<text x="20" y="135">'.Yii::t('app', 'Posto riservato per gli sponsor').'</text>';
                
                echo '<circle class="" r="5" stroke-width="4" cx="10" cy="150" fill="'. self::COLOR_MY_BOOKED.'"  stroke="black"/>';
                echo '<text x="20" y="155">'.Yii::t('app', 'Prenotazioni del cliente').'</text>';

                echo '<circle class="" r="5" stroke-width="4" cx="10" cy="170" fill="'. self::COLOR_MY_BOOKED.'"  stroke="'. self::COLOR_PAYED.'"/>';
                echo '<text x="20" y="175">'.Yii::t('app', 'Prenotazioni del cliente pagate').'</text>';

                echo '<circle class="" r="5" stroke-width="4" cx="10" cy="190" fill="'. self::COLOR_SUBSCRIPTION.'"  stroke="'. self::COLOR_SUBSCRIPTION.'"/>';
                echo '<text x="20" y="195">'.Yii::t('app', 'Abbonamento non pagato').'</text>';

                echo '<circle class="" r="5" stroke-width="4" cx="10" cy="210" fill="'. self::COLOR_SUBSCRIPTION.'"  stroke="'. self::COLOR_PAYED.'"/>';
                echo '<text x="20" y="215">'.Yii::t('app', 'Abbonamento pagato').'</text>';
            }
        echo '</svg>';
    }


    /**
     * Aggiorna la piantina delle prenotazioni per gli ordini.
     * 
     * @param array $ordine          Dati dell'ordine
     * @param array $prenotazione    Dati della prenotazione
     * @param array $piantina        Piantina da aggiornare
     * @return array Piantina aggiornata
     */
    private static function updatePrenotazioneOrdini(array $ordine, array $prenotazione, array $piantina, string $tipo){
        $stati_posti_prenotati = [];
        foreach ($ordine['palco'] as $palco => $file){
            //echo "2) updatePrenotazioneOrdini<br />";
            if(isset($file['fila'])){//Per palchi numerati
                //echo "2.1) Palco numerato => <b>$palco</b><br />";
                
                $tmp = self::updatePosti($file['fila'], null, $prenotazione, $piantina, $tipo, $palco);
                
                if(sizeof($tmp) > 0){
                    $stati_posti_prenotati[$tipo][] = $tmp['stato_posti_prenotati'];
                    $piantina                          = $tmp['piantina'];
                }
            }else{//Per palchi non numerati
                //echo "2.1) Palco non numerato => <b>$palco</b><br />";
            }
            
            $piantina = self::restoreStato($piantina, $stati_posti_prenotati);
        }
        
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
    private static function updatePrenotazionePlatea($platea, array $prenotazione, $piantina){
        $stati_posti_prenotati = [];
        foreach($platea->file as $fila => $a_posti_fila){            
            $tmp = self::updatePosti($a_posti_fila, $fila, $prenotazione, $piantina);
            if(sizeof($tmp) > 0){
                $stati_posti_prenotati['platea'][] = $tmp['stato_posti_prenotati'];
                $piantina                          = $tmp['piantina'];
            }
        }
        
        //$piantina = self::restoreStato($piantina, $stati_posti_prenotati);
        
        
        return $piantina;
    }
    
    /**
     * Aggiorna i posti
     * 
     * @param $posti           Array dei posti
     * @param string|int $fila       Fila a cui si riferiscono i posti. 
     *                               Vale null per gli ordini.
     * @param array $prenotazione    Dati della prenotazione
     * @param $piantina        Piantina da aggiornare
     * @param string $tipo           Tipo da aggiornare (platea, I Ordine, ...)
     * @param int $palco             Numero del palco (non usato nella platea)
     * @return array Piantina aggiornata
     */
    private static function updatePosti($posti, $fila, array $prenotazione, $piantina, $tipo = "platea", $palco = null){
        $res = [];
        
        if($fila <> null){//Platea
            foreach ($posti->posti as $posto => $dati_posto){
                if(isset($dati_posto->stato)){
                    $res = self::deleteStato($prenotazione, $fila, $posto, $piantina);
                }
            }
        }else{//Ordini
            foreach ($posti as $fila => $v_posti){                
                foreach ($v_posti['posti'] as $posto => $dati_posto){
                    if(isset($dati_posto['stato'])){
                        //echo "3) updatePosti() <b>$tipo</b> [con stato prenotato]<br />";
                        
                        $res = self::deleteStato($prenotazione, $fila, $posto, $piantina, $tipo, $palco);
                    }
                }
            } 
       }
        
        /*echo "<pre>";
        print_r($res);
        echo "</pre>";*/
        
        return $res;
    }
    
    /**
     * Cancella lo stato per le prenotazioni cancellate.
     * Viene ripristinata la piantina liberando i posti.
     * 
     * @param array $prenotazione    Dati della prenotazione
     * @param string|int $fila       Fila a cui si riferiscono i posti
     * @param int $posto             Posto della fila
     * @param $piantina        Dati della prenotazione
     * @param mixed $tipo           Indica il tipo della piantina (platea, I Ordine, ecc.)
     * @param mixed $palco             Numero del palco (non usato nella platea)
     * @return type
     */
    private static function deleteStato(array $prenotazione, $fila, $posto, $piantina, $tipo = "platea", $palco = null){        
        //Salvo gli stati dei posti prenotati
        $stati_posti_prenotati = [];        
        if(isset($prenotazione[$tipo]['file'][$fila]['posti'])){
            foreach ($prenotazione[$tipo]['file'][$fila]['posti'] as $k_posto => $v_posto){
                /*echo "<pre>";
                print_r($piantina->$tipo->file->$fila->posti->posto->stato);
                echo "</pre>";
                return array();*/
                
                //if(isset($piantina[$tipo]['file'][$fila]['posti'][$posto]['stato'])){
                if(isset($piantina->$tipo->file->$fila->posti->posto->stato)){
                    $stati_posti_prenotati[$tipo][$fila][$v_posto] = $piantina[$tipo]['file'][$fila]['posti'][$posto]['stato'];
                }
            }
        }else if(isset ($piantina->$tipo->palco->$palco->fila->$fila->posti->$posto->stato)){//Ordini
            //echo "4) deleteStato() <br />";
            $stati_posti_prenotati[$tipo][][$palco][$fila][$posto] = $piantina[$tipo]['palco'][$palco]['fila'][$fila]['posti'][$posto]['stato'];
        }
        
        //Rimuovo tutti gli stati
        if(strtolower($tipo) == "platea"){            
            foreach ($piantina->$tipo->file->$fila->posti as $k_posto => $v_posto){
                unset($piantina->$tipo->file->$fila->posti->$k_posto->stato);
            }
        }else{//Ordini
            foreach ($piantina[$tipo]['palco'][$palco]['fila'][$fila]['posti'] as $k_posto => $v_posto){
                //echo "$tipo => Palco $palco Fila $fila Posto $k_posto<br />";
                
                unset($piantina[$tipo]['palco'][$palco]['fila'][$fila]['posti'][$k_posto]['stato']);
            }
        }
        
        
        return [
            'stato_posti_prenotati' => $stati_posti_prenotati,
            'piantina'             => $piantina,
        ];
    }
    
    /**
     * Ripristina gli stati della piantina per tutti quei ticket prenotati e non
     * rimossi.
     * 
     * @param array $piantina           Piantina dello spettacolo
     * @param array $stati_prentazione  Array contenente gli stati da ripristinare
     *                                  nella piantina.
     * @return array Piantina con gli stati ripristinati
     */
    private static function restoreStato($piantina, array $stati_prentazione){
        //echo "5) restoreStato()<br />";
        
        /*echo "<pre>";
        print_r($stati_prentazione);
        echo "</pre>";*/

        foreach ($stati_prentazione as $k_prenotazione => $v_prenotazione){
            //echo $k_prenotazione;
            foreach ($v_prenotazione as $file_palchi){                
                if(isset($piantina->$k_prenotazione->file)){
                    foreach($file_palchi as $fila => $posti){
                        foreach ($posti as $posto => $stato){
                            $piantina[$k_prenotazione]['file'][$fila]['posti'][$posto]['stato'] = $stato;
                        }
                    }
                } else {
                    /*echo "<pre>";
                    print_r($file_palchi);
                    echo "</pre>";*/
                    
                    //[I Ordine]['palco'][$palco]['fila'][$fila]['posti'][$posto]['stato']
                    
                    foreach ($file_palchi[$k_prenotazione] as $palchi){
                        foreach ($palchi as $palco => $file){
                            foreach ($file as $fila => $posti){
                                foreach ($posti as $posto => $stato){
                                    //echo " ==> ", $palco, " - ", $fila, " - ", $posto, "<br />";
                                    //echo "$k_prenotazione => Palco $palco Fila $fila Posto $posto<br />";
                                    
                                    $piantina[$k_prenotazione]['palco'][$palco]['fila'][$fila]['posti'][$posto]['stato'] = $stato;
                                    
                                    //echo var_dump($piantina[$k_prenotazione]['palco'][$palco]['fila'][$fila]['posti'][$posto]['stato']);
                                    /*echo "<pre>";
                                    print_r($piantina[$k_prenotazione]['palco'][$palco]['fila'][$fila]['posti'][$posto]);
                                    echo "</pre>";*/
                                    
                                    /*echo "<pre>";
                                    print_r($piantina[$k_prenotazione]['palco'][$palco]['fila'][$fila]['posti'][$posto]);
                                    echo "</pre>";*/
                                    
                                    
                                    
                                }
                            }
                        }
                    }
                    
                    
                    
                }
            }
        }
        
        
        return $piantina;
    }
    
    /**
     * 
     * @param \stdClass $obj Oggetto da convertire in array
     */
    private static function objToArray(\stdClass $obj){
        $res = [];
        foreach ($obj as $key => $value){
            $res[$key] = $value;   
        }
    }
    
    
}