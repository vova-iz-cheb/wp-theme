$(function() {
  $('.nav__toggler').click(function() {
  	var nav = document.getElementsByClassName('nav')[0];
  	var height = nav.scrollHeight;

  	//если максимальная высота блока nav равна 0(default), то максимальная
  	//высота nav становится высоте прокрутки блоки
  	if(nav.style.maxHeight) nav.style.maxHeight = null;
  	else nav.style.maxHeight = height + 'px';
  });

  if( $('.comment-edit-link').length ) {
  	$('.comment-edit-link').text('Изменить');
  }

  if( $('.reg__button').length ) {
    $('.reg__button').click(function() {
      $('body').addClass('overflow-h');
      $('.bg-dark').show();
    });

    $('.reg__close').click(function() {
      $('body').removeClass('overflow-h');
      $('.bg-dark').hide();
    });
  }
});