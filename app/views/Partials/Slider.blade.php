@if($slider = Slider::where('slider_id', '=', 0)->get())
   @if ($slider->first()->active == 1)
        <?php $show = Slider::where('active', '=', 1)->where('slider_id', '!=', 0)->get(); ?>
        @if (count($show) > 1)
            <section id="slider"><!--slider-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        @foreach ($show->slice(0, 1) as $row)
                                            <div class="col-sm-6">
                                                {{ $row->slider_text }}
                                            </div>
                                            <div class="col-sm-6">
                                                <img src="{{ asset($row->slider) }}" class="girl img-responsive" alt="Slider" width="300" height="500" />
                                            </div>
                                        @endforeach
                                    </div>
                                    @foreach ($show->slice(1) as $row)
                                        <div class="item">
                                            <div class="col-sm-6">
                                                {{ $row->slider_text }}
                                            </div>
                                            <div class="col-sm-6">
                                                <img src="{{ asset($row->slider) }}" class="girl img-responsive" alt="Slider" width="300" height="500" />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </section><!--/slider-->
        @endif
    @endif
@endif