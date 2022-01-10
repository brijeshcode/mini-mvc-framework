    <nav class="pagination is-rounded" role="navigation" aria-label="pagination">
        <a class="pagination-previous" title="This is the first page" {{ is_null($pagination['previous_page']) ? 'disabled' : '' }} {{ is_null($pagination['previous_page']) ? '' : 'href=?page=' .$pagination['previous_page']  }}  >Previous</a>
        <a class="pagination-next" href="?page={{ $pagination['next_page'] }}" >Next page</a>
    </nav>
