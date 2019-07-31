@php
  $title = get_sub_field('title')['title'];
  $title_color = get_sub_field('title')['color'];
  $title_line_color = get_sub_field('title')['line_rule'];

  $use_columns = get_sub_field('use_columns');
  $content = $use_columns ? get_sub_field('content') : get_sub_field('columns') ;
  
  echo json_encode($content);
@endphp

<section class="content w-full relative container">
  @if (have_rows('content'))
    @while (have_rows('content')) @php(the_row())

      @if (get_row_layout() === 'copy')
        <p>ok</p>
      @endif

    @endwhile
  @endif
</section>
