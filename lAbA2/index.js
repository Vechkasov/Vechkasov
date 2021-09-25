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
    $('.onetext').css({
        'display':'block'
    });
    $('.twotext').css({
        'display':'none'
    });
    $('.threetext').css({
        'display':'none'
    });
}

function two() {
    $('.onetext').css({
        'display':'none'
    });
    $('.twotext').css({
        'display':'block'
    });
    $('.threetext').css({
        'display':'none'
    });
}

function three() {
    $('.onetext').css({
        'display':'none'
    });
    $('.twotext').css({
        'display':'none'
    });
    $('.threetext').css({
        'display':'block'
    });
}