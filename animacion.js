$(document).ready(function() {
    var cajas = document.getElementsByClassName('caja');
    for (var i = 0; i < cajas.length; ++i) {

        cajas[i].addEventListener('focus', function() {
            var selector = '#' + this.id + '~label';
            $(selector).addClass('foco')
        })

        cajas[i].addEventListener('focusout', function() {
            if (this.value.length === 0) {
                var selector = '#' + this.id + '~label';
                $(selector).removeClass('foco')
            }

        })

        //ponemos de color rojo el contorno y el texto si la informacion no es correcta en tiempo real
        cajas[i].addEventListener('input', function() {
            if (this.validity.valid == false) {
                var selector = '#' + this.id;
                $(selector).css('border', ' 2px solid red')

                var selector = '#' + this.id + '~label';
                $(selector).css('color', 'red')

            } else {
                var selector = '#' + this.id;
                $(selector).css('border', ' 2px solid #2E86C1')

                var selector = '#' + this.id + '~label';
                $(selector).css('color', '#2E86C1')

            }

        })

    }

})