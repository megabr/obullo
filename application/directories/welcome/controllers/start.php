<?php      

Class Start extends Controller {
    
    function __construct()
    {   
        parent::__construct();
        parent::__global();
        
    }                               

    public function index()
    {       
        $this->title = 'Welcome to Obullo Framework !';
        
        $this->meta .= meta('keywords', 'obullo, php5, framework');   // You can manually set head tags
                                                                      // or globally using Global views. 
        $this->head .= js('welcome.js');  
        $this->head .= content::script('welcome'); 
        
        $data['sample_var'] = 'This page generated by Obullo Framework.';
        $this->body  = content::view('view_welcome', $data);
        
        content::app_view('view_base_layout');
    }
    
}
?>