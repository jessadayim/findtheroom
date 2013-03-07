<!--//
// last modified: 04.08.2010

function onMouseClickRow(unique_prefix, row_id, row_color, row_color_light, row_color_dark){
   if((row_id % 2) == 0) row_color_back = row_color_dark;
   else row_color_back = row_color_light;
   var row_el  = (document.getElementById(unique_prefix+'row_'+row_id)) ? document.getElementById(unique_prefix+'row_'+row_id) : null;
   if(document.getElementById(unique_prefix+'checkbox_'+row_id)){
      if(document.getElementById(unique_prefix+'checkbox_'+row_id).checked == true){
         document.getElementById(unique_prefix+'checkbox_'+row_id).checked = false;
         if(row_el) row_el.style.background = row_color_back;
      }else{
         document.getElementById(unique_prefix+'checkbox_'+row_id).checked = true;
         if(row_el) row_el.style.background = row_color;
      }
   }else{
      if(row_el) row_el.style.background = row_color;
   }
}

function onMouseOverRow(unique_prefix, row_id, row_color, row_selected_color_dark){
   var row_el  = (document.getElementById(unique_prefix+'row_'+row_id)) ? document.getElementById(unique_prefix+'row_'+row_id) : null;
   if(document.getElementById(unique_prefix+'checkbox_'+row_id)){
      if(document.getElementById(unique_prefix+'checkbox_'+row_id).checked != true){
         row_el.style.background = row_color;
      }else{
         row_el.style.background = row_selected_color_dark;                    
      }
   }else{
      row_el.style.background = row_color;
   }
}            

function onMouseOutRow(unique_prefix, row_id, row_color, row_color_selected){
   var row_el  = (document.getElementById(unique_prefix+'row_'+row_id)) ? document.getElementById(unique_prefix+'row_'+row_id) : null;
   if(document.getElementById(unique_prefix+'checkbox_'+row_id)){
      if(document.getElementById(unique_prefix+'checkbox_'+row_id).checked != true){
         row_el.style.background = row_color;
      }else{
         row_el.style.background = row_color_selected;
      }
   }else{
      row_el.style.background = row_color;
   }
}            

//-->