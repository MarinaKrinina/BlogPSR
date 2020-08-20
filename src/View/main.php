 <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
 <script>
$(document).ready(function() {
    function createElements(result) {
      $('#articles').empty();
      for (var i=0; i<result.length; i++) {
           $('<div/>', {
               'class': 'article',
               value: result[i].id,
               on: {
                   click: function() {
                       location.href = '/article/showOne?id=' + $(this).val();
                   }
               }
           }).appendTo('#articles')
           .append($('<div>', {
               'class': 'articleDate',
               text: result[i].date
           }))
           .append($('<div>', {
               'class': 'articleTitle',
               text: result[i].title
           }))
           .append($('<div>', {
               'class': 'articleRate',
               text: 'Оценка '+result[i].rate
           }));
           
      }
    }

    $.get('/article/showAllAjax', function(result) {
        createElements(JSON.parse(result));
    });

    $("[name='sortArticles']").change(function(){
        $.get('/article/showAllAjax', {sortBy: this.value}, function(result) {
            createElements(JSON.parse(result));
        });
    });
});
 </script>
<h1>Блог</h1>
 <div id="sortArticles">
 Сортировать по:
 <input type="radio" name="sortArticles" value="rate" id="sortByRate" checked />
 <label for="sortByRate">рейтингу</label>
 <input type="radio" name="sortArticles" value="date"  id="sortByDate" />
 <label for="sortByDate">новизне</label>
 </div>
 <div id="articles">
 </div>