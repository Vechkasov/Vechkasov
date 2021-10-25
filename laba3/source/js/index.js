function minus() {
    let vale = $('.catalog-detail__qt-field').val();
    if (vale > 1)
        vale--;
    $('.catalog-detail__qt-field').val(vale);
}

function plus() {
    let vale = $('.catalog-detail__qt-field').val();
    vale++;
    $('.catalog-detail__qt-field').val(vale);
}

function one() {
    $('.oneText').css({
        'display':'block'
    });
    $('.twoText').css({
        'display':'none'
    });
    $('.threeText').css({
        'display':'none'
    });
}

function two() {
    $('.oneText').css({
        'display':'none'
    });
    $('.twoText').css({
        'display':'block'
    });
    $('.threeText').css({
        'display':'none'
    });
}

function three() {
    $('.oneText').css({
        'display':'none'
    });
    $('.twoText').css({
        'display':'none'
    });
    $('.threeText').css({
        'display':'block'
    });
}

window.onload = function()
{
    // Для 1-ой лабы
    $('.oneText').css({
        'display':'block'
    });
    $('.twoText').css({
        'display':'none'
    });
    $('.threeText').css({
        'display':'none'
    });
}
