// JavaScript Document
function calcRepay()  {
  var repay=document.getElementById('repay');
  var principal=document.getElementById('principal').value.replace(/,/g, "");
  principal=principal.replace(/\$/g, "");
  var int_rate=document.getElementById('int_rate').value.replace(/%/g, "");
  var freq=document.getElementById('freq').value;
  var term=document.getElementById('term').value;
  if(!(term>0 && term<100))  { term=25; document.getElementById('term').value=25; }
  var piType=document.getElementById('type').value;
  
  var mi = eval(int_rate / (freq*100));
  var base = 1;
  var mbase = 1 + mi;
  for (i=0; i<term * freq; i++)
  {
    base *= mbase;
  }
  
  if (piType == 'pi')  {
    repaymentAmount = Math.floor(principal * mi / ( 1 - (1/base))*Math.pow(10,0))/Math.pow(10,0);
  }
  else  {
    repaymentAmount = Math.floor((principal*mi)*Math.pow(10,0))/Math.pow(10,0);
  }
  
  if (repaymentAmount>=0)  {
    repay.value = repaymentAmount;
  }
  else  {
    repay.value = '';
  }
}