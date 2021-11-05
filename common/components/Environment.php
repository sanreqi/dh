<?php


class Environment {

    private $_host = 'localhost';
    private $_configDir = '.';
    private $_searchDir = '.';
    private $_isWebApp = true;
    private $_env = null;

    public function setHost($host) {
        $this->_host = $host;
    }

    public function setConfigDir($dir) {
        $this->_configDir = $dir;
    }

    public function setSearchDir($dir) {
        $this->_searchDir = $dir;
    }

    public function setIsWebApp($isWeb = true) {
        $this->_isWebApp = $isWeb;
    }

    public function setEnv($env) {
        $this->_env = $env;
    }

    public function getEnvs() {
        return require($this->_configDir . 'envs.php');
    }

    public function getConfig() {
        $env = $this->_detectEnv();
        $config = $this->_mergeArray($this->_getConfigParams(), $this->_getConfigParams($env));
        if (!isset($config['params'])) {
            $config['params'] = array();
        }
        $config['params']['env'] = $env;

        return $config;
    }

    private function _detectEnv() {
        // for console applications
        if (!is_null($this->_env))
            return $this->_env;
        foreach ($this->getEnvs() as $domain => $env) {
            if (preg_match($this->_getDomainPattern($domain), $this->_host)) {
                return $env;
            }
        }
    }

    private function _getDomainPattern($domain) {
        return '#^' . str_replace('\*', '.+?', preg_quote($domain)) . '$#is';
    }

    private function _getConfigParams($configType = null) {
        $appPrefix = ($this->_isWebApp) ? 'main' : 'console';

        if (is_null($configType))
            return require($this->_searchDir . $appPrefix . '.php');

        return require($this->_searchDir . $appPrefix . '-' . $configType . '.php');
    }

    /**
     * Merge 2 arrays
     *
     * Copy of CMap::mergeArray
     * framework/collections/CMap.php#275
     *
     * @param $a
     * @param $b
     * @return array
     */
    private function _mergeArray($a, $b) {
        foreach ($b as $k => $v) {
            if (is_integer($k))
                isset($a[$k]) ? $a[] = $v : $a[$k] = $v;
            else if (is_array($v) && isset($a[$k]) && is_array($a[$k]))
                $a[$k] = $this->_mergeArray($a[$k], $v);
            else
                $a[$k] = $v;
        }
        return $a;
    }

}
