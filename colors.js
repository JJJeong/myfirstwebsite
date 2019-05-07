var Links = {
  setColor:function (color) {
    $('a').css('color', color);
  }
}
var Body = {
  setColor:function (color){
    $('body').css('color', color);
  },
  setBackgronudColor:function (color){
    $('body').css('backgroundColor', color);
  }
}

function nightDayHandler(self) {
  var target = document.querySelector('body');
  if (self.value === 'night') {
    Body.setBackgronudColor('black');
    Body.setColor ('white');
    self.value = 'day'
    Links.setColor('powderblue');
  } else {
    target.style.backgroundColor ='white';
    target.style.color ='black';
    self.value = 'night'
    Links.setColor('black');
  }
}
