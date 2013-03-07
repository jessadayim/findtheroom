<!--

var DataGrid = DataGrid || {};

// set the variable that indicates if javascript behaviors should be applied
DataGrid.jsEnabled = document.getElementsByTagName && document.createElement && document.createTextNode && document.documentElement && document.getElementById;

// returns the position of the mouse cursor based on the event object passed
DataGrid.mousePosition = function(e) {
  return { x: e.clientX + document.documentElement.scrollLeft, y: e.clientY + document.documentElement.scrollTop };
};

// global killswitch on the <html> element
if (DataGrid.jsEnabled) {
  document.documentElement.className = 'js';
}

DataGrid.textareaAttach = function() {
  $('textarea.resizable:not(.processed)').each(function() {
    var textarea = $(this).addClass('processed'), staticOffset = null;

    $(this).wrap('<div class="resizable-textarea"></div>')
      .parent().append($('<div class="grippie"></div>').mousedown(startDrag));

    var grippie = $('div.grippie', $(this).parent())[0];
    grippie.style.marginRight = (grippie.offsetWidth - $(this)[0].offsetWidth) +'px';

    function startDrag(e) {
      staticOffset = textarea.height() - DataGrid.mousePosition(e).y;
      textarea.css('opacity', 0.25);
      $(document).mousemove(performDrag).mouseup(endDrag);
      return false;
    }

    function performDrag(e) {
      textarea.height(Math.max(32, staticOffset + DataGrid.mousePosition(e).y) + 'px');
      return false;
    }

    function endDrag(e) {
      $(document).unbind('mousemove', performDrag).unbind('mouseup', endDrag);
      textarea.css('opacity', 1);
    }
  });
}

if (DataGrid.jsEnabled) {
  $(document).ready(DataGrid.textareaAttach);
}

// textarea maxlength checking
function setTaMaxLength() {
   var x = document.getElementsByTagName('textarea');
   var counter = document.createElement('span'); //div
   counter.className = 'counter';
   for (var i=0;i<x.length;i++) {
      if (x[i].getAttribute('maxlength')) {
         var counterClone = counter.cloneNode(true);
         counterClone.relatedElement = x[i];
         counterClone.innerHTML = '&nbsp;<span>0</span>/'+x[i].getAttribute('maxlength')+'&nbsp;';
         x[i].parentNode.insertBefore(counterClone,x[i].nextSibling);
         x[i].relatedElement = counterClone.getElementsByTagName('span')[0];
         x[i].onkeyup = x[i].onchange = checkMaxLength;
         x[i].onkeyup();
      }
   }
}

function checkMaxLength() {
   var maxLength = this.getAttribute('maxlength');
   var currentLength = this.value.length;
   
   if (currentLength > maxLength){
      this.relatedElement.className = 'toomuch';
      this.value = this.value.substring(0,maxLength);
      currentLength = maxLength;   
   }else{
      this.relatedElement.className = '';
   }
   this.relatedElement.firstChild.nodeValue = currentLength;   
   // not innerHTML
}

_dgAddDgLoadEvent(setTaMaxLength);

//-->