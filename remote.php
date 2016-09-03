<?php
/**
 * DokuWiki Plugin dokuwikibot (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Matteo Enna <matteo.enna89@gmail.com>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

class remote_plugin_dokuwikibot extends DokuWiki_Remote_Plugin {

    /**
     * Register RPC methods and their arguments
     */
    public function _getMethods() {
        return array(
            // FIXME adjust
            'plugin.dokuwikibot.myFunction' => array(
                'args'   => array('string'),
                'return' => 'string',
                'doc'    => 'Description of the function'
            ),
            // add more methods here
        );
    }

    /**
     * Example function
     */
    function myExample($id) {
        // FIXME handle security in your method!
        $id = cleanID($id);
        if(auth_quickaclcheck($id) < AUTH_READ){
            throw new RemoteAccessDeniedException('You are not allowed to read this file', 111);
        }

        return 'example';
    }
}

// vim:ts=4:sw=4:et:
