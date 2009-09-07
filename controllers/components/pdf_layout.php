<?php
Class PdfLayoutComponent extends Object{
    public $Controller;
    
    protected $_settings = array(
        'debug' => '2',
        'ext' => 'pdf',
        'reUseNormalView' => true,
    );
    
	public function initialize(&$Controller, $settings=array()) {
        $this->_settings = am($this->_settings, $settings);

        // Make it an integer always
        $this->_settings['debug'] = (int)$this->_settings['debug'];
    }
    
	public function startup(&$Controller) {
		$this->Controller = &$Controller;
        
        if ($this->Controller->params['url']['ext'] === $this->_settings['ext']) {
            Configure::write('debug', $this->_settings['debug']);
            $this->Controller->set('debug', $this->_settings['debug']);
            
            // Layout from plugin
            $this->Controller->plugin = 'pdfview';

            // View from user's app
            if ($this->_settings['reUseNormalView']) {
                $this->Controller->viewPath = str_replace('/'.$this->_settings['ext'], '', $this->Controller->viewPath);
            }
        }
    }
}
?>