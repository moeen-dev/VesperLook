@if(!empty($seo))
<title>Vesper Look | {{ $seo->meta_title ?? 'Quality and Comfort' }}</title>
<meta name="description" content="{{ $seo->meta_description ?? 'Default description' }}">
<meta name="keywords" content="{{ $seo->meta_keywords ?? 'Default, keywords' }}">

<meta property="og:title" content="{{ $seo->meta_title ?? 'Default OG Title' }}">   
<meta property="og:description" content="{{ $seo->meta_description ?? 'Default OG Description' }}">
@else
<title>@yield('title') &mdash; Vesper Look | Quality and Comfort</title>
<meta name="description" content="Discover premium fashion with quality, comfort, and design at Vesper Look.">
<meta name="keywords" content="fashion, quality, comfort, vesper, lifestyle, vesper_look,">

<meta property="og:title" content="Vesper Look | Quality and Comfort">
<meta property="og:description" content="Discover premium fashion with quality, comfort, and design at Vesper Look.">
@endif