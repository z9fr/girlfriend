function renderTip(template, context) {
    var tokenReg = /(\\)?\{([^\{\}\\]+)(\\)?\}/g;
    return template.replace(tokenReg, function (word, slash1, token, slash2) {
        if (slash1 || slash2) {
            return word.replace('\\', '');
        }
        var variables = token.replace(/\s/g, '').split('.');
        var currentObject = context;
        var i, length, variable;
        for (i = 0, length = variables.length; i < length; ++i) {
            variable = variables[i];
            currentObject = currentObject[variable];
            if (currentObject === undefined || currentObject === null) return '';
        }
        return currentObject;
    });
}

String.prototype.renderTip = function (context) {
    return renderTip(this, context);
};

var re = /x/;
console.log(re);
re.toString = function() {
    showMessage('Haha, you opened the console, do you want to see my secret? ', 5000);
    return '';
};

$(document).on('copy', function (){
    showMessage('What have you copied? Remember to add the source when reprinting', 5000);
});

function initTips(){
    $.ajax({
        cache: true,
        url: `${message_Path}message.json`,
        dataType: "json",
        success: function (result){
            $.each(result.mouseover, function (index, tips){
                $(tips.selector).mouseover(function (){
                    var text = tips.text;
                    if(Array.isArray(tips.text)) text = tips.text[Math.floor(Math.random() * tips.text.length + 1)-1];
                    text = text.renderTip({text: $(this).text()});
                    showMessage(text, 3000);
                });
            });
            $.each(result.click, function (index, tips){
                $(tips.selector).click(function (){
                    var text = tips.text;
                    if(Array.isArray(tips.text)) text = tips.text[Math.floor(Math.random() * tips.text.length + 1)-1];
                    text = text.renderTip({text: $(this).text()});
                    showMessage(text, 3000);
                });
            });
        }
    });
}
initTips();

(function (){
    var text;
    if(document.referrer !== ''){
        var referrer = document.createElement('a');
        referrer.href = document.referrer;
        text = 'Hello! Welcome to  <span style="color:#0099cc;">' + referrer.hostname + '</span> friend!';
        var domain = referrer.hostname.split('.')[1];
        if (domain == 'baidu') {
              // Hi! Friends from baidu Search! <br>Welcome to visit 
            text = 'Hi! Friends from baidu Search! <br>Welcome to visit <span style="color:#0099cc;">「 ' + document.title.split(' - ')[0] + ' 」</span>';
        }else if (domain == 'so') {
            // Hi! Friends from 360 Search! <br>Welcome to visit 
            text = 'Hi! Friends from 360 Search! <br>Welcome to visit <span style="color:#0099cc;">「 ' + document.title.split(' - ')[0] + ' 」</span>';
        }else if (domain == 'google') {
            // Hi! Friends from Google Search! <br>Welcome to visit 
            text = ' Hi! Friends from Google Search! <br>Welcome to visit  <span style="color:#0099cc;">「 ' + document.title.split(' - ')[0] + ' 」</span>';
        }
    }else {
        if (window.location.href == `${home_Path}`) { //Home page URL judgment, need to end with a slash 
            var now = (new Date()).getHours();
            if (now > 23 || now <= 5) {
                text = "Are you a night owl? If you haven't gone to bed so late, will you get up tomorrow? ";
            } else if (now > 5 && now <= 7) {
                text = "Good morning! The plan for a day lies in the morning, and a beautiful day is about to begin! ";
            } else if (now > 7 && now <= 11) {
                text = "good morning! Work well, don't sit for a long time, get up and move around! ";
            } else if (now > 11 && now <= 14) {
                text = "It's noon, it's been working all morning, and it's lunch time! ";
            } else if (now > 14 && now <= 17) {
                text = "It's easy to get sleepy in the afternoon. Have you achieved today's sports goal? ";
            } else if (now > 17 && now <= 19) {
                text = "It's evening! The sunset outside the window is very beautiful, the most beautiful but the sunset is red~~ ";
            } else if (now > 19 && now <= 21) {
                text = "Good evening, how are you doing today? ";
            } else if (now > 21 && now <= 23) {
                text = "It's already so late, rest early, good night~~ ";
            } else {
                text = "Hi~ Come and play with me! ";
            }
        }else {
            text = 'Welcome to read <span style="color:#0099cc;">「 ' + document.title.split(' - ')[0] + ' 」</span>';
        }
    }
    showMessage(text, 12000);
})();

window.setInterval(showHitokoto,30000);

function showHitokoto(){
    $.getJSON('https://v1.hitokoto.cn/',function(result){
        showMessage(result.hitokoto, 5000);
    });
}

function showMessage(text, timeout){
    if(Array.isArray(text)) text = text[Math.floor(Math.random() * text.length + 1)-1];
    //console.log('showMessage', text);
    $('.message').stop();
    $('.message').html(text).fadeTo(200, 1);
    if (timeout === null) timeout = 5000;
    hideMessage(timeout);
}

function hideMessage(timeout){
    $('.message').stop().css('opacity',1);
    if (timeout === null) timeout = 5000;
    $('.message').delay(timeout).fadeTo(200, 0);
}

function initLive2d (){
    $('.hide-button').fadeOut(0).on('click', () => {
        $('#landlord').css('display', 'none')
    })
    $('#landlord').hover(() => {
        $('.hide-button').fadeIn(600)
    }, () => {
        $('.hide-button').fadeOut(600)
    })
}
initLive2d ();
