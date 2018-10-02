@extends('layouts.app')

@section('title', '闯关猜猜猜')

@section('top-css')
    @parent

    <link rel="stylesheet" href="{{ asset('/client/css/game.css') }}" />
    <link rel="stylesheet" href="{{ asset('/client/css/progress_bar.css') }}" />
    <link rel="stylesheet" href="{{ asset('/client/css/swiper.min.css') }}" />
	<style type="text/css">
		body{
			background: #000000;
			padding:0px;
			margin:0px;
		}
		
		iframe-container, iframe {
			width: 458px;
			height: 458px;
			margin: 0 auto;
			display:block;
		}
	</style>
@endsection
    	
@section('content')	
	<div class="wrapper full-height">
		<div class="text center">
			邀请1个好友 获得3次机会
		</div>

		<div class="text center">
			<img src="{{ asset('/client/images/game_title.png') }}" width="500" />
		</div>

		<div class="iframe-container">
		  
		</div>

<div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
      	<iframe class="embed-responsive-item" src="/history" allowtransparency="true" frameBorder="0" scrolling="no">
      	</iframe>
	  </div>
      <div class="swiper-slide">
      	<iframe class="embed-responsive-item" src="/wheel" allowtransparency="true" frameBorder="0" scrolling="no">
		</iframe>
	  </div>
      <div class="swiper-slide">
      	<iframe class="embed-responsive-item" src="/results" allowtransparency="true" frameBorder="0" scrolling="no">
		</iframe>
	  </div>
    </div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>

		<div class="text center">
			猜下一次是单数或双数
		</div>

		<!-- Profile Page Finish -->
        <div class="progress-bar-container">
            <div class="circle done">
                <span class="label">1</span>
            </div>
            <span class="bar done"></span>
            <div class="circle done">
                <span class="label">2</span>
            </div>
            <span class="bar half"></span>
            <div class="circle active">
                <span class="label">3</span>
            </div>
            <span class="bar"></span>
            <div class="circle">
                <span class="label">4</span>
            </div>
            <span class="bar"></span>
            <div class="circle">
                <span class="label">5</span>
            </div>
        </div>

		<div class="button-wrapper">
	        <div class="button-card radio-primary">
	        	<div class="radio btn btn-rectangle">
					<input class="invisible" type="radio" ng-model="forms.selected" ng-value="first_big" ng-click="radioCheckUncheck($event)">单数
				</div>
			  </div>
			  <div class="button-card radio-primary">
				<div class="radio btn btn-rectangle">
					<input class="invisible" type="radio" ng-model="forms.selected" ng-value="first_small" ng-click="radioCheckUncheck($event)">双数
				</div>
			  </div>
		</div>
		<div style="clear: both;"></div>

		<div class="information-table">
		<div class="row">
			<div class="col-xs-4 border-right">
				<div class="header">当前积分</div>
				<div class="number">1200</div>
			</div>
			<div class="col-xs-4 border-right">
				<div class="header">可提现红包</div>
				<div class="number">100元</div>
			</div>
			<div class="col-xs-4">
				<div class="header">剩余次数</div>
				<div class="number">1</div>
			</div>
		</div>
	</div>
	</div>
@endsection

@section('footer-javascript')
	@parent
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>
	<script src="{{ asset('/client/js/game.js') }}"></script>
	<script src="{{ asset('/client/js/swiper.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
                var i = 1;
                $('.progress-bar-container .circle').removeClass().addClass('circle');
                $('.progress-bar-container .bar').removeClass().addClass('bar');
                setInterval(function() {
                    $('.progress-bar-container .circle:nth-of-type(' + i + ')').addClass('active');

                    $('.progress-bar-container .circle:nth-of-type(' + (i - 1) + ')').removeClass('active').addClass('done');

                    $('.progress-bar-container .circle:nth-of-type(' + (i - 1) + ') .label').html('&#10003;');

                    $('.progress-bar-container .bar:nth-of-type(' + (i - 1) + ')').addClass('active');

                    $('.progress-bar-container .bar:nth-of-type(' + (i - 2) + ')').removeClass('active').addClass('done');

                    i++;

                    if (i == 0) {
                        $('.progress-bar-container .bar').removeClass().addClass('bar');
                        $('.progress-bar-container div.circle').removeClass().addClass('circle');
                        i = 1;
                    }
                }, 1000);
            });

	var swiper = new Swiper('.swiper-container', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

	</script>
@endsection