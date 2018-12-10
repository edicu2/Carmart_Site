
var pusher = new Pusher('24c705f4fc6e5505c88a', {
    cluster: 'ap1',
    encrypted: true,
});
// "comment" is channel name
var channel = pusher.subscribe('keywords');
// "new-reply" is the event name of "comment" channel
channel.bind('new-reply', function(data) {
    $('span#search_many').empty();
    $.each(data.data, function(index,value){
        appendComment(value);
    });
    // method used to dynamic append data into dom
});

function appendComment(keyword) {
    if(typeof keyword.keyword == undefined || keyword.keyword >= 0){
        return false;
    }
    var search_keyword ='<a id="rank_a">'+keyword.keyword+'</a>';
    $('span#search_many').append(search_keyword);
    return search_keyword;
}

function getLastComment(){
    $.ajax({
        url: '/GetKeyword',
        method: 'GET',
        dataType: 'json',
        success: function(data){
        }
    });
}getLastComment(); // execute when page reload

// when refresh button click call method
