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
        
        $data['var'] = 'This page generated by Obullo Framework.';  
        $this->body  = view('view_welcome', $data);
        view_app('view_base_layout');
        
        view_layout(
            array(view('view_welcome', $data)), 
            'view_base_layout'
            );
        
    }
    
}

/* End of file start.php */
/* Location: .application/welcome/controllers/start.php */