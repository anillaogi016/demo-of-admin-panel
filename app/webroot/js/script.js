/*! jQuery Elevator - v1.0.6 - 2015
 * https://inzycle.github.com/jquery-elevator
 * Copyright (c) 2015 inZycle; Licensed MIT */

 var _elevator = null;

var _elevator_config = {
    item_top: $('#top-element'),
    item_bottom: $('#bottom-element'),
    align: 'bottom right',
    navigation: $('.section'),
    navigation_text: true,
    speed: 2000,
    shape: 'circle',
    glass: false,
    tooltips: true,
    onBeforeMove: function(){ showEvent('onBeforeMove'); },
    onAfterMove: function(){ showEvent('onAfterMove'); },
    onBeforeGoTop: function(){ showEvent('onBeforeGoTop'); },
    onAfterGoTop: function(){ showEvent('onAfterGoTop'); },
    onBeforeGoBottom: function(){ showEvent('onBeforeGoBottom'); },
    onAfterGoBottom: function(){ showEvent('onAfterGoBottom'); },
    onBeforeGoSection: function(){ showEvent('onBeforeGoSection'); },
    onAfterGoSection: function(){ showEvent('onAfterGoSection'); }
};


function showEvent(title){

    if ($('.controls-notifications input').is(':checked') ){
        var event_link = $('<span>').hide().text(title);
        $.when(
            event_link.appendTo('#events').fadeIn('slow')
        ).then(console.log(title));
        event_link.animate({
            opacity: 0
        }, 4000, function(){
            $(this).remove();
        });
    } else {
        return false;
    }

}