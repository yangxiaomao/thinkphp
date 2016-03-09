var g_bMoveLeft=true;  
var g_oTimer=null;  
var g_oTimerOut=null;  
  
var g_iSpeed=3;  
  
window.onload=function ()  
{  
    var oDiv=document.getElementById('roll');  
    var oUl=oDiv.getElementsByTagName('ul')[0];  
    var aLi=oUl.getElementsByTagName('li');//获取<ul>标签中所有的<li>元素  
    var aA=oDiv.getElementsByTagName('a');//获取<ul>标签中所有的<a>元素  
    var i=0;  
    var str=oUl.innerHTML+oUl.innerHTML;//两组 <li>元素  
    oUl.innerHTML=str;  
    oUl.style.width=aLi[0].offsetWidth*aLi.length+'px';//两组<li>标签的总宽度  
    for(i=0;i<aLi.length;i++){  
        aLi[i].onmouseover=function (){  
            stopMove();//鼠标移上去时停止移动  
        };  
          
        aLi[i].onmouseout=function (){  
            startMove(g_bMoveLeft);//开始向左移动  
        };  
    }  
      
    aA[0].onmouseover=function (){  
        startMove(true);  
    };  
      
    aA[1].onmouseover=function (){  
        startMove(false);  
    };  
      
    startMove(true);  
};  
  
function startMove(bLeft){  
    g_bMoveLeft=bLeft;    
    if(g_oTimer){  
        clearInterval(g_oTimer);  
    }  
    g_oTimer=setInterval(doMove, 30);  
}  
  
function stopMove(){  
    clearInterval(g_oTimer);  
    g_oTimer=null;  
}  
  
function doMove(){  
    var oDiv=document.getElementById('roll');  
    var oUl=oDiv.getElementsByTagName('ul')[0];  
    var aLi=oUl.getElementsByTagName('li');  
    var l=oUl.offsetLeft;  
    if(g_bMoveLeft){  
        l-=g_iSpeed;  
        if(l<=-oUl.offsetWidth/2){  
            l+=oUl.offsetWidth/2;  
        }  
    }else{  
        l+=g_iSpeed;  
        if(l>=0){  
            l-=oUl.offsetWidth/2;  
        }  
    }  
    oUl.style.left=l+'px';  
}  