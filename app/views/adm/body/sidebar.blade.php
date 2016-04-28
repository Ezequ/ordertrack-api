<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
        @foreach(UrlsAdm::getMenu() as $index => $value)
          <li>
            <a href="#">
                <span class="fa-stack fa-lg pull-left">
                    <i class="fa fa-circle-o fa-stack-1x "></i>
                </span>
                {{$index}}
                <!-- <b class="caret"></b> -->
            </a>
            <ul class="nav-pills nav-stacked" style="list-style-type: none; display: none;">
                @foreach($value as $name =>  $href)
                <li><a href="{{$href}}">{{$name}}</a></li>
                @endforeach
            </ul>
          </li>

        @endforeach
    </ul>
</div>