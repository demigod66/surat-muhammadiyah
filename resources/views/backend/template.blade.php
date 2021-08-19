@include('backend.header')
@include('backend.topbar')
@include('backend.sidebar')

<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Blank Page</h1>
      </div>

      <div class="section-body">
          @yield('content')
      </div>
    </section>
  </div>

  @include('backend.footer')
