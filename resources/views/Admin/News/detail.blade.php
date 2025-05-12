@extends('template.index')

@section('css')
<style>
   .news-content img {
      max-width: 100%;
      height: auto;
   }

   .news-header img {
      max-height: 400px;
      width: 100%;
      object-fit: cover;
      border-radius: 12px;
   }

   .news-content p {
      text-align: justify;
   }

   .news-content figure.media {
      margin: 1.5rem 0;
      display: flex;
      justify-content: center;
   }

   .news-content iframe {
      width: 100%;
      max-width: 720px;
      height: 405px;
      border: none;
      border-radius: 12px;
   }
</style>
@endsection

@section('main')
<div class="page-title mb-3">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Tampilan News</h3>
         <a href="{{route('admin.news.list')}}" class="btn btn-sm btn-primary">
            <i class="fas fa-arrow-left"></i> Kembali
         </a>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-body">
      <div class="row">
         <div class="col-12">
            <h2 class="mb-1">{{ $news->judul }}</h2>
            <p class="text-muted">
               Ditulis oleh <strong>{{ $news->author }}</strong> •
               <span>{{ \Carbon\Carbon::parse($news->tanggal_publish)->format('d M Y') }}</span>
            </p>
         </div>
      </div>
      <div class="news-header mb-4">
         <img src="{{ asset($news->gambar) }}" alt="Gambar Berita">
      </div>
      <div class="news-content">
         {!! $news->content !!}
      </div>
   </div>
</div>
@endsection

@section('js')
<script>
   document.querySelectorAll('oembed[url]').forEach(element => {
      const url = element.getAttribute('url');
      const iframe = document.createElement('iframe');
      iframe.setAttribute('src', url.replace('watch?v=', 'embed/'));
      iframe.setAttribute('allowfullscreen', '');
      element.parentNode.replaceChild(iframe, element);
   });
</script>

@endsection