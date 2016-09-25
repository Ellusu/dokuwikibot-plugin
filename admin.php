<?php
/**
 * DokuWiki Plugin dokuwikibot (Admin Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Matteo Enna <matteo.enna89@gmail.com>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

class admin_plugin_dokuwikibot extends DokuWiki_Admin_Plugin {

    /**
     * @return int sort number in admin menu
     */
    public function getMenuSort() {
        return 2;
    }

    /**
     * @return bool true if only access for superuser, false is for superusers and moderators
     */
    public function forAdminOnly() {
        return true;
    }

    /**
     * Should carry out any processing required by the plugin.
     */
    public function handle() {
    }

    /**
     * Render HTML output, e.g. helpful text and a form
     */
    public function html() {
        global $INPUT;
        global $conf;
        
        $doku_file = DOKU_CONF.'dokuwikibot_conf.json';
        
        if(!file_exists(DOKU_CONF.'dokuwikibot_conf.json') || file_get_contents(DOKU_CONF.'dokuwikibot_conf.json')==""){
            $array=array(
                'conf' => array(
                    'BOT_TOKEN'             => '[<token-bot>]',
                   // 'API_URL'               => 'https://api.telegram.org/bot'.BOT_TOKEN.'/'                    
                ),
                'advanced' => array(
                    'dir_doku'              => DOKU_BASE,
                    'doku_data'             => $conf['datadir']
                    
                ),
                'default_message' => array(
                    'type_error_message'    => "Formato sbagliato, digita un semplice messaggio",
                    'welcome_message'       => "Benvenuto nel mio bot",
                    'help_message'          => "Questa è la lista delle funzionalità",    
                    'unknown_request'       => "richiesta sconosciuta",
                    'unknown_page'          => "pagina inesistente",
                    'unknown_column'        => "colonna inesistente",
                    'data_null'             => "nessun valore da cercare",
                    'search_null'           => "nessun valore trovato"                     
                )              
            );            
            
            $json_data = json_encode($array);
            //io_saveFile('lib/plugins/dokuwikibot/conf/conf.json',$json_data);
            
            $fp = fopen($doku_file, 'w');
            fwrite($fp, $json_data);
            fclose($fp);
            
        } else {
            $json_data = file_get_contents(DOKU_CONF.'dokuwikibot_conf.json');
            $array = json_decode($json_data,true);
        }
        
        
        if($INPUT->has('saved')){
            foreach ($array['conf'] as $key => $value){
                $array['conf'][$key]=$INPUT->post->str($key);
            }
            foreach ($array['default_message'] as $key_d => $value_d){
                $array['default_message'][$key_d]=$INPUT->post->str($key_d);                
            }
            foreach ($array['advanced'] as $key_a => $value_a){
                $array['advanced'][$key_a]=$INPUT->post->str($key_a);                
            }
            
            $json_data = json_encode($array);
            //io_saveFile('lib/plugins/dokuwikibot/conf/conf.json',$json_data);            
            
            $fp = fopen($doku_file, 'w');
            fwrite($fp, $json_data);
            fclose($fp);
        }
        ptln("<form action=\"\" method=\"post\">");
        ptln('<h1>'.$this->getLang('menu').'</h1>');
        ptln('<table>');
        foreach ($array['conf'] as $key => $value){
            ptln('<tr>');
            ptln('<td>');
            ptln($key);
            ptln('</td>');
            ptln('<td>');
            ptln('<input type="text" name="'.$key.'" class="edit" value="'.$value.'" /> ');
            ptln('</td>');
            ptln("</tr>");
        }
        ptln('</table>');
        ptln('<table>');
        foreach ($array['default_message'] as $key => $value){
            ptln('<tr>');
            ptln('<td>');
            ptln($key);
            ptln('</td>');
            ptln('<td>');
            ptln('<input type="text" name="'.$key.'" class="edit" value="'.$value.'" /> ');
            ptln('</td>');
            ptln("</tr>");
        }
        ptln('</table>');
        ptln('<table>');
        foreach ($array['advanced'] as $key => $value){
            ptln('<tr>');
            ptln('<td>');
            ptln($key);
            ptln('</td>');
            ptln('<td>');
            ptln('<input type="text" name="'.$key.'" class="edit" value="'.$value.'" /> ');
            ptln('</td>');
            ptln("</tr>");
        }
        ptln('</table>');
        ptln('<button type="submit" name="saved" >Salva</button> ');
        
        
        ptln("</form>");
        
        
        $url = $_SERVER['HTTP_HOST'].DOKU_BASE.'lib/plugins/dokuwikibot/telegram.php';
                
        $webhook = 'https://api.telegram.org/bot'.$array['conf']['BOT_TOKEN'].'/setwebhook?url='.$url;
        
        ptln("<br><br><br>The webhook is: ".$webhook);
        
    }
}

// vim:ts=4:sw=4:et:
