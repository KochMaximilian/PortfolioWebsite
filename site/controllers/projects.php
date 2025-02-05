<?php

return function ($page) {

    $width = 400;
    $height = 500;

    $filterBy = get('filter');
    $unfilterd = $page->children()->listed()->sortBy('year', 'desc');

    $projects = $unfilterd
        ->when($filterBy, function ($filterBy) {
            return $this->filterBy('year', $filterBy);
        })
        ->paginate(3);

    $pagination = $projects->pagination();
    $filters = $unfilterd->pluck('year', null, true); /* unique values = true */

    return [
        'filterBy' => $filterBy,
        'unfilterd' => $unfilterd,
        'projects' => $projects,
        'pagination' => $pagination,
        'filters' => $filters,
        'width' => $width,
        'height' => $height
    ];
};
