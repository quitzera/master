$(function(){
  // timeago.js
  var timeagoInstance = timeago('','zh_CN');
  timeagoInstance.render(document.querySelectorAll('.show-time'));

  //无限滚动
    $(document).on("pageInit", "#page-infinite-scroll-bottom", function(e, id, page) {
      var loading = false;
      // 每次加载添加多少条目
      var itemsPerLoad = 20;
      // 最多可加载的条目
      var maxItems = 100;
      var lastIndex = $('#divPostList .show-list').length;
      // console.log(lastIndex);
      function addItems(number, lastIndex) {
        // 生成新条目的HTML
        var html = '';
        for (var i = lastIndex + 1; i <= lastIndex + number; i++) {
          html += '<div class="show-list" postid="421452">';
                      html += ' <div class="show-head">';
                       html += '<a href="/v44/userpage/1010835186" class="show-u blue">厦门市</a>';
                          html += '<span class="show-time">刚刚</span>';
                   html += '</div>';
                     html += '<a href="/v44/post/detail-421452.do">';
                         html +='<h3>小米USB插线板</h3>';
                      html +='</a>';
                      html +='<a href="/v44/post/detail-421452.do">';
                          html +='<div class="show-pic">';
                             html +='<ul class="pic-more clearfix">';
                              html +='<li>';   
                                  html +='<img src="https://img.1yyg.net/userpost/small/20170623135108386.jpg">';
                                  html +='</li>';
                                  html +='<li>';
                                  html +='<img src="https://img.1yyg.net/userpost/small/20170623135109851.jpg">';    
                                  html +='</li>';
                                  html +='<li>';
                                      html +='<img src="https://img.1yyg.net/userpost/small/20170623135112131.jpg">';
                                  html +='</li>';
                              html +='</ul>';
                          html +='</div>';
                          html +='<div class="show-con">';
                              html +='<p name="content">中奖了，心里一个美啊，激动万分，小米USB插板，家庭办公都很实用，设计非常的到位，小巧，不占地方，包装完美，做工非…</p>';
                          html +='</div>';
                      html +='</a>';
                      html +='<div class="opt-wrapper">';
                          html +='<ul class="opt-inner">';
                             html += '<li name="wx_zan" postid="421452">';
                                 html += '<a href="javascript:;">';
                                     html += '<span class="zan wx-new-icon"></span><em>0</em>';
                                  html +='</a>';
                              html +='</li>';   
                          html +='</ul>';
                      html +='</div>';
                  html +='</div>';
        }
        // 添加新条目
        console.log('a');
        $('#divPostList').append(html);
      }

      $(document).on('infinite', function() {
        console.log('one');
        // 如果正在加载，则退出
        if (loading) return;
        // 设置flag
        loading = true;
        // 模拟1s的加载过程
        setTimeout(function() {
          // 重置加载flag
          loading = false;
          if (lastIndex >= maxItems) {
            // 加载完毕，则注销无限加载事件，以防不必要的加载
            $.detachInfiniteScroll($('.infinite-scroll'));
            // 删除加载提示符
            $('.infinite-scroll-preloader').remove();
            return;
          }
          addItems(itemsPerLoad,lastIndex);
          // 更新最后加载的序号
          lastIndex = $('#divPostList .show-list').length;
          $.refreshScroller();
        }, 1000);
      });
    });

    $.init();
})
