@extends('layouts.general')

@section('content')
<div id="view_feed" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="feed_name"></h4>
      </div>
      <div class="modal-body">
        <p id="feed_comment">

        <p id="feed_re">

        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Повернутися
        </button>
        <button type="button" class="btn btn-default" id="next_feed">
            Наступний відгук&nbsp;&nbsp;&nbsp;
            <i class="fa fa-angle-right" aria-hidden="true"></i>
        </button>
      </div>
    </div>

  </div>
</div>
<!-- END MODAL -->
<main>
<input type="hidden" value="{{$hotel->id}}" id="hotel_id">
    <div class="main_head">
        <ol class="path">
          <li><a href="#">Головна</a></li>
          <li><a href="#">Особистий кабінет</a></li>
          <li><a href="#">сдача житла</a></li>
          <li class="active">відгуки</li>
        </ol>
        <div class="green greenf"></div>
        <div class="grey grey-hotel greyf"></div>
    </div>
    <section class="feeds-edit">
    <ul class="caption">
        <li>Дата</li>
        <li>Ім'я</li>
        <li>Назва оголошення</li>
        <li>Відгук</li>
        <li>Статус</li>
    </ul>
<?php $i=0 ?>
@foreach($feeds as $feed)
<aside>
    <div>{{substr($feed->created_at,8,2).'.'.substr($feed->created_at,5,2).'.'.substr($feed->created_at,0,4)}}</div>
    <div><p>{{$feed->name}}</p><p>
        @php
        $p = $phone->phone;
        echo substr($p, 0, 2);
        echo ' (';
        echo substr($p, 2, 3);
        echo ') ';
        echo substr($p, 5, 2);
        echo '-';
        echo substr($p, 7, 2);
        echo '-';
        echo substr($p, 10, 3);
        @endphp
    </p></div>
    <div>{{$hotel->title}}</div>
    <div class="feed">
        <p>{{$feed->comment}}</p>
        @if ($feed->reight>0)
            <span class="plus"></span>
        @elseif ($feed->reight<0)
            <span class="minus"></span>
        @else
            <span class="re"></span>
        @endif
    </div>
    @if ($feed->status==1)
        <div>Новий</div>
        <button class="btn btn-danger" data-toggle="modal" data-target="#view_feed">Очікує відповіді</button>
    @endif
    @if ($feed->status==2)
        <div>Прочитаний</div>
        <button class="btn btn-default" data-toggle="modal" data-target="#view_feed">Переглянути</button>
    @endif
    @if ($feed->status==3)
        <div>Прийнятий</div>
        <button class="btn btn-default" data-toggle="modal" data-target="#view_feed">Переглянути</button>
    @endif
    <input type="hidden" value="{{$i++}}">
</aside>
@endforeach
    </section>
</main>
<script>
var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('add_map'), {
      center: {lat: 51.496839, lng: 23.930185},
      zoom: 12
    });
}
</script>
<script>
var baseUrl='../../';
</script>
<script src="../../js/hotel_feeds.js"></script>
@endsection
