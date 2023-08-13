@props(["cssSlot" => '', 'title' => ''])
<head>
<title>{{ $title }}</title>

<meta charset="utf-8"/>
<link rel="shortcut icon" href="{{asset("assets/media/logos/favicon.ico")}}"/>
<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>


<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<link href="{{asset("plugins/global/plugins.bundle.css")}}" rel="stylesheet" type="text/css"/>
<link href="{{asset("css/style.bundle.css")}}" rel="stylesheet" type="text/css"/>
<link href="{{asset("plugins/custom/prismjs/prismjs.bundle.css")}}" rel="stylesheet" type="text/css"/>

<link href="{{asset("css/themes/layout/header/base/light.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("css/themes/layout/header/menu/light.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("css/themes/layout/header/brand/light.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("css/themes/layout/aside/light.css")}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset("css/dropify.css")}}">


    {{ $cssSlot }}
</head>
