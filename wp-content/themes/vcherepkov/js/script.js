$(function() {
  $('.nav__toggler').click(function() {
  	var nav = document.getElementsByClassName('nav')[0];
  	var height = nav.scrollHeight;

  	//если максимальная высота блока nav равна 0(default), то максимальная
  	//высота nav становится высоте прокрутки блоки
  	if(nav.style.maxHeight) nav.style.maxHeight = null;
  	else nav.style.maxHeight = height + 'px';
  })
});