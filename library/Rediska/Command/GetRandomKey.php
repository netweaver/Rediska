<?php

/**
 * Return a random key from the key space
 * 
 * @author Ivan Shumkov
 * @package Rediska
 * @version @package_version@
 * @link http://rediska.geometria-lab.net
 * @licence http://www.opensource.org/licenses/bsd-license.php
 */
class Rediska_Command_GetRandomKey extends Rediska_Command_Abstract
{
    /**
     * Create command
     *
     * @return Rediska_Connection_Exec
     */
    public function create()
    {
        $connections = $this->_rediska->getConnections();
        $index = rand(0, count($connections) - 1);
        $connection = $connections[$index];

        $command = "RANDOMKEY";

        return new Rediska_Connection_Exec($connection, $command);
    }

    /**
     * Parse response
     *
     * @param string $response
     * @return string|null
     */
    public function parseResponse($response)
    {
        if ($response == '') {
            return null;
        } else {
            if (strpos($response, $this->_rediska->getOption('namespace')) === 0) {
                $response = substr($response, strlen($this->_rediska->getOption('namespace')));
            }

            return $response;
        }
    }
}