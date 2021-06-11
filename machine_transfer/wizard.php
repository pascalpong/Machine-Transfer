<? 
    

?>

<ul class="progress-indicator">
    <li class="completed">
        <a href="iss_form?tx_id=<? echo $_GET["tx_code"];  ?>" >
            <span class="bubble"></span>
            ใบเบิก 
        </a>
    </li>
    
    <li  class="<? if($chkedit == true){ echo "completed";} ?>">
         <a 
             <? if($chkedit == 2){  ?>
             href="pm_form_step2?pm=<? echo $_GET["pm"];  ?>" 
             <?  }  ?>
             
             >
        <span class="bubble"></span>
       เลือกอะไหล่
         </a>
    </li>
    
      
    <li  class="<? if($chkedit == true){ echo "completed";} ?>">
         <a 
             <? if($chkedit == 2){  ?>
             href="pm_form_step2?pm=<? echo $_GET["pm"];  ?>" 
             <?  }  ?>
             
             >
        <span class="bubble"></span>
       เลือกอะไหล่
         </a>
    </li>
    
   
</ul>